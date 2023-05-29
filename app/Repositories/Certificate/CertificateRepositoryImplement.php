<?php

namespace App\Repositories\Certificate;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Certificate;
use Exception;
use Illuminate\Support\Facades\DB;

class CertificateRepositoryImplement extends Eloquent implements CertificateRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(Certificate $model)
    {
        $this->model = $model;
    }

    public function index()
    {
        return $this->model->get();
    }

    public function store($request)
    {
        DB::beginTransaction();
        try{
            $insert = $this->model->create($request['data']);

            $insert->class()->attach($request['class']['class_id']);

            DB::commit();

            return $insert;
        }catch(Exception $e){
            DB::rollBack();

            return $e->getMessage();
        }
    }

    public function show($id)
    {
        return $this->model->with('class')->find($id);
    }

    public function update($id, array $data)
    {
        DB::beginTransaction();
        try{
            $find = $this->model->find($id);

            $find->update($data['data']);
    
            $find->class()->sync($data['class']['class_id']);

            DB::commit();

            return $find;
        }catch(Exception $e){
            DB::rollBack();

            return $e->getMessage();
        }
    }

    public function delete($id)
    {
        $get = $this->model->find($id);

        $get->class()->detach();
        $get->delete();

        return $get;
    }
}
