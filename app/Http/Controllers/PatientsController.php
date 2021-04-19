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



    public function update(Request $request, $id)
    {
        return $request->all();
        // return self::resJson(0, '获取成功', $res['data'], ['count' => $res['count']]);
    }
}
