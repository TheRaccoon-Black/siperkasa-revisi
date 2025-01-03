<?php

namespace App\Http\Controllers;

use App\Models\LoginLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginLogController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $sortBy = $request->get('sortBy');
        $sort = $request->get('sort', 'asc');

        $query = LoginLog::query();

        if (Auth::user()->role == 'petugas') {
            $query->whereHas('user', function ($query) {
                $query->where('role', 'petugas')->where('id', Auth::user()->id);
            });
        }

        if (!empty($search)) {
            $query->whereHas('user', function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%");
            });
        }

        if (!empty($sortBy) && is_string($sortBy) && in_array($sort, ['asc', 'desc'])) {
            if ($sortBy == 'logged_in_at') {
                $query->orderByRaw('CAST(' . $sortBy . ' AS UNSIGNED) ' . $sort);
            } else {
                $query->orderBy($sortBy, $sort);
            }
        }

        $logs = $query->paginate(10)->appends(request()->query());

        $rowCallback = function ($value, $field) {
            if ($field == 'user_id') {
                return User::find($value)->name;
            }

            if ($field == 'logged_in_at') {

                return \Carbon\Carbon::parse($value)->locale('id_ID')->translatedFormat('l, d-m-Y H:i:s');
            }

            return $value;
        };

        $sortable = (object) [
            'logged_in_at' => (object) ['label' => 'Waktu Login', 'field' => 'logged_in_at'],
        ];

        return view('login_logs.index', compact('logs', 'sortable', 'rowCallback'));
    }
}
