<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Platform;
use App\Http\Traits\TraitResource;
use Illuminate\Support\Facades\Log;

class PlatformsController extends Controller
{
    use TraitResource;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $res = Platform::with('user')
                    ->paginate($request->input('limit',30));

            return $this->success('ok', $res->items(), $res->total());
        }

        return view('platforms.index');
    }

    public function create(Platform $platform)
    {
        $users = User::operater()->get();

        return view('platforms.create_and_edit', compact('users', 'platform'));
    }

    public function store(Request $request, Platform $platform)
    {
        $user_id = $request->user_id;
        $platform->name = $request->platform;
        $res = $platform->save();
        if ($res !== true) {
            return $this->error();
        } else {
            return $this->success(0, '操作成功');
        }
    }

    public function edit(Platform $platform)
    {
        $users = User::operater()->get();

        return view('platforms.create_and_edit', compact('platform', 'users'));
    }

    public function update(Request $request, Platform $platform)
    {
        $platform->user_id = $request->user_id;
        $platform->save();
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
