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
                    if ($user->hasPermissionTo('crm.patients.list_all')) {
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
        $id = Auth::id();
        $users = $user->whereRaw("p_id = 1 and id != $id")->get();
        return view('crm.patients.create', compact('origins', 'projects', 'platforms', 'users'));
    }

    public function store(Request $request, Patient $patient)
    {
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
            return redirect()->route('admin.users.patients', Auth::id());
        }
    }

    public function show(Patient $patient)
    {
        $repays = $patient->repays()->orderBy('created_at', 'desc')->get();

        return view('crm.patients.show', compact('patient', 'repays'));
    }

    public function update(Request $request, Patient $patient)
    {
        $data = $request->all([
            'patient_id',
            'wechat',
            'store',
            'intention'
        ]);
        try {
            Patient::query()
                ->where('id', '=', $data['patient_id'])
                ->when(!is_null($data['wechat']), function ($query) use ($data) {
                    $query->update(['is_add_wechat' => $data['wechat']]);
                })
                ->when(!is_null($data['store']), function ($query) use ($data) {
                    $query->update(['is_to_store' => $data['store']]);
                })
                ->when(!is_null($data['intention']), function ($query) use ($data) {
                    $query->update(['is_introduce_intention' => $data['intention']]);
                });

            return $this->success();
        } catch (\Exception $exception) {
            Log::error('设置患者是否加微信异常：' . $exception->getMessage());

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
        return $this->resJson(0, '操作成功');
    }

    public function edit(Patient $patient, Origin $origin, Project $project, Platform $platform)
    {
        $origins = $origin::all();
        $projects = $project::all();
        $platforms = $platform::all();
        return view('crm.patients.edit', compact('patient', 'origins', 'projects', 'platforms'));
    }
}
