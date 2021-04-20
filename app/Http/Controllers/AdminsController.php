<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Auth;
use App\Http\Traits\TraitResource;
use App\Models\Patient;
use Carbon\Carbon;

class AdminsController extends Controller
{
    use TraitResource;

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
    public function patient(Admin $admin, Request $request, Patient $patient)
    {
        // $date = '2021-04-22 12:00:00';
        // $carbon = Carbon::parse ($date);


        // $int = (new Carbon)->diffInSeconds ($carbon, true);

        // return Carbon::parse($int)->format('j天G小时i分s秒');




        if ($request->isMethod('post')) {
            $page = $request->input('page', 1);
            $limit = $request->input('limit', 10);
            $list = $admin->patients()->orderBy('created_at', 'desc')->get();
            foreach ($list as $item) {
                // $zuix = $item->repays()->orderBy('created_at', 'desc')->get()->toJson();

                // $tet = Carbon::parse($zuix->created_at)->toDateTimeString();
                // return $tet;
                // $datt = $zuix->created_at->toDateTimeString()->toJson();
                // $datt = (string)$zuix;
                // return $datt;
                // $te = Carbon::parse($zuix->created_at)->toJson();
                // return $te;
                // return $zuix;
                // $datt = Carbon::parse('2016-10-15 00:10:25')->toDateTimeString();
                // return $datt;
                // $ditt = Carbon::parse($datt)->addDays(30);
                // $int = (new Carbon)->diffInSeconds ($ditt, true);
                // $tes = Carbon::parse($int)->format('j天G小时i分s秒');
                // return $int;
                // return $tes;
                // $datt = Carbon::parse($zuix->created_at)->addDays(30);
                // $int = (new Carbon)->diffInSeconds ($datt, true);

                $item->rema_time = now()->toDateTimeString();
                $item->repay_time = now();
                $item->store_time = Carbon::now();
                // return;
            }

            $res = self::getPageData($list, $page, $limit);


            return self::resJson(0, '获取成功', $res['data'], ['count' => $res['count']]);
        }

        return view('admins.patients');
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
