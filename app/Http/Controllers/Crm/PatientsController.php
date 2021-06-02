<?php

namespace App\Http\Controllers\Crm;

use App\Http\Controllers\Controller;
use App\Http\Traits\TraitResource;
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
    public function index(Request $request, User $user, Patient $patient)
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
            'wechat'
        ]);
        try {
            Patient::query()->where('id', '=', $data['patient_id'])->update(['is_add_wechat' => $data['wechat']]);

            return $this->success();
        } catch (\Exception $exception) {
            Log::error('设置患者是否加微信异常：' . $exception->getMessage());
            return $this->error();
        }
//        $info = $patient::find($patient->id);
//        if (empty($info)) {
//            return $this->resJson(1, '没有该条记录');
//        }
//        $res = $info->update($request->input());
//        if ($res !== true) {
//            return $this->resJson(1, $info->getError());
//        } else {
//            return $this->resJson(0, '操作成功');
//        }
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
