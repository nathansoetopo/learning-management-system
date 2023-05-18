<?php

namespace App\Repositories\Class;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Class;
use App\Models\ClassModel;
use Carbon\Carbon;

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
        return $this->model->getByMentee($request['mentee_id'] ?? null)->getByMentor($request['mentor_id'] ?? null)->get();
    }

    public function show($id)
    {
        return $this->model->with(['masterClass.materials' => function($materials) use ($id){
            $materials->with(['tasks' => function($task) use ($id){
                $task->getClass($id);
            }, 'sub_materials' => function($sub_material) use ($id){
                $sub_material->where('class_id', $id);
            }]);
        }, 'mentor', 'tasks' => function($tasks){
            $tasks->where('end_date', '>=', Carbon::now());
        }, 'presence'])->find($id);
    }
}
