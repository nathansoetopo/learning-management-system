<?php

namespace App\Repositories\Task;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Task;

class TaskRepositoryImplement extends Eloquent implements TaskRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(Task $model)
    {
        $this->model = $model;
    }

    public function getAll(){
        return $this->model->with('has_class', 'material')->get();
    }

    public function store($request)
    {
        return $this->model->create($request);
    }
}
