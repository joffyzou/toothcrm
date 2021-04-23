<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
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
        $now = Carbon::now();   // 现在
        $today = Carbon::today();   // 今天
        $yesterday = Carbon::yesterday();   // 昨天
        $threeDay = Carbon::today()->modify('-3 days');  // 最近三天
        $sevenDay = Carbon::today()->modify('-7 days'); // 最近一周
        $fifteenDay = Carbon::today()->modify('-15 days');  // 最近15天
        $thirtyDay = Carbon::today()->modify('-30 days');   // 最近一个月

        if ($request->isMethod('post')) {
            $page = $request->input('page', 1);
            $limit = $request->input('limit', 10);
            $select_time = $request->input('created');
            $search_form = $request->input('form');
            $list = $admin->patients()->orderBy('created_at', 'desc')->get();

            if ($select_time) {
                switch ($select_time) {
                    case 'today':
                        $list = $admin->patients()->whereDate('created_at', '>=', $now)->get();
                        break;
                    case 'yesterday':
                        $list = $admin->patients()->whereBetween('created_at', [$yesterday, $today])->get();
                        break;
                    case 'threeDay':
                        $list = $admin->patients()->whereBetween('created_at', [$threeDay, $now])->get();
                        break;
                    case 'sevenDay':
                        $list = $admin->patients()->whereBetween('created_at', [$sevenDay, $now])->get();
                        break;
                    case 'fifteenDay':
                        $list = $admin->patients()->whereBetween('created_at', [$fifteenDay, $now])->get();
                        break;
                    case 'thirtyDay':
                        $list = $admin->patients()->whereBetween('created_at', [$thirtyDay, $now])->get();
                        break;
                }
            }

            if ($search_form == 'form') {
                if ($request->input('key')) {
                    $key = $request->input('key');
                    $list = $admin->patients()->where('phone', $key)->orWhere('name', $key)->get();
                } elseif ($request->input('dateBetween')) {
                    $dateBetween = explode('~', $request->input('dateBetween'));
                    $dateStart = Carbon::parse(trim($dateBetween[0]));   // 时间从小到大
                    $dateEnd = Carbon::parse(trim($dateBetween[1]));
                    $list = $admin->patients()->whereBetween('created_at', [$dateStart, $dateEnd])->get();
                }
            }




            foreach ($list as $item) {
                if (count($item->repays) > 0) {
                    $repay = $item->repays()->orderBy('created_at', 'desc')->first();
                    $repay_at = $repay->created_at->toDateTimeString();
                    $ditt = Carbon::parse($repay_at)->addDays(30);
                    $int = (new Carbon)->diffInHours($ditt, true);
                    $item->rema_time = $int . '小时';
                } else {
                    $item->rema_time = '0';
                }
                $item->repay_time = now();
                $item->store_time = Carbon::now();
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
