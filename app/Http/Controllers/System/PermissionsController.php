<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionsController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()){
            $res = Permission::query()->orderBy('id','desc')->get();
            $data = [
                'code' => 0,
                'msg' => '正在请求中...',
                'count' => $res->count(),
                'data' => $res
            ];
            return $this->success("ok",$res,$res->count());
        }
        return view('system.permissions.index');
    }
}
