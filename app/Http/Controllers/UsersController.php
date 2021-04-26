<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\TraitResource;
use Carbon\Carbon;
use App\Models\Origin;
use App\Models\Platform;
use App\Models\Project;

class UsersController extends Controller
{
    use TraitResource;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request, User $user, Role $role)
    {
        $roleId = Auth::user()->role_id;
        if ($request->isMethod('PUT')) {
            if ($roleId > 0) {
                $users = $user->where('p_id', $roleId)->get();
            } else {
                $users = $user->where('role_id', '>', 0)->get();
            }
            foreach ($users as $user) {
                $user->role = $role->find($user->role_id)->name;
                $user->joinTime = $user->created_at->diffForHumans();
            }
            $page = $request->input('page', 1);
            $limit = $request->input('limit', 30);
            $res = self::getPageData($users, $page, $limit);

            return self::resJson(0, '获取成功', $res['data'], ['count' => $res['count']]);
        }

        return view('users.index');
    }

    public function create(Role $role)
    {
        $roleId = Auth::user()->role_id;
        switch ($roleId) {
            case 1:
                $roles = $role->where('id', 2)->get();
                break;
            case 3:
                $roles = $role->where('id', 4)->get();
                break;
            default:
                $roles = $role->all();
        }

        return view('users.create', compact('roles'));
    }

    public function store(Request $request, User $user)
    {
        $data = $this->validate($request, [
            'username' => 'required|unique:users|max:50',
            'role_id' => 'required',
            'p_id' => 'required',
            'password' => 'required|min:6'
        ]);
        foreach ($data as $key => $value) {
            if (is_null($value)) continue;
            if ($key == 'password') {
                $user->$key = bcrypt($value);
                continue;
            }
            $user->$key = $value;
        }
        $user->save();

        return redirect()->route('admin.users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $info = $user->find($request->id);
        if (empty($info)) {
            return $this->resJson(1, '没有该条记录');
        }
        $res = $info->update([
            'username' => $request->input('username'),
            'password' => bcrypt($request->input('password'))
        ]);
        if ($res !== true) {
            return $this->resJson(1, $info->getError());
        } else {
            return $this->resJson(0, '操作成功');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    // 个人患者列表页
    public function patient(Request $request, User $user, Origin $origin, Project $project, Platform $platform)
    {
        $now = Carbon::now();   // 现在
        $today = Carbon::today();   // 今天
        $yesterday = Carbon::yesterday();   // 昨天
        $threeDay = Carbon::today()->modify('-3 days');  // 最近三天
        $sevenDay = Carbon::today()->modify('-7 days'); // 最近一周
        $fifteenDay = Carbon::today()->modify('-15 days');  // 最近15天
        $thirtyDay = Carbon::today()->modify('-30 days');   // 最近一个月

        if ($request->isMethod('post')) {
            $page = $request->input('page', 1);
            $limit = $request->input('limit', 10);
            $select_time = $request->input('created');
            $search_form = $request->input('form');
            $list = $user->patients()->orderBy('created_at', 'desc')->get();

            if ($select_time) {
                switch ($select_time) {
                    case 'today':
                        $list = $user->patients()->whereDate('created_at', '>=', $now)->get();
                        break;
                    case 'yesterday':
                        $list = $user->patients()->whereBetween('created_at', [$yesterday, $today])->get();
                        break;
                    case 'threeDay':
                        $list = $user->patients()->whereBetween('created_at', [$threeDay, $now])->get();
                        break;
                    case 'sevenDay':
                        $list = $user->patients()->whereBetween('created_at', [$sevenDay, $now])->get();
                        break;
                    case 'fifteenDay':
                        $list = $user->patients()->whereBetween('created_at', [$fifteenDay, $now])->get();
                        break;
                    case 'thirtyDay':
                        $list = $user->patients()->whereBetween('created_at', [$thirtyDay, $now])->get();
                        break;
                }
            }

            if ($search_form == 'form') {
                if ($request->input('key')) {
                    $key = $request->input('key');
                    $list = $user->patients()->where('phone', $key)->orWhere('name', $key)->get();
                } elseif ($request->input('dateBetween')) {
                    $dateBetween = explode('~', $request->input('dateBetween'));
                    $dateStart = Carbon::parse(trim($dateBetween[0]));   // 时间从小到大
                    $dateEnd = Carbon::parse(trim($dateBetween[1]));
                    $list = $user->patients()->whereBetween('created_at', [$dateStart, $dateEnd])->get();
                }
            }

            foreach ($list as $item) {
                $item->origin = $origin::find($item->origin_id)->name;
                $item->project = $project::find($item->project_id)->name;
                $item->platform = $platform::find($item->platform_id)->name;
                if (count($item->repays) > 0) {
                    $repay = $item->repays()->orderBy('created_at', 'desc')->first();
                    $repay_at = $repay->created_at->toDateTimeString();
                    $ditt = Carbon::parse($repay_at)->addDays(30);
                    $int = (new Carbon)->diffInHours($ditt, true);
                    $item->rema_time = $int . '小时';
                } else {
                    $item->rema_time = '0';
                }
                $item->repay_time = now();
                $item->store_time = Carbon::now();
            }


            $res = self::getPageData($list, $page, $limit);

            return self::resJson(0, '获取成功', $res['data'], ['count' => $res['count']]);
        }

        return view('users.patients');
    }

    public function patientsserch(User $user, Request $request, $id=null)
    {
        $ids = $request->all()['key']['id'];
        // dd($ids);
        $patients = $user->patients()->where('id', $ids)->get();
        $data = [
            'code' => 0,
            'data' => $patients
        ];
        return response()->json($data);
    }
}
