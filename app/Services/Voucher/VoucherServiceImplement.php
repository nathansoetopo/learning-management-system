<?php

namespace App\Services\Voucher;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use LaravelEasyRepository\Service;
use App\Repositories\Voucher\VoucherRepository;
use Illuminate\Support\Facades\Auth;

class VoucherServiceImplement extends Service implements VoucherService
{

  /**
   * don't change $this->mainRepository variable name
   * because used in extends service class
   */
  protected $mainRepository;

  public function __construct(VoucherRepository $mainRepository)
  {
    $this->mainRepository = $mainRepository;
  }

  public function getAll(array $request)
  {
    return $this->mainRepository->getAll($request);
  }

  public function show($id)
  {
    return $this->mainRepository->show($id);
  }

  public function store(Request $request)
  {
    DB::beginTransaction();
    try {
      $insertVoucher = $this->mainRepository->store($request->except('master_class.*'));
      $this->mainRepository->attach($insertVoucher->id, $request->master_class);
      DB::commit();
      return $insertVoucher;
    } catch (Exception $e) {
      DB::rollBack();
      return $e;
    }
  }

  public function storeUpdate($id, Request $request)
  {
    DB::beginTransaction();
    try {
      $updateVoucher = $this->mainRepository->update($id, $request->except('master_class.*'));
      $this->mainRepository->attach($id, $request->master_class);
      DB::commit();
      return $updateVoucher;
    } catch (Exception $e) {
      DB::rollBack();
      return $e;
    }
  }

  public function updateStatus($id)
  {
    $data = $this->mainRepository->show($id);
    $status = $data->status == 'active' ? 'inactive' : 'active';
    return $this->mainRepository->update($id, [
      'status' => $status
    ]);
  }

  public function delete($id)
  {
    $this->mainRepository->delete($id);
  }

  public function getVoucher(Request $request){
    $getVoucher = $this->mainRepository->showByCode($request->all());

    if($getVoucher == null || $getVoucher->master_class->count() < 1 || $getVoucher->users->count() > 0 || $getVoucher->users_count >= $getVoucher->capacity){
      return 0;
    }

    return $getVoucher;
  }

  public function claimClass($voucherId, $masterClassId){
    return $this->mainRepository->attach($voucherId, [$masterClassId]);
  }
}
