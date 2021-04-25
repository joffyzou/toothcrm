<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;

class IndexsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('index.index');
    }

    //分配角色和处理
    public function role(Request $request,User $user)
    {
        if ($request->isMethod('post')) {
            $post = $this->validate($request,
                ['role_id'=>'required'],
                ['role_id.required'=>'必须选择']
            );
            $user->update($post);

            return redirect(route('user.lists'));
        }
        $roleAll = Role::all();

        return  view('user.role',compact('user','roleAll'));
    }
}
