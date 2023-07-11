<?php

namespace App\Models;

use App\Traits\Uuids;
use Spatie\Activitylog\LogOptions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use LogsActivity;

    use HasFactory, SoftDeletes, Uuids, CascadeSoftDeletes;

    protected $table = 'tasks';
    protected $guarded = ['id'];
    protected $dates = ['start_date', 'end_date'];
    protected $cascadeDeletes = ['assets'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->setDescriptionForEvent(fn(string $eventName) => "Task has been {$eventName} by ".Auth::user()->name)
        ->logOnly(['name']);
    }

    public function material(){
        return $this->belongsTo(MasterClassMaterial::class, 'master_class_material_id', 'id');
    }

    public function has_class(){
        return $this->belongsTo(ClassModel::class, 'class_id', 'id');
    }

    public function users(){
        return $this->belongsToMany(User::class, 'user_has_tasks', 'task_id', 'user_id')->withPivot(['url', 'submit_date', 'status', 'score', 'master_class_material_id'])->withTimestamps()->orderByPivot('created_at', 'desc');
    }

    public function assets(){
        return $this->hasMany(TaskAsset::class, 'task_id', 'id')->orderBy('created_at', 'desc');
    }

    public function scopeGetClass($query, $id){
        if($id != null){
            return $query->where('class_id', $id);
        }

        return $query;
    }
}
