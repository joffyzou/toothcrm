<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Traits\TraitResource;
use App\Models\Patient;
use App\Models\Origin;
use App\Models\Platform;
use App\Models\Project;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Debugbar;

class PatientsController extends Controller
{
    use TraitResource;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request, User $user, Patient $patient)
    {
        $users = $user->where('p_id', 1)->get();
        if ($request->isMethod('PUT')) {
            $page = $request->input('page', 1);
            $limit = $request->input('limit', 10);
            $patients = $patient->with(['origin', 'platform', 'project'])
                ->where('user_id', 0)
                ->orderBy('created_at', 'desc')
                ->get();

            foreach ($patients as $patient) {
                $patient->origin_name = $patient->origin->name;
                $patient->project_name = $patient->project->name;
                $patient->platform_name = $patient->platform->name;
            }

            $res = self::getPageData($patients, $page, $limit);

            return self::resJson(0, '获取成功', $res['data'], ['count' => $res['count']]);
        }
        return view('patients.index', compact('users'));
    }

    public function create(Origin $origin, Project $project, Platform $platform, User $user)
    {
        $origins = $origin::all();
        $projects = $project::all();
        $platforms = $platform::all();
        $users = $user->where('p_id', 1)->get();

        return view('patients.create', compact('origins', 'projects', 'platforms', 'users'));
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
        if ($patient->save()) {
            return redirect()->route('admin.users.patients', Auth::id());
        }
    }

    public function show(Patient $patient)
    {
        $repays = $patient->repays()->orderBy('created_at', 'desc')->get();

        return view('patients.show', compact('patient', 'repays'));
    }

    public function update(Request $request, Patient $patient)
    {
        $info = $patient::find($patient->id);
        if (empty($info)) {
            return $this->resJson(1, '没有该条记录');
        }
        $res = $info->update($request->input());
        if ($res !== true) {
            return $this->resJson(1, $info->getError());
        } else {
            return $this->resJson(0, '操作成功');
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
        return view('patients.edit', compact('patient', 'origins', 'projects', 'platforms'));
    }
}
