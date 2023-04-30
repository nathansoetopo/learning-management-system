<?php

namespace App\Services\Referal;

use App\Models\User;
use Illuminate\Support\Str;
use LaravelEasyRepository\Service;
use App\Repositories\Referal\ReferalRepository;
use App\Repositories\Voucher\VoucherRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReferalServiceImplement extends Service implements ReferalService
{

  /**
   * don't change $this->mainRepository variable name
   * because used in extends service class
   */
  protected $mainRepository;
  protected $voucherRepository;

  public function __construct(ReferalRepository $mainRepository, VoucherRepository $voucherRepository)
  {
    $this->mainRepository = $mainRepository;
    $this->voucherRepository = $voucherRepository;
  }

  public function confirm($request)
  {
    $get = $this->mainRepository->show($request->code);

    $user = User::with('claim')->find(Auth::user()->id);

    if (!$get || !empty($user->claim->first())) {
      return redirect()->back()->withErrors('Sudah Menggunakan Reedem atau Reedem Tidak Ditemukan');
    }

    if ($get->user_id == $user->id) {
      return redirect()->back()->withErrors('Tidak Dapat Menggunakan Reedem Sendiri');
    }

    DB::beginTransaction();

    try {
      // Create Voucher
      $voucher = $this->voucherRepository->create([
        'voucher_code' => 'AFF_' . Str::random(5),
        'start_date' => Carbon::now(),
        'end_date' => Carbon::now()->addMonth(),
        'capacity' => 1,
        'nominal' => 10000,
        'discount_type' => '-',
        'status' => 'active'
      ]);

      // Attach Users
      $this->mainRepository->users([
        'referal_id' => $get->id,
        'user_id' => $user->id
      ]);

      // Attach Voucher
      $voucher = $this->mainRepository->redeem([
        'referal_id' => $get->id,
        'voucher_id' => $voucher->id
      ]);

      DB::commit();

      return $voucher;
    } catch (Exception $e) {
      DB::rollBack();

      return $e;
    }
  }
}
