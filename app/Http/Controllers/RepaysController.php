<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Repay;
use App\Http\Traits\TraitResource;

class RepaysController extends Controller
{
    use TraitResource;

    public function store(Request $request, Repay $repay)
    {
        $repay->admin_id = $request->admin_id;
        $repay->patient_id = $request->patient_id;
        $repay->repay = $request->repay;
        $res = $repay->save();
        if ($res !== true) {
            return $this->resJson(1, $info->getError());
        } else {
            return $this->resJson(0, '操作成功');
        }
    }

    public function updata()
    {

    }
}
