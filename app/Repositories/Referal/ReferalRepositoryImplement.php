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
        return $this->model->whereDoesntHave('users', function($user){
            $user->where('id', Auth::user()->id);
        })->whereDoesntHave('user', function($acc){
            $acc->where('id', Auth::user()->id);
        })->where('code', $id)->first();
    }

    public function redeem($request){
        $find = $this->model->find($request['referal_id']);

        $find->voucher()->attach($request['voucher_id']);

        return $request['voucher_id'];
    }
}
