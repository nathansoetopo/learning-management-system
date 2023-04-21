<?php

namespace App\Repositories\Material;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Material;

class MaterialRepositoryImplement extends Eloquent implements MaterialRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(Material $model)
    {
        $this->model = $model;
    }

    public function store($request)
    {
        return $this->model->create($request);
    }

    public function show($id){
        return $this->model->find($id);
    }

    public function update($id, $request)
    {
        $get = $this->model->find($id);

        return $get->update($request);
    }

    public function delete($id)
    {
        $get = $this->model->find($id);

        return $get->delete($id);
    }
}
