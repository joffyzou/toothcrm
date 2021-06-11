<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class UsersController extends Controller
{
    public function index(Request $request, Role $role)
    {
        if ($request->ajax()) {
            $res = User::query()
                ->with(['department', 'roles'])
                ->orderByDesc('id')
                ->paginate($request->get('limit', 30));

//            foreach ($res->items() as $item) {
//                $item->role = $item->hasRole($role);
//            }

//            return $res;


//            $roles = Role::query()->orderByDesc('id')->get();
            // foreach ($roles as $role) {
                // $role->selected = $user != null && $user->hasRole($role);
            // }

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


    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $data = $request->all(['name','phone','nickname','password','role_ids','sip_id','department_id']);
        $data['role_ids'] = $data['role_ids'] == null ? [] : explode(',',$data['role_ids']);
        if ($data['password']){
            $data['password'] = bcrypt($data['password']);
        }else{
            unset($data['password']);
        }
        try{
            $user->update($data);
            $user->syncRoles($data['role_ids']);
            return $this->success();
        }catch (\Exception $exception){
            Log::error('更新用户信息异常：'.$exception->getMessage());
            return $this->error();
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
