<?php

namespace App\Repositories\Withdraw;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Withdraw;

class WithdrawRepositoryImplement extends Eloquent implements WithdrawRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(Withdraw $model)
    {
        $this->model = $model;
    }

    public function own($id)
    {
        return $this->model->where('user_id', $id)->get();
    }

    public function store($request)
    {
        return $this->model->create($request) ?? false;
    }

    public function update($id, $data)
    {
        $find = $this->model->find($id);

        return $find->update($data) ?? false;
    }
}
