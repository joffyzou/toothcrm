<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Repay;
use Illuminate\Http\Request;
use App\Models\Role;

class IndexsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Patient $patient, Repay $repay)
    {
        $patients = $patient::all();
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

        $appointmentRate = round($appointment / $patientsCount * 100, 2) . '%';
        $appointmentRateJz = round($appointmentJz / $patientsJz * 100, 2) . '%';
        $appointmentRateZh = round($appointmentZh / $patientsZh * 100, 2) . '%';
        $appointmentRateQk = round($appointmentQk / $patientsQk * 100, 2) . '%';
        $appointmentRateJy = round($appointmentJy / $patientsJy * 100, 2) . '%';
        $appointmentRateJc = round($appointmentJc / $patientsJc * 100, 2) . '%';

        $to_store_rate = round($to_store / $patientsCount * 100, 2) . '%';
        $to_store_rateJz = round($to_storeJz / $patientsJz * 100, 2) . '%';
        $to_store_rateZh = round($to_storeZh / $patientsZh * 100, 2) . '%';
        $to_store_rateQk = round($to_storeQk / $patientsQk * 100, 2) . '%';
        $to_store_rateJy = round($to_storeJy / $patientsJy * 100, 2) . '%';
        $to_store_rateJc = round($to_storeJc / $patientsJc * 100, 2) . '%';


        $repays = $repay::all();
        $repaysArr = [];
        foreach ($repays as $key => $val) {
            $repaysArr[$key] = $val->patient_id;
        }
        $repaysCount = count(array_unique($repaysArr));

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
                'repaysCount'
            ));
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
