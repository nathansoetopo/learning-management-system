<?php

namespace App\Repositories\EventRepositories;

use App\Models\Event;
use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\EventRepositories;

class EventRepositoriesRepositoryImplement extends Eloquent implements EventRepositoriesRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(Event $model)
    {
        $this->model = $model;
    }

    public function getAll($request = null){
        return $this->model->withCount('masterClass')->with('masterClass')->paginate($request['paginate'] ?? null);
    }

    public function find($id){
        return $this->model->find($id);
    }

    public function store($request)
    {
        $insert = $this->model->create($request);

        return $insert;
    }

    public function updateData($id, $request)
    {
        $update = $this->model->find($id);

        $update->update($request);

        return $update ?? false;
    }

    public function deleteData($id)
    {
        $data = $this->model->find($id);
        return $data->delete($id) ? ['status' => 'success', 'msg' => $data->name.' Berhasil Dihapus'] : ['status' => 'error', 'msg' => $data->name.' Gagal Dihapus'];
    }
}
