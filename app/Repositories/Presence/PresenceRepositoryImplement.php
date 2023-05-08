<?php

namespace App\Repositories\Presence;

use App\Models\User;
use App\Models\Presence;
use LaravelEasyRepository\Implementations\Eloquent;

class PresenceRepositoryImplement extends Eloquent implements PresenceRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(Presence $model)
    {
        $this->model = $model;
    }

    public function index()
    {
        return $this->model->with('class.masterClass')->get();
    }

    public function store($request)
    {
        $create = $this->model->create($request);

        $users = User::select('id')->whereHas('userHasClass', function($class) use ($request){
            $class->where('id', $request['class_id']);
        })->pluck('id')->toArray();

        $create->users()->attach($users, ['description' => '-']);

        return $create;
    }

    public function show($id)
    {
        return $this->model->with('users')->find($id);
    }

    public function update($id, $request)
    {
        $find = $this->model->find($id);

        return $find->update($request) ?? false;
    }

    public function delete($id)
    {
        $find = $this->model->find($id);

        return $find->delete() ?? false;
    }
}
