<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MasterClassMaterial extends Model
{
    use HasFactory, SoftDeletes, Uuids, CascadeSoftDeletes;

    protected $table = 'master_class_material';
    protected $guarded = ['id'];
    protected $cascadeDeletes = ['sub_materials', 'tasks'];

    public function sub_materials(){
        return $this->hasMany(Material::class, 'master_class_material_id', 'id')->orderBy('created_at');
    }

    public function tasks(){
        return $this->hasMany(Task::class, 'master_class_material_id', 'id')->orderBy('created_at');
    }

    public function submission(){
        return $this->belongsToMany(User::class, 'user_has_tasks', 'master_class_material_id', 'user_id')->withPivot('task_id', 'url', 'submit_date', 'status', 'score');
    }

    public function score(){
        return $this->hasOne(Score::class, 'master_class_material_id', 'id')->latest();
    }

    public function masterClass(){
        return $this->belongsTo(MasterClass::class, 'master_class_id', 'id');
    }

    public function scopeGetScoreByUser($query, $user_id){
        if($user_id){
            return $query->with(['score' => function($score) use ($user_id){
                $score->where('user_id', $user_id);
            }]);
        }

        return $query;
    }
}
