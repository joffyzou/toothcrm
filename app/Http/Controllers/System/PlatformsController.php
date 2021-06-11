<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Models\Origin;
use App\Models\Patient;
use App\Models\Project;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Platform;
use App\Http\Traits\TraitResource;
use Illuminate\Support\Facades\Log;

class PlatformsController extends Controller
{
    use TraitResource;

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $res = Platform::with('user')
                    ->paginate($request->input('limit',30));

            return $this->success('ok', $res->items(), $res->total());
        }

        return view('system.platforms.index');
    }

    public function create(Platform $platform)
    {
        $users = User::operater()->get();

        return view('system.platforms.create_and_edit', compact('users', 'platform'));
    }

    public function store(Request $request, Platform $platform)
    {
        $platform->user_id = $request->user_id;
        $platform->name = $request->platform;
        $res = $platform->save();
        if ($res !== true) {
            return $this->error();
        } else {
            return redirect()->route('system.platforms.index');
        }
    }

    public function edit(Platform $platform)
    {
        $users = User::operater()->get();

        return view('system.platforms.create_and_edit', compact('platform', 'users'));
    }

    public function update(Request $request, Platform $platform)
    {
        $platform->name = $request->platform;
        $platform->user_id = $request->user_id;
        $platform->save();

        return redirect()->route('system.platforms.index');
    }

    public function destroy(Request $request)
    {
        $ids = $request->input('ids');
        if (!is_array($ids) || empty($ids)) {
            return $this->error('请选择删除项');
        }
        try {
            Platform::destroy($ids);
            return $this->success();
        } catch (\Exception $exception) {
            Log::error('删除平台异常：' . $exception->getMessage());
            return $this->error();
        }
    }
}
