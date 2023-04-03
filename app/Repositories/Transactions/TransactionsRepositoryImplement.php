<?php

namespace App\Repositories\Transactions;

use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use LaravelEasyRepository\Implementations\Eloquent;

class TransactionsRepositoryImplement extends Eloquent implements TransactionsRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(Transaction $model)
    {
        $this->model = $model;
    }

    public function create($request)
    {
        $this->model->create($request);
    }

    public function show($id){
        $data = $this->model->with(['master_class' => function($q){
            $q->with(['class' => function($class){
                $class->withCount('mentee')->orderBy('mentee_count');
            }]);
        }])->where('invoice_number', $id)->first();

        return $data->master_class;
    }

    public function transactionHistory(){
        $data = $this->model->with('master_class')->where('user_id', Auth::user()->id)->get();

        return $data;
    }

    public function updateStatus(array $request)
    {
        return $this->model->where('invoice_number', $request['merchantOrderId'])->first()->update([
            'status' => $request['status'],
        ]);
    }
}
