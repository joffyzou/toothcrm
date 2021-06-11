<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Platform;
use App\Models\Project;
use App\Models\Repay;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
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

    public function sums(Request $request)
    {
        $data = $request->all([
            'platform_id',
            'origin_id',
            'origin_sum',
            'valid_sum'
        ]);
        if ($request->ajax()) {
            DB::table('sums')->insert($request->all());
            return $this->success();
        }
    }

    public function operate(Request $request)
    {
        $platforms = Platform::all();
        $projects = Project::all();

        $data = $request->all([
            'platform_id',
            'date',
            'startDate',
            'endDate'
        ]);

        $date = dateCheck($data['date']);

        $platform = Platform::query()
            ->when(!is_null($data['platform_id']), function ($query) use ($data) {
                return $query->where('id', $data['platform_id']);
            })
            ->first();

        // ---------- 对话
        // 预约
        $dhyy = Patient::query()
            ->when($data['platform_id'], function ($query) use ($data) {
                return $query->where('platform_id', $data['platform_id']);
            })
            ->where('origin_id', 2)
            ->where('is_appointment', true)
            ->when($data['startDate'] && $data['endDate'], function ($query) use ($data) {
                return $query->whereBetween('created_at', [$data['startDate'], $data['endDate']]);
            })
            ->when($data['date'], function ($query) use ($date) {
                return $query->whereBetween('created_at', [$date, now()]);
            })
            ->count();
        $dhyyjz = Patient::query()
            ->when($data['platform_id'], function ($query) use ($data) {
                return $query->where('platform_id', $data['platform_id']);
            })
            ->where('origin_id', 2)
            ->where('is_appointment', true)
            ->where('project_id', 2)
            ->when($data['startDate'] && $data['endDate'], function ($query) use ($data) {
                return $query->whereBetween('created_at', [$data['startDate'], $data['endDate']]);
            })
            ->when($data['date'], function ($query) use ($date) {
                return $query->whereBetween('created_at', [$date, now()]);
            })
            ->count();
        $dhyyzz = Patient::query()
            ->when($data['platform_id'], function ($query) use ($data) {
                return $query->where('platform_id', $data['platform_id']);
            })
            ->where('origin_id', 2)
            ->where('is_appointment', true)
            ->where('project_id', 1)
            ->when($data['startDate'] && $data['endDate'], function ($query) use ($data) {
                return $query->whereBetween('created_at', [$data['startDate'], $data['endDate']]);
            })
            ->when($data['date'], function ($query) use ($date) {
                return $query->whereBetween('created_at', [$date, now()]);
            })
            ->count();
        $dhyyqk = Patient::query()
            ->when($data['platform_id'], function ($query) use ($data) {
                return $query->where('platform_id', $data['platform_id']);
            })
            ->where('origin_id', 2)
            ->where('is_appointment', true)
            ->where('project_id', 3)
            ->when($data['startDate'] && $data['endDate'], function ($query) use ($data) {
                return $query->whereBetween('created_at', [$data['startDate'], $data['endDate']]);
            })
            ->when($data['date'], function ($query) use ($date) {
                return $query->whereBetween('created_at', [$date, now()]);
            })
            ->count();
        $dhyyjc = Patient::query()
            ->when($data['platform_id'], function ($query) use ($data) {
                return $query->where('platform_id', $data['platform_id']);
            })
            ->where('origin_id', 2)
            ->where('is_appointment', true)
            ->where('project_id', 4)
            ->when($data['startDate'] && $data['endDate'], function ($query) use ($data) {
                return $query->whereBetween('created_at', [$data['startDate'], $data['endDate']]);
            })
            ->when($data['date'], function ($query) use ($date) {
                return $query->whereBetween('created_at', [$date, now()]);
            })
            ->count();
        $dhyyjy = Patient::query()
            ->when($data['platform_id'], function ($query) use ($data) {
                return $query->where('platform_id', $data['platform_id']);
            })
            ->where('origin_id', 2)
            ->where('is_appointment', true)
            ->where('project_id', 5)
            ->when($data['startDate'] && $data['endDate'], function ($query) use ($data) {
                return $query->whereBetween('created_at', [$data['startDate'], $data['endDate']]);
            })
            ->when($data['date'], function ($query) use ($date) {
                return $query->whereBetween('created_at', [$date, now()]);
            })
            ->count();

        // 到店
        $dhdd = Patient::query()
            ->when($data['platform_id'], function ($query) use ($data) {
                return $query->where('platform_id', $data['platform_id']);
            })
            ->where('origin_id', 2)
            ->where('is_to_store', true)
            ->when($data['startDate'] && $data['endDate'], function ($query) use ($data) {
                return $query->whereBetween('created_at', [$data['startDate'], $data['endDate']]);
            })
            ->when($data['date'], function ($query) use ($date) {
                return $query->whereBetween('created_at', [$date, now()]);
            })
            ->count();
        $dhddjz = Patient::query()
            ->when($data['platform_id'], function ($query) use ($data) {
                return $query->where('platform_id', $data['platform_id']);
            })
            ->where('origin_id', 2)
            ->where('is_to_store', true)
            ->where('project_id', 2)
            ->when($data['startDate'] && $data['endDate'], function ($query) use ($data) {
                return $query->whereBetween('created_at', [$data['startDate'], $data['endDate']]);
            })
            ->when($data['date'], function ($query) use ($date) {
                return $query->whereBetween('created_at', [$date, now()]);
            })
            ->count();
        $dhddzz = Patient::query()
            ->when($data['platform_id'], function ($query) use ($data) {
                return $query->where('platform_id', $data['platform_id']);
            })
            ->where('origin_id', 2)
            ->where('is_to_store', true)
            ->where('project_id', 1)
            ->when($data['startDate'] && $data['endDate'], function ($query) use ($data) {
                return $query->whereBetween('created_at', [$data['startDate'], $data['endDate']]);
            })
            ->when($data['date'], function ($query) use ($date) {
                return $query->whereBetween('created_at', [$date, now()]);
            })
            ->count();
        $dhddqk = Patient::query()
            ->when($data['platform_id'], function ($query) use ($data) {
                return $query->where('platform_id', $data['platform_id']);
            })
            ->where('origin_id', 2)
            ->where('is_to_store', true)
            ->where('project_id', 3)
            ->when($data['startDate'] && $data['endDate'], function ($query) use ($data) {
                return $query->whereBetween('created_at', [$data['startDate'], $data['endDate']]);
            })
            ->when($data['date'], function ($query) use ($date) {
                return $query->whereBetween('created_at', [$date, now()]);
            })
            ->count();
        $dhddjc = Patient::query()
            ->when($data['platform_id'], function ($query) use ($data) {
                return $query->where('platform_id', $data['platform_id']);
            })
            ->where('origin_id', 2)
            ->where('is_to_store', true)
            ->where('project_id', 4)
            ->when($data['startDate'] && $data['endDate'], function ($query) use ($data) {
                return $query->whereBetween('created_at', [$data['startDate'], $data['endDate']]);
            })
            ->when($data['date'], function ($query) use ($date) {
                return $query->whereBetween('created_at', [$date, now()]);
            })
            ->count();
        $dhddjy = Patient::query()
            ->when($data['platform_id'], function ($query) use ($data) {
                return $query->where('platform_id', $data['platform_id']);
            })
            ->where('origin_id', 2)
            ->where('is_to_store', true)
            ->where('project_id', 5)
            ->when($data['startDate'] && $data['endDate'], function ($query) use ($data) {
                return $query->whereBetween('created_at', [$data['startDate'], $data['endDate']]);
            })
            ->when($data['date'], function ($query) use ($date) {
                return $query->whereBetween('created_at', [$date, now()]);
            })
            ->count();

        // 业绩
        $dhyj = Patient::query()
            ->when($data['platform_id'], function ($query) use ($data) {
                return $query->where('platform_id', $data['platform_id']);
            })
            ->where('origin_id', 2)
            ->when($data['startDate'] && $data['endDate'], function ($query) use ($data) {
                return $query->whereBetween('created_at', [$data['startDate'], $data['endDate']]);
            })
            ->when($data['date'], function ($query) use ($date) {
                return $query->whereBetween('created_at', [$date, now()]);
            })
            ->sum('achievement');
        $dhyjjz = Patient::query()
            ->when($data['platform_id'], function ($query) use ($data) {
                return $query->where('platform_id', $data['platform_id']);
            })
            ->where('origin_id', 2)
            ->where('project_id', 2)
            ->when($data['startDate'] && $data['endDate'], function ($query) use ($data) {
                return $query->whereBetween('created_at', [$data['startDate'], $data['endDate']]);
            })
            ->when($data['date'], function ($query) use ($date) {
                return $query->whereBetween('created_at', [$date, now()]);
            })
            ->sum('achievement');
        $dhyjzz = Patient::query()
            ->when($data['platform_id'], function ($query) use ($data) {
                return $query->where('platform_id', $data['platform_id']);
            })
            ->where('origin_id', 2)
            ->where('project_id', 1)
            ->when($data['startDate'] && $data['endDate'], function ($query) use ($data) {
                return $query->whereBetween('created_at', [$data['startDate'], $data['endDate']]);
            })
            ->when($data['date'], function ($query) use ($date) {
                return $query->whereBetween('created_at', [$date, now()]);
            })
            ->sum('achievement');
        $dhyjqk = Patient::query()
            ->when($data['platform_id'], function ($query) use ($data) {
                return $query->where('platform_id', $data['platform_id']);
            })
            ->where('origin_id', 2)
            ->where('project_id', 3)
            ->when($data['startDate'] && $data['endDate'], function ($query) use ($data) {
                return $query->whereBetween('created_at', [$data['startDate'], $data['endDate']]);
            })
            ->when($data['date'], function ($query) use ($date) {
                return $query->whereBetween('created_at', [$date, now()]);
            })
            ->sum('achievement');
        $dhyjjc = Patient::query()
            ->when($data['platform_id'], function ($query) use ($data) {
                return $query->where('platform_id', $data['platform_id']);
            })
            ->where('origin_id', 2)
            ->where('project_id', 4)
            ->when($data['startDate'] && $data['endDate'], function ($query) use ($data) {
                return $query->whereBetween('created_at', [$data['startDate'], $data['endDate']]);
            })
            ->when($data['date'], function ($query) use ($date) {
                return $query->whereBetween('created_at', [$date, now()]);
            })
            ->sum('achievement');
        $dhyjjy = Patient::query()
            ->when($data['platform_id'], function ($query) use ($data) {
                return $query->where('platform_id', $data['platform_id']);
            })
            ->where('origin_id', 2)
            ->where('project_id', 5)
            ->when($data['startDate'] && $data['endDate'], function ($query) use ($data) {
                return $query->whereBetween('created_at', [$data['startDate'], $data['endDate']]);
            })
            ->when($data['date'], function ($query) use ($date) {
                return $query->whereBetween('created_at', [$date, now()]);
            })
            ->sum('achievement');

        // ---------- 进电
        // 预约
        $jdyy = Patient::query()
            ->when($data['platform_id'], function ($query) use ($data) {
                return $query->where('platform_id', $data['platform_id']);
            })
            ->where('origin_id', 1)
            ->where('is_appointment', true)
            ->when($data['startDate'] && $data['endDate'], function ($query) use ($data) {
                return $query->whereBetween('created_at', [$data['startDate'], $data['endDate']]);
            })
            ->when($data['date'], function ($query) use ($date) {
                return $query->whereBetween('created_at', [$date, now()]);
            })
            ->count();
        $jdyyjz = Patient::query()
            ->when($data['platform_id'], function ($query) use ($data) {
                return $query->where('platform_id', $data['platform_id']);
            })
            ->where('origin_id', 1)
            ->where('is_appointment', true)
            ->where('project_id', 2)
            ->when($data['startDate'] && $data['endDate'], function ($query) use ($data) {
                return $query->whereBetween('created_at', [$data['startDate'], $data['endDate']]);
            })
            ->when($data['date'], function ($query) use ($date) {
                return $query->whereBetween('created_at', [$date, now()]);
            })
            ->count();
        $jdyyzz = Patient::query()
            ->when($data['platform_id'], function ($query) use ($data) {
                return $query->where('platform_id', $data['platform_id']);
            })
            ->where('origin_id', 1)
            ->where('is_appointment', true)
            ->where('project_id', 1)
            ->when($data['startDate'] && $data['endDate'], function ($query) use ($data) {
                return $query->whereBetween('created_at', [$data['startDate'], $data['endDate']]);
            })
            ->when($data['date'], function ($query) use ($date) {
                return $query->whereBetween('created_at', [$date, now()]);
            })
            ->count();
        $jdyyqk = Patient::query()
            ->when($data['platform_id'], function ($query) use ($data) {
                return $query->where('platform_id', $data['platform_id']);
            })
            ->where('origin_id', 1)
            ->where('is_appointment', true)
            ->where('project_id', 3)
            ->when($data['startDate'] && $data['endDate'], function ($query) use ($data) {
                return $query->whereBetween('created_at', [$data['startDate'], $data['endDate']]);
            })
            ->when($data['date'], function ($query) use ($date) {
                return $query->whereBetween('created_at', [$date, now()]);
            })
            ->count();
        $jdyyjc = Patient::query()
            ->when($data['platform_id'], function ($query) use ($data) {
                return $query->where('platform_id', $data['platform_id']);
            })
            ->where('origin_id', 1)
            ->where('is_appointment', true)
            ->where('project_id', 4)
            ->when($data['startDate'] && $data['endDate'], function ($query) use ($data) {
                return $query->whereBetween('created_at', [$data['startDate'], $data['endDate']]);
            })
            ->when($data['date'], function ($query) use ($date) {
                return $query->whereBetween('created_at', [$date, now()]);
            })
            ->count();
        $jdyyjy = Patient::query()
            ->when($data['platform_id'], function ($query) use ($data) {
                return $query->where('platform_id', $data['platform_id']);
            })
            ->where('origin_id', 1)
            ->where('is_appointment', true)
            ->where('project_id', 5)
            ->when($data['startDate'] && $data['endDate'], function ($query) use ($data) {
                return $query->whereBetween('created_at', [$data['startDate'], $data['endDate']]);
            })
            ->when($data['date'], function ($query) use ($date) {
                return $query->whereBetween('created_at', [$date, now()]);
            })
            ->count();

        // 到店
        $jddd = Patient::query()
            ->when($data['platform_id'], function ($query) use ($data) {
                return $query->where('platform_id', $data['platform_id']);
            })
            ->where('origin_id', 1)
            ->where('is_to_store', true)
            ->when($data['startDate'] && $data['endDate'], function ($query) use ($data) {
                return $query->whereBetween('created_at', [$data['startDate'], $data['endDate']]);
            })
            ->when($data['date'], function ($query) use ($date) {
                return $query->whereBetween('created_at', [$date, now()]);
            })
            ->count();
        $jdddjz = Patient::query()
            ->when($data['platform_id'], function ($query) use ($data) {
                return $query->where('platform_id', $data['platform_id']);
            })
            ->where('origin_id', 1)
            ->where('is_to_store', true)
            ->where('project_id', 2)
            ->when($data['startDate'] && $data['endDate'], function ($query) use ($data) {
                return $query->whereBetween('created_at', [$data['startDate'], $data['endDate']]);
            })
            ->when($data['date'], function ($query) use ($date) {
                return $query->whereBetween('created_at', [$date, now()]);
            })
            ->count();
        $jdddzz = Patient::query()
            ->when($data['platform_id'], function ($query) use ($data) {
                return $query->where('platform_id', $data['platform_id']);
            })
            ->where('origin_id', 1)
            ->where('is_to_store', true)
            ->where('project_id', 1)
            ->when($data['startDate'] && $data['endDate'], function ($query) use ($data) {
                return $query->whereBetween('created_at', [$data['startDate'], $data['endDate']]);
            })
            ->when($data['date'], function ($query) use ($date) {
                return $query->whereBetween('created_at', [$date, now()]);
            })
            ->count();
        $jdddqk = Patient::query()
            ->when($data['platform_id'], function ($query) use ($data) {
                return $query->where('platform_id', $data['platform_id']);
            })
            ->where('origin_id', 1)
            ->where('is_to_store', true)
            ->where('project_id', 3)
            ->when($data['startDate'] && $data['endDate'], function ($query) use ($data) {
                return $query->whereBetween('created_at', [$data['startDate'], $data['endDate']]);
            })
            ->when($data['date'], function ($query) use ($date) {
                return $query->whereBetween('created_at', [$date, now()]);
            })
            ->count();
        $jdddjc = Patient::query()
            ->when($data['platform_id'], function ($query) use ($data) {
                return $query->where('platform_id', $data['platform_id']);
            })
            ->where('origin_id', 1)
            ->where('is_to_store', true)
            ->where('project_id', 4)
            ->when($data['startDate'] && $data['endDate'], function ($query) use ($data) {
                return $query->whereBetween('created_at', [$data['startDate'], $data['endDate']]);
            })
            ->when($data['date'], function ($query) use ($date) {
                return $query->whereBetween('created_at', [$date, now()]);
            })
            ->count();
        $jdddjy = Patient::query()
            ->when($data['platform_id'], function ($query) use ($data) {
                return $query->where('platform_id', $data['platform_id']);
            })
            ->where('origin_id', 1)
            ->where('is_to_store', true)
            ->where('project_id', 5)
            ->when($data['startDate'] && $data['endDate'], function ($query) use ($data) {
                return $query->whereBetween('created_at', [$data['startDate'], $data['endDate']]);
            })
            ->when($data['date'], function ($query) use ($date) {
                return $query->whereBetween('created_at', [$date, now()]);
            })
            ->count();

        // 业绩
        $jdyj = Patient::query()
            ->when($data['platform_id'], function ($query) use ($data) {
                return $query->where('platform_id', $data['platform_id']);
            })
            ->where('origin_id', 1)
            ->when($data['startDate'] && $data['endDate'], function ($query) use ($data) {
                return $query->whereBetween('created_at', [$data['startDate'], $data['endDate']]);
            })
            ->when($data['date'], function ($query) use ($date) {
                return $query->whereBetween('created_at', [$date, now()]);
            })
            ->sum('achievement');
        $jdyjjz = Patient::query()
            ->when($data['platform_id'], function ($query) use ($data) {
                return $query->where('platform_id', $data['platform_id']);
            })
            ->where('origin_id', 1)
            ->where('project_id', 2)
            ->when($data['startDate'] && $data['endDate'], function ($query) use ($data) {
                return $query->whereBetween('created_at', [$data['startDate'], $data['endDate']]);
            })
            ->when($data['date'], function ($query) use ($date) {
                return $query->whereBetween('created_at', [$date, now()]);
            })
            ->sum('achievement');
        $jdyjzz = Patient::query()
            ->when($data['platform_id'], function ($query) use ($data) {
                return $query->where('platform_id', $data['platform_id']);
            })
            ->where('origin_id', 1)
            ->where('project_id', 1)
            ->when($data['startDate'] && $data['endDate'], function ($query) use ($data) {
                return $query->whereBetween('created_at', [$data['startDate'], $data['endDate']]);
            })
            ->when($data['date'], function ($query) use ($date) {
                return $query->whereBetween('created_at', [$date, now()]);
            })
            ->sum('achievement');
        $jdyjqk = Patient::query()
            ->when($data['platform_id'], function ($query) use ($data) {
                return $query->where('platform_id', $data['platform_id']);
            })
            ->where('origin_id', 1)
            ->where('project_id', 3)
            ->when($data['startDate'] && $data['endDate'], function ($query) use ($data) {
                return $query->whereBetween('created_at', [$data['startDate'], $data['endDate']]);
            })
            ->when($data['date'], function ($query) use ($date) {
                return $query->whereBetween('created_at', [$date, now()]);
            })
            ->sum('achievement');
        $jdyjjc = Patient::query()
            ->when($data['platform_id'], function ($query) use ($data) {
                return $query->where('platform_id', $data['platform_id']);
            })
            ->where('origin_id', 1)
            ->where('project_id', 4)
            ->when($data['startDate'] && $data['endDate'], function ($query) use ($data) {
                return $query->whereBetween('created_at', [$data['startDate'], $data['endDate']]);
            })
            ->when($data['date'], function ($query) use ($date) {
                return $query->whereBetween('created_at', [$date, now()]);
            })
            ->sum('achievement');
        $jdyjjy = Patient::query()
            ->when($data['platform_id'], function ($query) use ($data) {
                return $query->where('platform_id', $data['platform_id']);
            })
            ->where('origin_id', 1)
            ->where('project_id', 5)
            ->when($data['startDate'] && $data['endDate'], function ($query) use ($data) {
                return $query->whereBetween('created_at', [$data['startDate'], $data['endDate']]);
            })
            ->when($data['date'], function ($query) use ($date) {
                return $query->whereBetween('created_at', [$date, now()]);
            })
            ->sum('achievement');


        // ---------- 留咨
        // 预约
        $lzyy = Patient::query()
            ->when($data['platform_id'], function ($query) use ($data) {
                return $query->where('platform_id', $data['platform_id']);
            })
            ->where('origin_id', 3)
            ->where('is_appointment', true)
            ->when($data['startDate'] && $data['endDate'], function ($query) use ($data) {
                return $query->whereBetween('created_at', [$data['startDate'], $data['endDate']]);
            })
            ->when($data['date'], function ($query) use ($date) {
                return $query->whereBetween('created_at', [$date, now()]);
            })
            ->count();
        $lzyyjz = Patient::query()
            ->when($data['platform_id'], function ($query) use ($data) {
                return $query->where('platform_id', $data['platform_id']);
            })
            ->where('origin_id', 3)
            ->where('is_appointment', true)
            ->where('project_id', 2)
            ->when($data['startDate'] && $data['endDate'], function ($query) use ($data) {
                return $query->whereBetween('created_at', [$data['startDate'], $data['endDate']]);
            })
            ->when($data['date'], function ($query) use ($date) {
                return $query->whereBetween('created_at', [$date, now()]);
            })
            ->count();
        $lzyyzz = Patient::query()
            ->when($data['platform_id'], function ($query) use ($data) {
                return $query->where('platform_id', $data['platform_id']);
            })
            ->where('origin_id', 3)
            ->where('is_appointment', true)
            ->where('project_id', 1)
            ->when($data['startDate'] && $data['endDate'], function ($query) use ($data) {
                return $query->whereBetween('created_at', [$data['startDate'], $data['endDate']]);
            })
            ->when($data['date'], function ($query) use ($date) {
                return $query->whereBetween('created_at', [$date, now()]);
            })
            ->count();
        $lzyyqk = Patient::query()
            ->when($data['platform_id'], function ($query) use ($data) {
                return $query->where('platform_id', $data['platform_id']);
            })
            ->where('origin_id', 3)
            ->where('is_appointment', true)
            ->where('project_id', 3)
            ->when($data['startDate'] && $data['endDate'], function ($query) use ($data) {
                return $query->whereBetween('created_at', [$data['startDate'], $data['endDate']]);
            })
            ->when($data['date'], function ($query) use ($date) {
                return $query->whereBetween('created_at', [$date, now()]);
            })
            ->count();
        $lzyyjc = Patient::query()
            ->when($data['platform_id'], function ($query) use ($data) {
                return $query->where('platform_id', $data['platform_id']);
            })
            ->where('origin_id', 3)
            ->where('is_appointment', true)
            ->where('project_id', 4)
            ->when($data['startDate'] && $data['endDate'], function ($query) use ($data) {
                return $query->whereBetween('created_at', [$data['startDate'], $data['endDate']]);
            })
            ->when($data['date'], function ($query) use ($date) {
                return $query->whereBetween('created_at', [$date, now()]);
            })
            ->count();
        $lzyyjy = Patient::query()
            ->when($data['platform_id'], function ($query) use ($data) {
                return $query->where('platform_id', $data['platform_id']);
            })
            ->where('origin_id', 3)
            ->where('is_appointment', true)
            ->where('project_id', 5)
            ->when($data['startDate'] && $data['endDate'], function ($query) use ($data) {
                return $query->whereBetween('created_at', [$data['startDate'], $data['endDate']]);
            })
            ->when($data['date'], function ($query) use ($date) {
                return $query->whereBetween('created_at', [$date, now()]);
            })
            ->count();

        // 到店
        $lzdd = Patient::query()
            ->when($data['platform_id'], function ($query) use ($data) {
                return $query->where('platform_id', $data['platform_id']);
            })
            ->where('origin_id', 3)
            ->where('is_to_store', true)
            ->when($data['startDate'] && $data['endDate'], function ($query) use ($data) {
                return $query->whereBetween('created_at', [$data['startDate'], $data['endDate']]);
            })
            ->when($data['date'], function ($query) use ($date) {
                return $query->whereBetween('created_at', [$date, now()]);
            })
            ->count();
        $lzddjz = Patient::query()
            ->when($data['platform_id'], function ($query) use ($data) {
                return $query->where('platform_id', $data['platform_id']);
            })
            ->where('origin_id', 3)
            ->where('is_to_store', true)
            ->where('project_id', 2)
            ->when($data['startDate'] && $data['endDate'], function ($query) use ($data) {
                return $query->whereBetween('created_at', [$data['startDate'], $data['endDate']]);
            })
            ->when($data['date'], function ($query) use ($date) {
                return $query->whereBetween('created_at', [$date, now()]);
            })
            ->count();
        $lzddzz = Patient::query()
            ->when($data['platform_id'], function ($query) use ($data) {
                return $query->where('platform_id', $data['platform_id']);
            })
            ->where('origin_id', 3)
            ->where('is_to_store', true)
            ->where('project_id', 1)
            ->when($data['startDate'] && $data['endDate'], function ($query) use ($data) {
                return $query->whereBetween('created_at', [$data['startDate'], $data['endDate']]);
            })
            ->when($data['date'], function ($query) use ($date) {
                return $query->whereBetween('created_at', [$date, now()]);
            })
            ->count();
        $lzddqk = Patient::query()
            ->when($data['platform_id'], function ($query) use ($data) {
                return $query->where('platform_id', $data['platform_id']);
            })
            ->where('origin_id', 3)
            ->where('is_to_store', true)
            ->where('project_id', 3)
            ->when($data['startDate'] && $data['endDate'], function ($query) use ($data) {
                return $query->whereBetween('created_at', [$data['startDate'], $data['endDate']]);
            })
            ->when($data['date'], function ($query) use ($date) {
                return $query->whereBetween('created_at', [$date, now()]);
            })
            ->count();
        $lzddjc = Patient::query()
            ->when($data['platform_id'], function ($query) use ($data) {
                return $query->where('platform_id', $data['platform_id']);
            })
            ->where('origin_id', 3)
            ->where('is_to_store', true)
            ->where('project_id', 4)
            ->when($data['startDate'] && $data['endDate'], function ($query) use ($data) {
                return $query->whereBetween('created_at', [$data['startDate'], $data['endDate']]);
            })
            ->when($data['date'], function ($query) use ($date) {
                return $query->whereBetween('created_at', [$date, now()]);
            })
            ->count();
        $lzddjy = Patient::query()
            ->when($data['platform_id'], function ($query) use ($data) {
                return $query->where('platform_id', $data['platform_id']);
            })
            ->where('origin_id', 3)
            ->where('is_to_store', true)
            ->where('project_id', 5)
            ->when($data['startDate'] && $data['endDate'], function ($query) use ($data) {
                return $query->whereBetween('created_at', [$data['startDate'], $data['endDate']]);
            })
            ->when($data['date'], function ($query) use ($date) {
                return $query->whereBetween('created_at', [$date, now()]);
            })
            ->count();

        // 业绩
        $lzyj = Patient::query()
            ->when($data['platform_id'], function ($query) use ($data) {
                return $query->where('platform_id', $data['platform_id']);
            })
            ->where('origin_id', 3)
            ->when($data['startDate'] && $data['endDate'], function ($query) use ($data) {
                return $query->whereBetween('created_at', [$data['startDate'], $data['endDate']]);
            })
            ->when($data['date'], function ($query) use ($date) {
                return $query->whereBetween('created_at', [$date, now()]);
            })
            ->sum('achievement');
        $lzyjjz = Patient::query()
            ->when($data['platform_id'], function ($query) use ($data) {
                return $query->where('platform_id', $data['platform_id']);
            })
            ->where('origin_id', 3)
            ->where('project_id', 2)
            ->when($data['startDate'] && $data['endDate'], function ($query) use ($data) {
                return $query->whereBetween('created_at', [$data['startDate'], $data['endDate']]);
            })
            ->when($data['date'], function ($query) use ($date) {
                return $query->whereBetween('created_at', [$date, now()]);
            })
            ->sum('achievement');
        $lzyjzz = Patient::query()
            ->when($data['platform_id'], function ($query) use ($data) {
                return $query->where('platform_id', $data['platform_id']);
            })
            ->where('origin_id', 3)
            ->where('project_id', 1)
            ->when($data['startDate'] && $data['endDate'], function ($query) use ($data) {
                return $query->whereBetween('created_at', [$data['startDate'], $data['endDate']]);
            })
            ->when($data['date'], function ($query) use ($date) {
                return $query->whereBetween('created_at', [$date, now()]);
            })
            ->sum('achievement');
        $lzyjqk = Patient::query()
            ->when($data['platform_id'], function ($query) use ($data) {
                return $query->where('platform_id', $data['platform_id']);
            })
            ->where('origin_id', 3)
            ->where('project_id', 3)
            ->when($data['startDate'] && $data['endDate'], function ($query) use ($data) {
                return $query->whereBetween('created_at', [$data['startDate'], $data['endDate']]);
            })
            ->when($data['date'], function ($query) use ($date) {
                return $query->whereBetween('created_at', [$date, now()]);
            })
            ->sum('achievement');
        $lzyjjc = Patient::query()
            ->when($data['platform_id'], function ($query) use ($data) {
                return $query->where('platform_id', $data['platform_id']);
            })
            ->where('origin_id', 3)
            ->where('project_id', 4)
            ->when($data['startDate'] && $data['endDate'], function ($query) use ($data) {
                return $query->whereBetween('created_at', [$data['startDate'], $data['endDate']]);
            })
            ->when($data['date'], function ($query) use ($date) {
                return $query->whereBetween('created_at', [$date, now()]);
            })
            ->sum('achievement');
        $lzyjjy = Patient::query()
            ->when($data['platform_id'], function ($query) use ($data) {
                return $query->where('platform_id', $data['platform_id']);
            })
            ->where('origin_id', 3)
            ->where('project_id', 5)
            ->when($data['startDate'] && $data['endDate'], function ($query) use ($data) {
                return $query->whereBetween('created_at', [$data['startDate'], $data['endDate']]);
            })
            ->when($data['date'], function ($query) use ($date) {
                return $query->whereBetween('created_at', [$date, now()]);
            })
            ->sum('achievement');

        return view('indexes.operate', compact(
            'platforms',
            'platform',
            'projects',
            // 对话
            'dhyy', 'dhyyjz', 'dhyyzz', 'dhyyqk', 'dhyyjc', 'dhyyjy', 'dhdd', 'dhddjz', 'dhddzz', 'dhddqk', 'dhddjc', 'dhddjy', 'dhyj', 'dhyjjz', 'dhyjzz', 'dhyjqk', 'dhyjjc', 'dhyjjy',
            // 进电
            'jdyy', 'jdyyjz', 'jdyyzz', 'jdyyqk', 'jdyyjc', 'jdyyjy', 'jddd', 'jdddjz', 'jdddzz', 'jdddqk', 'jdddjc', 'jdddjy', 'jdyj', 'jdyjjz', 'jdyjzz', 'jdyjqk', 'jdyjjc', 'jdyjjy',
            // 留咨
            'lzyy', 'lzyyjz', 'lzyyzz', 'lzyyqk', 'lzyyjc', 'lzyyjy', 'lzdd', 'lzddjz', 'lzddzz', 'lzddqk', 'lzddjc', 'lzddjy', 'lzyj', 'lzyjjz', 'lzyjzz', 'lzyjqk', 'lzyjjc', 'lzyjjy'
        ));
    }

    public function customer(Request $request)
    {
        $data = $request->all([
            'user_id',
            'date',
            'startDate',
            'endDate'
        ]);

        $users = User::query()
            ->where('department_id', 1)
            ->get();

        if ($data['date'] == 'all') {
            $data['date'] = false;
        }

        $date = dateCheck($data['date']);

        $patientsCount = Patient::query()
            ->when($data['user_id'], function ($query) use ($data) {
                return $query->where('user_id', $data['user_id']);
            })
            ->when($data['date'], function ($query) use ($date) {
                return $query->whereBetween('created_at', [$date, now()]);
            })
            ->when($data['startDate'] && $data['endDate'], function ($query) use ($data) {
                return $query->whereBetween('created_at', [$data['startDate'], $data['endDate']]);
            })
            ->count();    // 录入客户数
        $patientsJz = Patient::query()
            ->when($data['user_id'], function ($query) use ($data) {
                return $query->where('user_id', $data['user_id']);
            })
            ->when($data['date'], function ($query) use ($date) {
                return $query->whereBetween('created_at', [$date, now()]);
            })
            ->when($data['startDate'] && $data['endDate'], function ($query) use ($data) {
                return $query->whereBetween('created_at', [$data['startDate'], $data['endDate']]);
            })
            ->where('project_id', 2)
            ->count();   // 矫正客户数
        $patientsZh = Patient::query()
            ->when($data['user_id'], function ($query) use ($data) {
                return $query->where('user_id', $data['user_id']);
            })
            ->when($data['date'], function ($query) use ($date) {
                return $query->whereBetween('created_at', [$date, now()]);
            })
            ->when($data['startDate'] && $data['endDate'], function ($query) use ($data) {
                return $query->whereBetween('created_at', [$data['startDate'], $data['endDate']]);
            })
            ->where('project_id', 1)
            ->count();   // 种植客户数
        $patientsQk = Patient::query()
            ->when($data['user_id'], function ($query) use ($data) {
                return $query->where('user_id', $data['user_id']);
            })
            ->when($data['date'], function ($query) use ($date) {
                return $query->whereBetween('created_at', [$date, now()]);
            })
            ->when($data['startDate'] && $data['endDate'], function ($query) use ($data) {
                return $query->whereBetween('created_at', [$data['startDate'], $data['endDate']]);
            })
            ->where('project_id', 3)
            ->count();   // 全科客户数
        $patientsJy = Patient::query()
            ->when($data['user_id'], function ($query) use ($data) {
                return $query->where('user_id', $data['user_id']);
            })
            ->when($data['date'], function ($query) use ($date) {
                return $query->whereBetween('created_at', [$date, now()]);
            })
            ->when($data['startDate'] && $data['endDate'], function ($query) use ($data) {
                return $query->whereBetween('created_at', [$data['startDate'], $data['endDate']]);
            })
            ->where('project_id', 5)
            ->count();   // 洁牙客户数
        $patientsJc = Patient::query()
            ->when($data['user_id'], function ($query) use ($data) {
                return $query->where('user_id', $data['user_id']);
            })
            ->when($data['date'], function ($query) use ($date) {
                return $query->whereBetween('created_at', [$date, now()]);
            })
            ->when($data['startDate'] && $data['endDate'], function ($query) use ($data) {
                return $query->whereBetween('created_at', [$data['startDate'], $data['endDate']]);
            })
            ->where('project_id', 4)
            ->count();   // 检查客户数

        $achievement = Patient::query()
            ->when($data['user_id'], function ($query) use ($data) {
                return $query->where('user_id', $data['user_id']);
            })
            ->when($data['date'], function ($query) use ($date) {
                return $query->whereBetween('created_at', [$date, now()]);
            })
            ->when($data['startDate'] && $data['endDate'], function ($query) use ($data) {
                return $query->whereBetween('created_at', [$data['startDate'], $data['endDate']]);
            })
            ->sum('achievement');   // 总业绩
        $achievementJz = Patient::query()
            ->when($data['user_id'], function ($query) use ($data) {
                return $query->where('user_id', $data['user_id']);
            })
            ->when($data['date'], function ($query) use ($date) {
                return $query->whereBetween('created_at', [$date, now()]);
            })
            ->when($data['startDate'] && $data['endDate'], function ($query) use ($data) {
                return $query->whereBetween('created_at', [$data['startDate'], $data['endDate']]);
            })
            ->where('project_id', 2)
            ->sum('achievement');   // 矫正业绩
        $achievementZh = Patient::query()
            ->when($data['user_id'], function ($query) use ($data) {
                return $query->where('user_id', $data['user_id']);
            })
            ->when($data['date'], function ($query) use ($date) {
                return $query->whereBetween('created_at', [$date, now()]);
            })
            ->when($data['startDate'] && $data['endDate'], function ($query) use ($data) {
                return $query->whereBetween('created_at', [$data['startDate'], $data['endDate']]);
            })
            ->where('project_id', 1)
            ->sum('achievement');   // 种植业绩
        $achievementQk = Patient::query()
            ->when($data['user_id'], function ($query) use ($data) {
                return $query->where('user_id', $data['user_id']);
            })
            ->when($data['date'], function ($query) use ($date) {
                return $query->whereBetween('created_at', [$date, now()]);
            })
            ->when($data['startDate'] && $data['endDate'], function ($query) use ($data) {
                return $query->whereBetween('created_at', [$data['startDate'], $data['endDate']]);
            })
            ->where('project_id', 3)
            ->sum('achievement');   // 全科业绩
        $achievementJy = Patient::query()
            ->when($data['user_id'], function ($query) use ($data) {
                return $query->where('user_id', $data['user_id']);
            })
            ->when($data['date'], function ($query) use ($date) {
                return $query->whereBetween('created_at', [$date, now()]);
            })
            ->when($data['startDate'] && $data['endDate'], function ($query) use ($data) {
                return $query->whereBetween('created_at', [$data['startDate'], $data['endDate']]);
            })
            ->where('project_id', 5)
            ->sum('achievement');   // 洁牙业绩
        $achievementJc = Patient::query()
            ->when($data['user_id'], function ($query) use ($data) {
                return $query->where('user_id', $data['user_id']);
            })
            ->when($data['date'], function ($query) use ($date) {
                return $query->whereBetween('created_at', [$date, now()]);
            })
            ->when($data['startDate'] && $data['endDate'], function ($query) use ($data) {
                return $query->whereBetween('created_at', [$data['startDate'], $data['endDate']]);
            })
            ->where('project_id', 4)
            ->sum('achievement');   // 检查业绩

        $appointment = Patient::query()
            ->when($data['user_id'], function ($query) use ($data) {
                return $query->where('user_id', $data['user_id']);
            })
            ->when($data['date'], function ($query) use ($date) {
                return $query->whereBetween('created_at', [$date, now()]);
            })
            ->when($data['startDate'] && $data['endDate'], function ($query) use ($data) {
                return $query->whereBetween('created_at', [$data['startDate'], $data['endDate']]);
            })
            ->where('is_appointment', true)
            ->count();  // 总预约数
        $appointmentJz = Patient::query()
            ->when($data['user_id'], function ($query) use ($data) {
                return $query->where('user_id', $data['user_id']);
            })
            ->when($data['date'], function ($query) use ($date) {
                return $query->whereBetween('created_at', [$date, now()]);
            })
            ->when($data['startDate'] && $data['endDate'], function ($query) use ($data) {
                return $query->whereBetween('created_at', [$data['startDate'], $data['endDate']]);
            })
            ->where('project_id', 2)
            ->where('is_appointment', true)
            ->count();
        $appointmentZh = Patient::query()
            ->when($data['user_id'], function ($query) use ($data) {
                return $query->where('user_id', $data['user_id']);
            })
            ->when($data['date'], function ($query) use ($date) {
                return $query->whereBetween('created_at', [$date, now()]);
            })
            ->when($data['startDate'] && $data['endDate'], function ($query) use ($data) {
                return $query->whereBetween('created_at', [$data['startDate'], $data['endDate']]);
            })
            ->where('project_id', 1)
            ->where('is_appointment', true)
            ->count();
        $appointmentQk = Patient::query()
            ->when($data['user_id'], function ($query) use ($data) {
                return $query->where('user_id', $data['user_id']);
            })
            ->when($data['date'], function ($query) use ($date) {
                return $query->whereBetween('created_at', [$date, now()]);
            })
            ->when($data['startDate'] && $data['endDate'], function ($query) use ($data) {
                return $query->whereBetween('created_at', [$data['startDate'], $data['endDate']]);
            })
            ->where('project_id', 3)
            ->where('is_appointment', true)
            ->count();
        $appointmentJy = Patient::query()
            ->when($data['user_id'], function ($query) use ($data) {
                return $query->where('user_id', $data['user_id']);
            })
            ->when($data['date'], function ($query) use ($date) {
                return $query->whereBetween('created_at', [$date, now()]);
            })
            ->when($data['startDate'] && $data['endDate'], function ($query) use ($data) {
                return $query->whereBetween('created_at', [$data['startDate'], $data['endDate']]);
            })
            ->where('project_id', 5)
            ->where('is_appointment', true)
            ->count();
        $appointmentJc = Patient::query()
            ->when($data['user_id'], function ($query) use ($data) {
                return $query->where('user_id', $data['user_id']);
            })
            ->when($data['date'], function ($query) use ($date) {
                return $query->whereBetween('created_at', [$date, now()]);
            })
            ->when($data['startDate'] && $data['endDate'], function ($query) use ($data) {
                return $query->whereBetween('created_at', [$data['startDate'], $data['endDate']]);
            })
            ->where('project_id', 4)
            ->where('is_appointment', true)
            ->count();

        $to_store = Patient::query()
            ->when($data['user_id'], function ($query) use ($data) {
                return $query->where('user_id', $data['user_id']);
            })
            ->when($data['date'], function ($query) use ($date) {
                return $query->whereBetween('created_at', [$date, now()]);
            })
            ->when($data['startDate'] && $data['endDate'], function ($query) use ($data) {
                return $query->whereBetween('created_at', [$data['startDate'], $data['endDate']]);
            })
            ->where('is_to_store', true)
            ->count();  // 到店总数
        $to_storeJz = Patient::query()
            ->when($data['user_id'], function ($query) use ($data) {
                return $query->where('user_id', $data['user_id']);
            })
            ->when($data['date'], function ($query) use ($date) {
                return $query->whereBetween('created_at', [$date, now()]);
            })
            ->when($data['startDate'] && $data['endDate'], function ($query) use ($data) {
                return $query->whereBetween('created_at', [$data['startDate'], $data['endDate']]);
            })
            ->where('project_id', 2)
            ->where('is_to_store', true)
            ->count();  // 到店总数
        $to_storeZh = Patient::query()
            ->when($data['user_id'], function ($query) use ($data) {
                return $query->where('user_id', $data['user_id']);
            })
            ->when($data['date'], function ($query) use ($date) {
                return $query->whereBetween('created_at', [$date, now()]);
            })
            ->when($data['startDate'] && $data['endDate'], function ($query) use ($data) {
                return $query->whereBetween('created_at', [$data['startDate'], $data['endDate']]);
            })
            ->where('project_id', 1)
            ->where('is_to_store', true)
            ->count();  // 到店总数
        $to_storeQk = Patient::query()
            ->when($data['user_id'], function ($query) use ($data) {
                return $query->where('user_id', $data['user_id']);
            })
            ->when($data['date'], function ($query) use ($date) {
                return $query->whereBetween('created_at', [$date, now()]);
            })
            ->when($data['startDate'] && $data['endDate'], function ($query) use ($data) {
                return $query->whereBetween('created_at', [$data['startDate'], $data['endDate']]);
            })
            ->where('project_id', 3)
            ->where('is_to_store', true)
            ->count();  // 到店总数
        $to_storeJy = Patient::query()
            ->when($data['user_id'], function ($query) use ($data) {
                return $query->where('user_id', $data['user_id']);
            })
            ->when($data['date'], function ($query) use ($date) {
                return $query->whereBetween('created_at', [$date, now()]);
            })
            ->when($data['startDate'] && $data['endDate'], function ($query) use ($data) {
                return $query->whereBetween('created_at', [$data['startDate'], $data['endDate']]);
            })
            ->where('project_id', 5)
            ->where('is_to_store', true)
            ->count();  // 到店总数
        $to_storeJc = Patient::query()
            ->when($data['user_id'], function ($query) use ($data) {
                return $query->where('user_id', $data['user_id']);
            })
            ->when($data['date'], function ($query) use ($date) {
                return $query->whereBetween('created_at', [$date, now()]);
            })
            ->when($data['startDate'] && $data['endDate'], function ($query) use ($data) {
                return $query->whereBetween('created_at', [$data['startDate'], $data['endDate']]);
            })
            ->where('project_id', 4)
            ->where('is_to_store', true)
            ->count();  // 到店总数

        $appointmentRate = chance($appointment, $patientsCount);
        $appointmentRateJz = chance($appointmentJz, $patientsJz);
        $appointmentRateZh = chance($appointmentZh, $patientsZh);
        $appointmentRateQk = chance($appointmentQk, $patientsQk);
        $appointmentRateJy = chance($appointmentJy, $patientsJy);
        $appointmentRateJc = chance($appointmentJc, $patientsJc);

        $to_store_rate = chance($to_store, $patientsCount);
        $to_store_rateJz = chance($to_storeJz, $patientsJz);
        $to_store_rateZh = chance($to_storeZh, $patientsZh);
        $to_store_rateQk = chance($to_storeQk, $patientsQk);
        $to_store_rateJy = chance($to_storeJy, $patientsJy);
        $to_store_rateJc = chance($to_storeJc, $patientsJc);

        $repaysCount = DB::table('repays')->select('patient_id')->distinct()->get()->count();
        $waitRepaysCount = $patientsCount - $repaysCount;

        $addWechatCount = Patient::where('is_add_wechat', true)->count();
        $waitWechatCount = $patientsCount - $addWechatCount;

        $patientsseasCount = Patient::where('user_id', 0)->count();

        $isIntroduceMany = Patient::where('is_introduce', true)->sum('achievement');
        $introduceCount = Patient::where('is_introduce', true)->count();

        return view('indexes.customer', compact('users',
                'patientsCount', 'patientsJz', 'patientsZh', 'patientsQk', 'patientsJy', 'patientsJc',
                'achievement', 'achievementJz', 'achievementZh', 'achievementQk', 'achievementJy', 'achievementJc',
                'appointment', 'appointmentJz', 'appointmentZh', 'appointmentQk', 'appointmentJy', 'appointmentJc',
                'to_store', 'to_storeJz', 'to_storeZh', 'to_storeQk', 'to_storeJy', 'to_storeJc',
                'appointmentRate', 'appointmentRateJz', 'appointmentRateZh', 'appointmentRateQk', 'appointmentRateJy', 'appointmentRateJc',
                'to_store_rate', 'to_store_rateJz', 'to_store_rateZh', 'to_store_rateQk', 'to_store_rateJy', 'to_store_rateJc',
                'repaysCount',
                'waitRepaysCount',
                'addWechatCount',
                'waitWechatCount',
                'patientsseasCount',
                'isIntroduceMany',
                'introduceCount'
            ));
    }
}
