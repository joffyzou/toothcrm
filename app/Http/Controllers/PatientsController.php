<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Patient;
use App\Http\Traits\TraitResource;

class PatientsController extends Controller
{
    use TraitResource;

    public function index(Patient $patient, Request $request)
    {
        if ($request->isMethod('post')) {
            $page = $request->input('page', 1);
            $limit = $request->input('limit', 10);
            $list = $patient->orderBy('created_at', 'desc')->get();
            $res = self::getPageData($list, $page, $limit);

            return self::resJson(0, '获取成功', $res['data'], ['count' => $res['count']]);
        }
        return view('patients.index');
    }



    public function update(Request $request, Patient $patient)
    {
        $info = $patient::find($request->id);
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
}
