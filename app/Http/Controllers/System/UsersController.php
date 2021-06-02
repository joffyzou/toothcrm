<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $res = User::query()
                ->with('department')
                ->orderByDesc('id')
                ->paginate($request->get('limit', 30));

            return $this->success('ok', $res->items(), $res->total());
        }

        return view('system.users.index');
    }

    public function create()
    {
        return view('system.users.create');
    }

    public function store(Request $request)
    {
        $data = $request->all(['username', 'password', 'role_ids', 'department_id']);
        $data['role_ids'] = $data['role_ids'] == null ? [] : explode(',', $data['role_ids']);
        $data['password'] = bcrypt($data['password']);
        $count = User::query()->where('username', '=', $data['username'])->count();
        if ($count) {
            return $this->error('账号已存在');
        }
        try {
            $user = User::create($data);
            $user->syncRoles($data['role_ids']);
            return $this->success();
        } catch (\Exception $exception) {
            Log::error('添加用户异常：' . $exception->getMessage());
            return $this->error();
        }
    }

    public function edit(User $user)
    {
        return view('system.users.edit', compact('user'));
    }


    public function update(Request $request, User $user)
    {
        $this->authorize('update', $user);
        $info = $user->find($request->id);
        if (empty($info)) {
            return $this->resJson(1, '没有该条记录');
        }
        $res = $info->update([
            'username' => $request->input('username'),
            'password' => bcrypt($request->input('password'))
        ]);
        if ($res !== true) {
            return $this->resJson(1, $info->getError());
        } else {
            return $this->resJson(0, '操作成功');
        }
    }

    public function status(Request $request)
    {
        $parms = $request->all(['status', 'user_id']);
        try {
            User::query()->where('id', '=', $parms['user_id'])->update(['status' => $parms['status']]);

            return $this->success();
        } catch (\Exception $exception) {
            Log::error('设置用户状态异常：' . $exception->getMessage());

            return $this->error();
        }
    }

    public function destroy(Request $request)
    {
        $ids = $request->input('ids');
        if (!is_array($ids) || empty($ids)) {
            return $this->error('请选择删除项');
        }
        try {
            User::destroy($ids);

            return $this->success();
        } catch (\Exception $exception) {
            Log::error('删除用户异常：' . $exception->getMessage());

            return $this->error();
        }
    }

    public function patients(Patient $patient, Request $request, User $user)
    {
        if ($request->ajax()) {
            $page = $request->input('page', 1);
            $limit = $request->input('limit', 10);

            if ($user->is_admin) {
                $patients = $patient->withOrder($request->date)
                    ->with(['origin', 'platform', 'project'])
                    ->patients()
                    ->get();

                if ($request->name) {
                    $patients = $patient->where('name', $request->name)->get();
                } elseif ($request->phone) {
                    $patients = $patient->where('phone', $request->phone)->get();
                } elseif ($request->startDate && $request->endDate) {
                    $patients = $patient->whereBetween('created_at', [$request->startDate, $request->endDate])->get();
                }
            } else {
                $patients = $user->patients()
                    ->withOrder($request->date)
                    ->with(['origin', 'project', 'platform'])
                    ->recent()
                    ->get();

                if ($request->name) {
                    $patients = $user->patients()->where('name', $request->name)->get();
                } elseif ($request->phone) {
                    $patients = $user->patients()->where('phone', $request->phone)->get();
                } elseif ($request->startDate && $request->endDate) {
                    $patients = $user->patients()->whereBetween('created_at', [$request->startDate, $request->endDate])->get();
                }
            }

            foreach ($patients as $patient) {
                $currUserRepays = $patient->repays()->where('user_id', Auth::id())->count();   // 当前客服回访数
                if ($currUserRepays == 0) {
                    // 当没有回访时，剩余时间=录入时间+30天
                    $currRemaAdd = $patient->created_at->addDays(30);
                    if ($currRemaAdd->isPast() && is_null($patient->note)) {
                        $patient->user_id = 0;
                        $patient->save();
                    } else {
                        $remaTime = now()->diffInHours($currRemaAdd) . '小时';
                        $patient->rema_time = $remaTime;
                    }

                    // 当没有回访时，回访剩余=录入时间+15天
                    $currRepayAdd = $patient->created_at->addDays(15);
                    $remaRepayTime = now()->diffInHours($currRepayAdd) . '小时';
                    $patient->repay_time = $remaRepayTime;

                } else if ($currUserRepays < 5 && $currUserRepays > 0) {
                    // 客服A回访次数少于5时，每次回访重置剩余时间=最后回访时间+30天
                    $currRepayLast = $patient->repays()->where('user_id', Auth::id())->orderBy('created_at', 'desc')->first();
                    $currRemaAdd = $currRepayLast->created_at->addDays(30);
                    $remaTime = (new Carbon)->diffInHours($currRemaAdd, true) . '小时';
                    $patient->rema_time = $remaTime;

                    // 当客服A回访次数少于5时，每次回访重置回访剩余=最后回访时间+15天
                    $currRepayAdd = $currRepayLast->created_at->addDays(15);
                    $remaRepayTime = (new Carbon)->diffInHours($currRepayAdd, true) . '小时';
                    $patient->repay_time = $remaRepayTime;

                    // 剩余时间小于当前时间、没有特殊备注 流入公海
                    if ($currRemaAdd < now() && $patient->note != null) {
                        $patient->user_id = 0;
                    }
                } else {
                    $patient->rema_time = '0' . '小时';
                    $patient->repay_time = '0' . '小时';
                }

                // 当有预约时间，再计算 到店剩余
                if ($patient->appointment_time) {
                    $appointment_time = Carbon::parse($patient->appointment_time);
                    $remaAppointmentTime = (new Carbon)->diffInHours($appointment_time, true) . '小时';
                    $patient->store_time = $remaAppointmentTime;
                } else {
                    // 当30天没有预约
                    $patient->store_time = '0' . '小时';
                }
                $patient->origin_name = $patient->origin->name;
                $patient->project_name = $patient->project->name;
                $patient->platform_name = $patient->platform->name;
            }
            $res = self::getPageData($patients, $page, $limit);

            return self::resJson(0, '获取成功', $res['data'], ['count' => $res['count']]);
        }

        return view('users.patients');
    }
}
