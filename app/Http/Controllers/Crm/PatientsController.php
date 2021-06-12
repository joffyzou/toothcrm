<?php

namespace App\Http\Controllers\Crm;

use App\Http\Controllers\Controller;
use App\Http\Traits\TraitResource;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Origin;
use App\Models\Platform;
use App\Models\Project;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PatientsController extends Controller
{
    use TraitResource;

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all([
                'name',
                'phone',
                'date',
                'startDate',
                'endDate'
            ]);
            $user = $request->user();
            $res = Patient::query()
                ->where(function ($query) use ($user) {
                    if ($user->hasPermissionTo('crm.seas')) {
                        return $query->where('user_id', '>', 0);
                    } else {
                        return $query->where('user_id', $user->id);
                    }
                })
                ->with(['origin', 'platform', 'project'])
                ->when($data['name'], function ($query) use ($data) {
                    return $query->where('name', $data['name']);
                })
                ->when($data['phone'], function ($query) use ($data) {
                    return $query->where('phone', $data['phone']);
                })
                ->withOrder($data['date'])
                ->when($data['startDate'] && $data['endDate'], function ($query) use ($data) {
                    return $query->whereBetween('created_at', [$data['startDate'], $data['endDate']]);
                })
                ->paginate($request->get('limit', 30));

            foreach ($res as $patient) {
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
            }

            return $this->success('ok', $res->items(), $res->total());
        }

        return view('crm.patients.index');
    }

    public function create(Origin $origin, Project $project, Platform $platform, User $user)
    {
        $origins = $origin::all();
        $projects = $project::all();
        $platforms = $platform::all();
        $users = User::query()
            ->where('department_id', 1)
            ->get();

        return view('crm.patients.create', compact('origins', 'projects', 'platforms', 'users'));
    }

    public function store(Request $request, Patient $patient)
    {
        $this->validate($request, [
            'phone' => 'unique:patients'
        ], [
            'phone.unique' => '已存在该电话联系人'
        ]);

        $data = $request->all([
            'name',
            'state',
            'phone',
            'project',
            'platform',

        ]);

        if ($request->users) {
            $patient->user_id = $request->users;
        } else {
            $patient->user_id = Auth::id();
        }

        $patient->name = $request->name;
        $patient->phone = $request->phone;
        $patient->project_id = $request->project;
        $patient->platform_id = $request->platform;
        $patient->origin_id = $request->origin;
        $patient->appointment_time = $request->appointment_time;
        $patient->is_add_wechat = $request->is_add_wechat;
        $patient->achievement = $request->achievement;
        $patient->note = $request->note;
        $patient->state = $request->state;
        if ($patient->save()) {
            return redirect()->route('crm.patients.index', Auth::id());
        }
    }

    public function show(Patient $patient)
    {
        $repays = $patient->repays()->orderBy('created_at', 'desc')->get();

        return view('crm.patients.show', compact('patient', 'repays'));
    }

    public function edit(Patient $patient, Origin $origin, Project $project, Platform $platform)
    {
        $origins = $origin::all();
        $projects = $project::all();
        $platforms = $platform::all();
        return view('crm.patients.edit', compact('patient', 'origins', 'projects', 'platforms'));
    }

    public function update(Request $request)
    {
        $data = $request->all([
            'patient_id', 'name', 'phone', 'user_id', 'state', 'platform_id', 'origin_id', 'project_id', 'is_appointment',
            'is_add_wechat', 'is_to_store', 'is_introduce_intention', 'is_introduce', 'introducer', 'achievement', 'appointment_time',
            'note'
        ]);

        try {
            Patient::query()
                ->where('id', $data['patient_id'])
                ->when(!is_null($data['name']), function ($query) use ($data) {
                    $query->update(['name' => $data['name']]);
                })
                ->when(!is_null($data['phone']), function ($query) use ($data) {
                    $query->update(['phone' => $data['phone']]);
                })
                ->when(!is_null($data['user_id']), function ($query) use ($data) {
                    $query->update(['user_id' => $data['user_id']]);
                })
                ->when(!is_null($data['state']), function ($query) use ($data) {
                    $query->update(['state' => $data['state']]);
                })
                ->when(!is_null($data['platform_id']), function ($query) use ($data) {
                    $query->update(['platform_id' => $data['platform_id']]);
                })
                ->when(!is_null($data['origin_id']), function ($query) use ($data) {
                    $query->update(['origin_id' => $data['origin_id']]);
                })
                ->when(!is_null($data['project_id']), function ($query) use ($data) {
                    $query->update(['project_id' => $data['project_id']]);
                })
                ->when(!is_null($data['is_appointment']), function ($query) use ($data) {
                    $query->update(['is_appointment' => $data['is_appointment']]);
                })
                ->when(!is_null($data['is_add_wechat']), function ($query) use ($data) {
                    $query->update(['is_add_wechat' => $data['is_add_wechat']]);
                })
                ->when(!is_null($data['is_to_store']), function ($query) use ($data) {
                    $query->update(['is_to_store' => $data['is_to_store']]);
                })
                ->when(!is_null($data['is_introduce_intention']), function ($query) use ($data) {
                    $query->update(['is_introduce_intention' => $data['is_introduce_intention']]);
                })
                ->when(!is_null($data['is_introduce']), function ($query) use ($data) {
                    $query->update(['is_introduce' => $data['is_introduce']]);
                })
                ->when(!is_null($data['introducer']), function ($query) use ($data) {
                    $query->update(['introducer' => $data['introducer']]);
                })
                ->when(!is_null($data['achievement']), function ($query) use ($data) {
                    $query->update(['achievement' => $data['achievement']]);
                })
                ->when(!is_null($data['appointment_time']), function ($query) use ($data) {
                    $query->update(['appointment_time' => $data['appointment_time']]);
                })
                ->when(!is_null($data['is_to_store']), function ($query) use ($data) {
                    $query->update(['note' => $data['note']]);
                });

            return $this->success();
        } catch (\Exception $exception) {
            Log::error('更新患者信息异常：' . $exception->getMessage());

            return $this->error();
        }
    }

    public function updates(Request $request, Patient $patient)
    {
        $ids = json_decode($request->input('id'));
        $zid = $request->input('zid');
        foreach ($ids as $id) {
            $patient->find($id)->update([
                'user_id' => $zid,
                'created_at' => now()
            ]);
        }

        return $this->success('操作成功');
    }
}
