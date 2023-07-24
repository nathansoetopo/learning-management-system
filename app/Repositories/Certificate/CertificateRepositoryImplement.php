<?php

namespace App\Repositories\Certificate;

use Exception;
use App\Models\Certificate;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use LaravelEasyRepository\Implementations\Eloquent;

class CertificateRepositoryImplement extends Eloquent implements CertificateRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(Certificate $model)
    {
        $this->model = $model;
    }

    public function index()
    {
        return $this->model->get();
    }

    public function store($request)
    {
        DB::beginTransaction();
        try{
            $insert = $this->model->create($request['data']);

            $insert->class()->attach($request['class']['class_id']);

            DB::commit();

            return $insert;
        }catch(Exception $e){
            DB::rollBack();

            return $e->getMessage();
        }
    }

    public function show($id)
    {
        return $this->model->with('class')->find($id);
    }

    public function update($id, array $data)
    {
        DB::beginTransaction();
        try{
            $find = $this->model->find($id);

            $find->update($data['data']);

            $find->class()->sync($data['class']['class_id']);

            DB::commit();

            return $find;
        }catch(Exception $e){
            DB::rollBack();

            return $e->getMessage();
        }
    }

    public function attachDetach($request)
    {
        try{
            $class_id = $request['class_id'];
            $user_id = $request['user_id'];

            $certificate = $this->model->withCount(['user' => function($user) use ($class_id, $user_id){
                $user->where('id', $user_id)->whereHas('userHasClass', function($class) use ($class_id){
                    $class->where('id', $class_id);
                });
            }])->find($request['certificate_id']);

            if($certificate->user_count > 0){
                $status = 'detach';
                $certificate->user()->detach($user_id);
            }else{
                $status = 'attach';
                $certificate->user()->attach($user_id, ['number' => 'GIT_'.Str::upper(Str::random(6))]);
            }

            return $status;
        }catch(Exception $e){
            return $e->getMessage();
        }
    }

    public function delete($id)
    {
        $get = $this->model->find($id);

        $get->class()->detach();
        $get->delete();

        return $get;
    }
}
