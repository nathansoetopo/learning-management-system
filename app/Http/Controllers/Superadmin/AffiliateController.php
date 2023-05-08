<?php

namespace App\Http\Controllers\Superadmin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Withdraw;
use Illuminate\Support\Facades\Auth;
use App\Services\Referal\ReferalService;
use App\Services\Withdraw\WithdrawService;

class AffiliateController extends Controller
{

    private $referalService;
    private $withdrawService;

    public function __construct(ReferalService $referalService, WithdrawService $withdrawService)
    {
        $this->referalService = $referalService;
        $this->withdrawService = $withdrawService;
    }

    public function index(){
        $data = $this->referalService->index();

        return view('dashboard.superadmin.affiliate.index', compact('data'));
    }

    public function detail($id){
        $referal = $this->referalService->detail($id);

        return view('dashboard.superadmin.affiliate.detail', compact('referal'));
    }

    public function income($user_id){
        $data = DB::select('select saldo.id, amount, SUM(amount) OVER (ORDER BY saldo.created_at) 
        as total_running, users.username, saldo.created_at from saldo JOIN transaction_log ON saldo.transaction_id = transaction_log.id JOIN users ON transaction_log.user_id = users.id WHERE saldo.user_id = "'.$user_id.'"');

        return response()->json([
            'data' => $data,
        ]);
    }

    public function withdraw($user_id){
        $data = Withdraw::where('user_id', $user_id)->get();

        return response()->json([
            'data' => $data,
        ]);
    }

    public function withdrawRequest(){
        $withdraws = Withdraw::with('user')->where('status', 'request')->get();

        return view('dashboard.superadmin.affiliate.withdraw-request', compact('withdraws'));
    }

    public function updateStatusWithdraw($id, Request $request){
        return $this->withdrawService->update($id, $request->except(['_token']));
    }
}
