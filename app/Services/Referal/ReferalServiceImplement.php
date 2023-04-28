<?php

namespace App\Services\Referal;

use Illuminate\Support\Str;
use LaravelEasyRepository\Service;
use App\Repositories\Referal\ReferalRepository;
use App\Repositories\Voucher\VoucherRepository;
use Carbon\Carbon;

class ReferalServiceImplement extends Service implements ReferalService{

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

      if(!$get){
        return redirect()->back()->withErrors('Sudah Menggunakan Reedem');
      }

      $voucher = $this->voucherRepository->create([
        'voucher_code' => 'AFF_'.Str::random(5),
        'start_date' => Carbon::now(),
        'end_date' => Carbon::now()->addMonth(),
        'capacity' => 1,
        'nominal' => 10,
        'discount_type' => '%',
        'status' => 'active'
      ]);

      return $this->mainRepository->redeem([
        'referal_id' => $get->id,
        'voucher_id' => $voucher->id
      ]);
    }
}
