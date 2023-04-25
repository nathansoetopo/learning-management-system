<?php

namespace App\Repositories\TaskAsset;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\TaskAsset;

class TaskAssetRepositoryImplement extends Eloquent implements TaskAssetRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(TaskAsset $model)
    {
        $this->model = $model;
    }

    public function get($task_id)
    {
        return $this->model->where('task_id', $task_id)->get();
    }

    public function delete($id)
    {
        $data = $this->model->find($id);

        return $data->delete() ? ['status' => 'success', 'msg' => $data->name . ' Berhasil Dihapus'] : ['status' => 'error', 'msg' => $data->name . ' Gagal Dihapus'];
    }

    public function store($request){
        
        $create = $this->model->create([
            'task_id' => $request['task_id'],
            'name' => $request['name'],
            'type' => $request['type'],
            'url' => $request['asset']
        ]);

        return $create;
    }
}
