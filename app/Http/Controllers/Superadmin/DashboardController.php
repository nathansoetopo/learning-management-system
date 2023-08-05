<?php

namespace App\Http\Controllers\Superadmin;

use App\Models\User;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Certificate;

class DashboardController extends Controller
{
    public function index()
    {
        $event_count = DB::table('events')->select(DB::raw('COUNT(events.id) as event_count'))->first();

        $master_class_count = DB::table('master_class')->select(DB::raw('COUNT(master_class.id) as master_class_count'))->first();

        $mentor_count = User::role('mentor')->get()->count();

        $mentee_count = User::role('mentor')->get()->count();

        $certificates = Certificate::withCount('user')->orderBy('created_at', 'desc')->get(3);

        $total_income = DB::table('transaction_log')->sum('pay');

        $recently = DB::table('user_has_class')->select('users.avatar as user_avatar', 'users.name as user_name', 'users.email as user_email', 'master_class.name as master_class_name', 'class.name as class_name')
            ->join('users', 'user_has_class.user_id', '=', 'users.id')
            ->join('master_class', 'user_has_class.master_class_id', '=', 'master_class.id')
            ->join('class', 'user_has_class.class_id', '=', 'class.id')
            ->orderBy('user_has_class.created_at', 'desc')
            ->get();

        return view('dashboard.superadmin.dashboard', compact('event_count', 'master_class_count', 'mentor_count', 'mentee_count', 'certificates', 'recently', 'total_income'));
    }

    public function getTopMasterClass(){
        $top = DB::table('master_class')
        ->select([
            'master_class.name as master_class_name',
            DB::raw("COUNT(user_has_class.master_class_id) as user_count"),
        ])
        ->join('user_has_class', 'master_class.id', '=', 'user_has_class.master_class_id')
        ->groupBy('master_class_name')
        ->orderBy('user_count', 'desc')
        ->pluck('user_count', 'master_class_name')
        ->take(10);

        return response()->json([
            'name'  => $top->keys(),
            'count' => $top->values()
        ]);
    }

    public function getIncomeChart(){
        $transactions = Transaction::select(DB::raw("SUM(pay) as pay"), DB::raw("MONTHNAME(created_at) as month_name"))
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw("Month(created_at)"))
            ->pluck('pay', 'month_name');

        $transactions_month = $transactions->keys();
        $transactions_values = $transactions->values();

        return response()->json([
            'month'     => $transactions_month,
            'values'    => $transactions_values
        ]);
    }
}
