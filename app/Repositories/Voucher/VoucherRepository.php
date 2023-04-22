<?php

namespace App\Repositories\Voucher;

use LaravelEasyRepository\Repository;

interface VoucherRepository extends Repository{

    public function getAll(array $request);
    public function store(array $request);
    public function update($id, array $request);
    public function attach($id, array $master_class);
    public function show($id);
    public function delete($id);
    public function showByCode(array $request);
    public function user_attach($id, $user_id);
}
