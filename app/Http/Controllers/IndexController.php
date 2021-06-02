<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Repay;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Patient $patient, User $user, Request $request)
    {
        if (is_null($request->getQueryString())) {
            if (Auth::id() === 1) {
                $patients = $patient::all();
            } else {
                $patients = $user::find(Auth::id())->patients()->get();
            }
        } else {
            $patients = $user::find($request->id)->patients()->get();
        }

//        if (Auth::user()->role_id > 0) {
//            $users = $user->with('role')->where('p_id', Auth::user()->role_id)->get();
//        } else {
//            $users = $user->with('role')->where('role_id', '>', 0)->get();
//        }


        $patientsCount = $patients->count();    // 录入客户数
        $patientsJz = $patients->where('project_id', 2)->count();   // 矫正客户数
        $patientsZh = $patients->where('project_id', 1)->count();   // 种植客户数
        $patientsQk = $patients->where('project_id', 3)->count();   // 全科客户数
        $patientsJy = $patients->where('project_id', 5)->count();   // 洁牙客户数
        $patientsJc = $patients->where('project_id', 4)->count();   // 检查客户数

        $achievement = $patients->sum('achievement');   // 总业绩
        $achievementJz = $patients->where('project_id', 2)->sum('achievement');   // 矫正业绩
        $achievementZh = $patients->where('project_id', 1)->sum('achievement');   // 种植业绩
        $achievementQk = $patients->where('project_id', 3)->sum('achievement');   // 全科业绩
        $achievementJy = $patients->where('project_id', 5)->sum('achievement');   // 洁牙业绩
        $achievementJc = $patients->where('project_id', 4)->sum('achievement');   // 检查业绩

        $appointment = $patients->where('is_appointment', 1)->count();  // 总预约数
        $appointmentJz = $patients->where('project_id', 2)->where('is_appointment', 1)->count();
        $appointmentZh = $patients->where('project_id', 1)->where('is_appointment', 1)->count();
        $appointmentQk = $patients->where('project_id', 3)->where('is_appointment', 1)->count();
        $appointmentJy = $patients->where('project_id', 5)->where('is_appointment', 1)->count();
        $appointmentJc = $patients->where('project_id', 4)->where('is_appointment', 1)->count();

        $to_store = $patients->where('is_to_store', 1)->count();  // 到店总数
        $to_storeJz = $patients->where('project_id', 2)->where('is_to_store', 1)->count();  // 到店总数
        $to_storeZh = $patients->where('project_id', 1)->where('is_to_store', 1)->count();  // 到店总数
        $to_storeQk = $patients->where('project_id', 3)->where('is_to_store', 1)->count();  // 到店总数
        $to_storeJy = $patients->where('project_id', 5)->where('is_to_store', 1)->count();  // 到店总数
        $to_storeJc = $patients->where('project_id', 4)->where('is_to_store', 1)->count();  // 到店总数

        $appointmentRate = $this->chance($appointment, $patientsCount);
        $appointmentRateJz = $this->chance($appointmentJz, $patientsJz);
        $appointmentRateZh = $this->chance($appointmentZh, $patientsZh);
        $appointmentRateQk = $this->chance($appointmentQk, $patientsQk);
        $appointmentRateJy = $this->chance($appointmentJy, $patientsJy);
        $appointmentRateJc = $this->chance($appointmentJc, $patientsJc);

        $to_store_rate = $this->chance($to_store, $patientsCount);
        $to_store_rateJz = $this->chance($to_storeJz, $patientsJz);
        $to_store_rateZh = $this->chance($to_storeZh, $patientsZh);
        $to_store_rateQk = $this->chance($to_storeQk, $patientsQk);
        $to_store_rateJy = $this->chance($to_storeJy, $patientsJy);
        $to_store_rateJc = $this->chance($to_storeJc, $patientsJc);

        $repaysCount = DB::table('repays')->select('patient_id')->distinct()->get()->count();
        $waitRepaysCount = $patientsCount - $repaysCount;

        $addWechatCount = $patients->where('is_add_wechat', 1)->count();
        $waitWechatCount = $patientsCount - $addWechatCount;

        $patientsseasCount = $patients->where('user_id', 0)->count();

        $isIntroduceMany = $patients->where('is_introduce', true)->sum('achievement');
        $introduceCount = $patients->where('is_introduce', true)->count();

        return view('index.index',
            compact('patientsCount',
                'patientsJz',
                'patientsZh',
                'patientsQk',
                'patientsJy',
                'patientsJc',
                'achievement',
                'achievementJz',
                'achievementZh',
                'achievementQk',
                'achievementJy',
                'achievementJc',
                'appointment',
                'appointmentJz',
                'appointmentZh',
                'appointmentQk',
                'appointmentJy',
                'appointmentJc',
                'to_store',
                'to_storeJz',
                'to_storeZh',
                'to_storeQk',
                'to_storeJy',
                'to_storeJc',
                'appointmentRate',
                'appointmentRateJz',
                'appointmentRateZh',
                'appointmentRateQk',
                'appointmentRateJy',
                'appointmentRateJc',
                'to_store_rate',
                'to_store_rateJz',
                'to_store_rateZh',
                'to_store_rateQk',
                'to_store_rateJy',
                'to_store_rateJc',
                'repaysCount',
                'waitRepaysCount',
                'addWechatCount',
                'waitWechatCount',
                'patientsseasCount',
                'isIntroduceMany',
                'introduceCount'
//                'users'
            ));
    }

    private function chance($a, $b)
    {
        if ($a === 0) {
            return '暂无数据';
        }
        return round($a / $b * 100, 2) . '%';
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

    public function console()
    {
        return view('indexes.console');
    }
}
