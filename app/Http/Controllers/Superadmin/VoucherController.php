<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVoucherRequest;
use App\Http\Requests\UpdateVoucherRequest;
use App\Services\Voucher\VoucherService;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    private $voucherService;

    public function __construct(VoucherService $voucherService)
    {
        $this->voucherService = $voucherService;
    }

    public function index(Request $request){
        $vouchers = $this->voucherService->getAll($request->all());

        return view('dashboard.superadmin.voucher.index', compact('vouchers'));
    }

    public function create(){
        return view('dashboard.superadmin.voucher.create');
    }

    public function store(StoreVoucherRequest $request){
        $insert = $this->voucherService->store($request);

        return redirect()->route('superadmin.vouchers.index')->with('success', 'Voucher '.$insert->voucher_code.' Berhasil Ditambahkan');
    }

    public function edit($id){
        $voucher = $this->voucherService->show($id);

        return view('dashboard.superadmin.voucher.edit', compact('voucher'));
    }

    public function update($id, UpdateVoucherRequest $request){
        $update = $this->voucherService->storeUpdate($id, $request);

        return $update;
    }

    public function updateStatus($id){
        return $this->voucherService->updateStatus($id);
    }

    public function delete($id){
        return $this->voucherService->delete($id);
    }
}
