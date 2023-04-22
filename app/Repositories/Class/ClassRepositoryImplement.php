<?php

namespace App\Repositories\Class;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Class;
use App\Models\ClassModel;

class ClassRepositoryImplement extends Eloquent implements ClassRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(ClassModel $model)
    {
        $this->model = $model;
    }

    public function getAll(array $request)
    {
        return $this->model->getByMentee($request['mentee_id'] ?? null)->get();
    }
}
