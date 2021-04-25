<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Patient;
use App\Http\Traits\TraitResource;
use App\Models\Repay;
use App\Models\Origin;
use App\Models\Platform;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class PatientsController extends Controller
{
    use TraitResource;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Patient $patient, Request $request)
    {
        if ($request->isMethod('put')) {
            $page = $request->input('page', 1);
            $limit = $request->input('limit', 10);
            $list = $patient->where('admin_id', 0)->orderBy('created_at', 'desc')->get();
            $res = self::getPageData($list, $page, $limit);

            return self::resJson(0, '获取成功', $res['data'], ['count' => $res['count']]);
        }
        return view('patients.index');

    }

    public function create(Origin $origin, Project $project, Platform $platform)
    {
        $origins = $origin::all();
        $projects = $project::all();
        $platforms = $platform::all();
        return view('patients.create', compact('origins', 'projects', 'platforms'));
    }

    public function store(Request $request, Patient $patient)
    {
        $patient->admin_id = Auth::user()->id;
        $patient->name = $request->name;
        $patient->phone = $request->phone;
        $patient->project = $request->project;
        $patient->platform = $request->platform;
        $patient->origin = $request->origin;
        $patient->appointment_time = $request->appointment_time;
        $patient->is_add_wechat = $request->is_add_wechat;
        $patient->achievement = $request->achievement;
        $patient->note = $request->note;
        if ($patient->save()) {
            return redirect()->route('admin.admins.patients', Auth::user()->id);
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

    public function edit(Patient $patient, Origin $origin, Project $project, Platform $platform)
    {
        $origins = $origin::all();
        $projects = $project::all();
        $platforms = $platform::all();
        return view('patients.edit', compact('patient', 'origins', 'projects', 'platforms'));
    }
}
