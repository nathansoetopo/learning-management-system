<?php

namespace App\Repositories\MasterClass;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\MasterClass;
use Carbon\Carbon;

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
        return $this->model->getEvent($request['event_id'] ?? null)->withCount('class')->with('event', 'class')->paginate($request['paginate'] ?? null);
    }

    public function store($request)
    {
        $insert = $this->model->create($request);

        return $insert;
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function update($id, $data)
    {
        $update = $this->model->find($id);

        $update->update($data);

        return $update;
    }

    public function delete($id)
    {
        $data = $this->model->find($id);

        return $data->delete() ? ['status' => 'success', 'msg' => $data->name.' Berhasil Dihapus'] : ['status' => 'error', 'msg' => $data->name.' Gagal Dihapus'];
    }

    public function getUpcoming(){
        return $this->model->whereHas('class', function($query){
            $query->where('start_time', '>=', Carbon::now());
        })->get();
    }
}
