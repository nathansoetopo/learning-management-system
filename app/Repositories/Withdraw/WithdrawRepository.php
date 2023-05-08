<?php

namespace App\Repositories\Withdraw;

use LaravelEasyRepository\Repository;

interface WithdrawRepository extends Repository{
    public function own($id);
    public function store($request);
    public function update($id, $data);
}
