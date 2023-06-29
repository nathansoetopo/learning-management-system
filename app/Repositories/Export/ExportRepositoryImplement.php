<?php

namespace App\Repositories\Export;

use App\Models\Export;
use Exception;
use Illuminate\Support\Facades\DB;
use LaravelEasyRepository\Implementations\Eloquent;

class ExportRepositoryImplement extends Eloquent implements ExportRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(Export $model)
    {
        $this->model = $model;
    }

    public function transaction($request)
    {
        try{
            $data = DB::table('transaction_log')
            ->select([
                'transaction_log.id',
                'transaction_log.invoice_number',
                'transaction_log.status',
                'transaction_log.created_at',
                'transaction_log.pay',
                'master_class.name as master_class_name',
                'users.name as user_name',
                'users.email as user_email'
            ])
            ->join('master_class', 'transaction_log.master_class_id', '=', 'master_class.id')
            ->join('users', 'transaction_log.user_id', '=', 'users.id');
    
            if(!empty($request['start_date'])){
                $data = $data->whereDate('transaction_log.created_at', '>=', $request['start_date'] ?? null);
            }
    
            if(!empty($request['end_date'])){
                $data = $data->whereDate('transaction_log.created_at', '<=', $request['end_date'] ?? null);
            }
    
            $data = $data->orderBy('transaction_log.created_at', 'desc')->get();
    
            return $data;
        }catch(Exception $e){
            return $e->getMessage();
        }
    }
}
