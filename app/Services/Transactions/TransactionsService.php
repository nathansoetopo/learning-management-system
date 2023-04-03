<?php

namespace App\Services\Transactions;

use LaravelEasyRepository\BaseService;

interface TransactionsService extends BaseService{

    public function create($request);
    public function callback($request);
    public function return($request);
    public function transactionCheck($request);
    public function transactionHistory();
}
