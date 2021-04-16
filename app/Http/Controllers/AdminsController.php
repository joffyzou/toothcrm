<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Auth;

class AdminsController extends Controller
{
    // 管理员列表页面
    public function index(Admin $admin)
    {
        $admins = $admin->all();

        return view('admins.index', compact('admins'));
    }

    // 新建员工
    public function create(Admin $admin)
    {
        $admin = Auth::user();
        switch ($admin->role->id) {
            case 1:
                $roles = $admin->role::where([['id', '<>', '1']])->get();
                break;
            case 2:
                $roles = $admin->role::where([
                    ['id', '<>', '1'],
                    ['id', '<>', '2'],
                    ['id', '<>', '4'],
                    ['id', '<>', '5']
                ])->get();
                break;
            case 4:
                $roles = $admin->role::where([
                    ['id', '<>', '1'],
                    ['id', '<>', '2'],
                    ['id', '<>', '3'],
                    ['id', '<>', '4']
                ])->get();
                break;
            default:
                $roles = null;
        }

        return view('admins.create', compact('roles'));
    }

    // 保存新建员工
    public function store(Request $request, Admin $admin)
    {
        $data = $this->validate($request, [
            'username' => 'required|unique:admins|max:50',
            'role_id' => 'required',
            'password' => 'required|min:6'
        ]);
        foreach ($data as $key => $value) {
            if (is_null($value)) continue;
            if ($key == 'password') {
                $admin->$key = bcrypt($value);
                continue;
            }
            $admin->$key = $value;
        }
        $admin->save();

        return redirect()->route('admins.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    // 个人患者列表页
    public function patient(Admin $admin)
    {
        $patients = $admin->patients;

        return view('admins.patients', compact('admin', 'patients'));
    }

    public function patientdata(Admin $admin, Request $request)
    {
        if($request->key) {
            $key = $request->key['phone'];
            $patients = $admin->patients()->where('phone', $key)->get();
            $data = [
                'code' => 0,
                'data' => $patients
            ];
            return response()->json($data);
        }

        $patients = $admin->patients()->paginate(18);
        $data = [
            'code' => 0,
            'data' => $patients
        ];

        return response()->json($data);
    }

    public function patientsserch(Admin $admin, Request $request, $id=null)
    {
        $ids = $request->all()['key']['id'];
        // dd($ids);
        $patients = $admin->patients()->where('id', $ids)->get();
        $data = [
            'code' => 0,
            'data' => $patients
        ];
        return response()->json($data);
    }
}
