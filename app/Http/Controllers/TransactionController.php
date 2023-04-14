<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\MasterClass\MasterClassService;
use App\Services\Transactions\TransactionsService;
use App\Services\Voucher\VoucherService;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    private $transactionService;
    private $masterClassService;
    private $voucherService;

    public function __construct(TransactionsService $transactionService, MasterClassService $masterClassService, VoucherService $voucherService)
    {
        $this->transactionService = $transactionService;
        $this->masterClassService = $masterClassService;
        $this->voucherService = $voucherService;
    }

    public function create(Request $request)
    {
        DB::beginTransaction();
        try{
            $create = $this->transactionService->create($request->except(['_token']));
            DB::commit();
            return $create;
        }catch(Exception $e){
            DB::rollBack();
            return $e;
        }
    }

    public function checkout($id){
        $masterClass = $this->masterClassService->find($id);
        $user = Auth::user();
        return view('landing_page.transaction.checkout', compact('masterClass', 'user'));
    }

    public function callback(Request $request){
        $this->transactionService->callback($request);
    }

    public function return(Request $request){
        return $this->transactionService->return($request->all());
    }

    public function transactionCheck(Request $request){
        return $this->transactionService->transactionCheck($request->all());
    }

    public function history(){
        $histories = $this->transactionService->transactionHistory();

        return view('landing_page.transaction.history', compact('histories'));
    }

    public function getVoucher(Request $request){
        return $this->voucherService->getVoucher($request);
    }
}
