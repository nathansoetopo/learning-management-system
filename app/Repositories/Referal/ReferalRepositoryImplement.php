<?php

namespace App\Repositories\Referal;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Referal;
use Illuminate\Support\Facades\Auth;

class ReferalRepositoryImplement extends Eloquent implements ReferalRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(Referal $model)
    {
        $this->model = $model;
    }

    public function show($id)
    {
        return $this->model->whereDoesntHave('voucher.user', function($user){
            $user->where('id', Auth::user()->id);
        })->whereDoesntHave('user', function($own){
            $own->where('id', Auth::user()->id);
        })->where('code', $id)->first();
    }

    public function redeem($request){
        $find = $this->model->find($request['referal_id']);

        $find->voucher()->create([
            'voucher_id' => $request['voucher_id'],
            'user_id' => $request['user_id']
        ]);

        return $request['voucher_id'];
    }
}
