<?php

namespace App\Http\Controllers;

use App\Services\Transactions\TransactionsService;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    private $transactionService;

    public function __construct(TransactionsService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    public function create(Request $request)
    {
        $create = $this->transactionService->create($request->except(['_token']));

        return $create;
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
}
