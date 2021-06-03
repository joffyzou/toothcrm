<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $res = User::query()
                ->with('department')
                ->orderByDesc('id')
                ->paginate($request->get('limit', 30));

            return $this->success('ok', $res->items(), $res->total());
        }

        return view('system.users.index');
    }

    public function create()
    {
        return view('system.users.create');
    }

    public function store(Request $request)
    {
        $data = $request->all(['username', 'password', 'role_ids', 'department_id']);
        $data['role_ids'] = $data['role_ids'] == null ? [] : explode(',', $data['role_ids']);
        $data['password'] = bcrypt($data['password']);
        $count = User::query()->where('username', '=', $data['username'])->count();
        if ($count) {
            return $this->error('账号已存在');
        }
        try {
            $user = User::create($data);
            $user->syncRoles($data['role_ids']);
            return $this->success();
        } catch (\Exception $exception) {
            Log::error('添加用户异常：' . $exception->getMessage());
            return $this->error();
        }
    }

    public function edit(User $user)
    {
        return view('system.users.edit', compact('user'));
    }


    public function update(Request $request, User $user)
    {
        $this->authorize('update', $user);
        $info = $user->find($request->id);
        if (empty($info)) {
            return $this->resJson(1, '没有该条记录');
        }
        $res = $info->update([
            'username' => $request->input('username'),
            'password' => bcrypt($request->input('password'))
        ]);
        if ($res !== true) {
            return $this->resJson(1, $info->getError());
        } else {
            return $this->resJson(0, '操作成功');
        }
    }

    public function status(Request $request)
    {
        $parms = $request->all(['status', 'user_id']);
        try {
            User::query()->where('id', '=', $parms['user_id'])->update(['status' => $parms['status']]);

            return $this->success();
        } catch (\Exception $exception) {
            Log::error('设置用户状态异常：' . $exception->getMessage());

            return $this->error();
        }
    }

    public function destroy(Request $request)
    {
        $ids = $request->input('ids');
        if (!is_array($ids) || empty($ids)) {
            return $this->error('请选择删除项');
        }
        try {
            User::destroy($ids);

            return $this->success();
        } catch (\Exception $exception) {
            Log::error('删除用户异常：' . $exception->getMessage());

            return $this->error();
        }
    }
}
