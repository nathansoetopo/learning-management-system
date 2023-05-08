<?php

namespace App\Services\Withdraw;

use LaravelEasyRepository\BaseService;

interface WithdrawService extends BaseService{
    public function own($id);
    public function create($request);
    public function update($id, $data);
}
