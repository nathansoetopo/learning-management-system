<?php

namespace App\Services\Withdraw;

use App\Models\User;
use LaravelEasyRepository\Service;
use App\Repositories\Withdraw\WithdrawRepository;
use Illuminate\Support\Facades\Auth;

class WithdrawServiceImplement extends Service implements WithdrawService
{

  /**
   * don't change $this->mainRepository variable name
   * because used in extends service class
   */
  protected $mainRepository;

  public function __construct(WithdrawRepository $mainRepository)
  {
    $this->mainRepository = $mainRepository;
  }

  public function own($id)
  {
    return $this->mainRepository->own($id);
  }

  public function create($request)
  {
    $user = User::withSum('saldo', 'amount')->withSum('withdraw', 'amount')->find(Auth::user()->id);

    $check = $user->saldo_sum_amount - $user->withdraw_sum_amount;

    if($check < 0){
      return redirect()->back()->withErrors('Saldo Tidak Mencukupi');
    }

    $data = [
      'user_id' => $user->id,
      'amount' => $request->amount,
      'type' => $request->type,
      'address' => $request->address
    ];

    return $this->mainRepository->store($data);
  }

  public function update($id, $data)
  {
    return $this->mainRepository->update($id, $data);
  }
}
