<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Node;

class RolesController extends Controller
{
    public function nodeList($id)
    {
        $role = Role::find($id);
        $nodeAll = (new Node)->getAllList();
        $nodes = $role->nodes()->pluck('nodes.id')->toArray();

        return view('test', compact('nodeAll', 'nodes', 'role'));
    }

    public function saveNode(Request $request, Role $role)
    {
        $role->nodes()->sync($request->get('node'));
    }
}
