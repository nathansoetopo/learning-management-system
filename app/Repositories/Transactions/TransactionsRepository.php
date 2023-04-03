<?php

namespace App\Repositories\Transactions;

use LaravelEasyRepository\Repository;

interface TransactionsRepository extends Repository{
    public function create($request);
    public function show($id);
    public function transactionHistory();
    public function updateStatus(array $request);
}
