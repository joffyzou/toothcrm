<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Support\Facades\Log;

class RolesController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $res = Role::query()->orderByDesc('id')->paginate($request->get('limit', 30));
            $data = [
                'code' => 0,
                'msg' => '正在请求中...',
                'count' => $res->total(),
                'data' => $res->items()
            ];

            return $this->success('ok',$res->items(),$res->total());
        }

        return view('system.roles.index');
    }

    public function create()
    {
        return view('system.roles.create');
    }

    public function store(Request $request)
    {
        $data = $request->all(['name', 'display_name', 'permission_ids']);
        $data['permission_ids'] = $data['permission_ids'] == null ? [] : $data['permission_ids'];
        try {
            $role = Role::create($data);
            $role->syncPermissions($data['permission_ids']);

            return $this->success();
        } catch (\Exception $exception) {
            Log::error('添加角色异常：' . $exception->getMessage());

            return $this->error();
        }
    }

    public function edit(Role $role)
    {
        return view('system.roles.edit', compact('role'));
    }

    public function update(Request $request, Role $role)
    {
        $data = $request->all(['name', 'display_name', 'permission_ids']);
        $data['permission_ids'] = $data['permission_ids'] == null ? [] : $data['permission_ids'];
        try {
            $role->update($data);
            $role->syncPermissions($data['permission_ids']);

            return $this->success();
        } catch (\Exception $exception) {
            Log::error('更新角色异常：' . $exception->getMessage());

            return $this->error();
        }
    }

    public function destroy(Request $request)
    {
        $ids = $request->get('ids');
        if (!is_array($ids) || empty($ids)){
            return $this->error();
        }
        try{
            Role::destroy($ids);

            return $this->success();
        }catch (\Exception $exception){
            Log::error('删除角色异常：' . $exception->getMessage());

            return $this->success();
        }
    }
}
