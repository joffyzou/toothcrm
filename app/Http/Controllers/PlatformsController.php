<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Platform;
use App\Http\Traits\TraitResource;

class PlatformsController extends Controller
{
    use TraitResource;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request, Platform $platform)
    {
        $platform->name = $request->platform;
        $res = $platform->save();
        if ($res !== true) {
            return $this->resJson(1, $res->getError());
        } else {
            return $this->resJson(0, '操作成功');
        }
    }
}
