<?php

namespace App\Repositories\User;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class UserRepositoryImplement extends Eloquent implements UserRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function getProfile($id){
        return $this->model->with(['userHasClass.masterClass', 'mentor.masterClass.materials'])->find($id);
    }

    public function userClass($master_class_id, $class_id)
    {
        $user = $this->model->withCount(['userHasClass' => function($q) use ($master_class_id){
            $q->where('user_has_class.master_class_id', $master_class_id)->where('end_time', '>=', Carbon::now());
        }])->find(Auth::user()->id);

        if($user->user_has_class_count < 1){
            $user->userHasClass()->attach($class_id, ['master_class_id' => $master_class_id]);

            !$user->hasRole('mentee') ? $user->assignRole('mentee') : false;   
        }

        return $user;
    }
}
