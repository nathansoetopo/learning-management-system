<?php

namespace App\Repositories\MasterClassMaterial;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\MasterClassMaterial;

class MasterClassMaterialRepositoryImplement extends Eloquent implements MasterClassMaterialRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(MasterClassMaterial $model)
    {
        $this->model = $model;
    }

    public function create($data)
    {
        $insert = $this->model->create([
            'master_class_id' => $data['master_class_id'],
            'name' => $data['name'],
            'description' => $data['description']
        ]);

        return $insert ?? false;
    }

    public function show($request)
    {
        return $this->model->find($request['id']);
    }

    public function update($id, $data)
    {
        $get = $this->model->find($id);

        $update = $get->update($data);

        return $update ? $data : $get;
    }

    public function delete($id)
    {
        $data = $this->model->find($id);

        $delete = $data->delete();

        $delete ? ['status' => 'success', 'msg' =>'Materi Berhasil Dihapus'] : ['status' => 'error', 'msg' =>'Materi Gagal Dihapus'];
    }
}
