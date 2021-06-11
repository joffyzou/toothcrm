<?php

namespace App\Http\Controllers\Crm;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;

class SeasController extends Controller
{
    public function index(Request $request)
    {
        $users = User::query()
            ->where('department_id', 1)
            ->get();

        if ($request->ajax()) {
            $data = $request->all([
                'name',
                'phone',
                'date',
                'startDate',
                'endDate'
            ]);
            $res = Patient::query()
                ->where('user_id', '=', 0)
                ->with(['origin', 'platform', 'project'])
                ->when($data['name'], function ($query) use ($data) {
                    return $query->where('name', $data['name']);
                })
                ->when($data['phone'], function ($query) use ($data) {
                    return $query->where('phone', $data['phone']);
                })
                ->withOrder($data['date'])
                ->when($data['startDate'] && $data['endDate'], function ($query) use ($data) {
                    return $query->whereBetween('updated_at', [$data['startDate'], $data['endDate']]);
                })
                ->paginate($request->get('limit', 30));

            return $this->success('ok', $res->items(), $res->total());
        }

        return view('crm.seas.index', compact('users'));
    }
}
