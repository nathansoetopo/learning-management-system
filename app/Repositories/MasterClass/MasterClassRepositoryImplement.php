<?php

namespace App\Repositories\MasterClass;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\MasterClass;

class MasterClassRepositoryImplement extends Eloquent implements MasterClassRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(MasterClass $model)
    {
        $this->model = $model;
    }

    public function getAll($request = null){
        return $this->model->withCount('class')->with('event', 'class')->paginate($request['paginate'] ?? null);
    }
}
