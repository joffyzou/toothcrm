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

    public function index(Request $request, Platform $platform)
    {
        if ($request->ajax()) {
            $res = $platform->paginate($request->input('limit',30));

            return $this->success('ok', $res->items(), $res->total());
        }

        return view('platforms.index');
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
