<?php

namespace App\Services\Voucher;

use Illuminate\Http\Request;
use LaravelEasyRepository\BaseService;

interface VoucherService extends BaseService{

    public function getAll(array $request);
    public function store(Request $request);
    public function storeUpdate($id, Request $request);
    public function show($id);
    public function updateStatus($id);
    public function delete($id);
    public function getVoucher(Request $request);
}
