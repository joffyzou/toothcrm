<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Node;

class RolesController extends Controller
{
    public function nodeList(Role $role)
    {
        $node = $role->nodes()->pluck('id')->toArray();
        $nodeAll=(new Node())->getAllList();

        return view('test', compact('nodeAll', 'nodes', 'role'));
    }

    public function saveNode(Request $request, Role $role)
    {
        $role->nodes()->sync($request->get('node'));

        return redirect(route('admin.role.show',$role));
    }
}
