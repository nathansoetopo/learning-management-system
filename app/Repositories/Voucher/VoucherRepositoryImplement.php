<?php

namespace App\Repositories\Voucher;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Voucher;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class VoucherRepositoryImplement extends Eloquent implements VoucherRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(Voucher $model)
    {
        $this->model = $model;
    }

    public function getAll(array $request){
        return $this->model->orderBy('start_date', 'desc')->get();
    }

    public function show($id)
    {
        return $this->model->with('master_class')->find($id);
    }

    public function showByCode(array $request)
    {
        return $this->model->withCount('users')->with(['master_class' => function($masterClass) use ($request){
            $masterClass->where('id', $request['master_class_id']);
        }, 'users' => function($users){
            $users->where('id', Auth::user()->id);
        }])->where('voucher_code', $request['voucher'])->where('start_date', '<=', Carbon::now())->where('end_date', '>=', Carbon::now())->first();
    }

    public function store(array $request){
        $insert = $this->model->create($request);

        return $insert ?? false;
    }

    public function update($id, array $request){
        $update = $this->model->find($id)->update($request);

        return $update ?? false;
    }

    public function attach($id, array $master_class){
        $this->model->find($id)->master_class()->sync($master_class);
    }

    public function user_attach($id, $user_id){
        $this->model->find($id)->users()->attach($user_id);
    }

    public function delete($id)
    {
        $this->model->find($id)->delete();
    }
}
