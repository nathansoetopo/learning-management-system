<?php

namespace App\Models;

use App\Traits\Uuids;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

class Presence extends Model
{
    use LogsActivity;
    use HasFactory, SoftDeletes, Uuids, CascadeSoftDeletes;

    protected $table = 'presence';
    protected $guarded = ['id'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->setDescriptionForEvent(fn(string $eventName) => "Presence has been {$eventName} by ".Auth::user()->name)
        ->logOnly(['name']);
    }

    public function class(){
        return $this->belongsTo(ClassModel::class, 'class_id', 'id');
    }

    public function users(){
        return $this->belongsToMany(User::class, 'user_has_presence', 'presence_id', 'user_id')->withPivot('description', 'status')->withTimestamps();
    }

    public function scopeGetResponsible($query, $mentor_id){
        if($mentor_id){
            return $this->whereHas('class', function($class) use ($mentor_id){
                $class->where('responsible_id', $mentor_id);
            });
        }

        return $query;
    }

    public function scopeGetClass($query, $class_id){
        if($class_id){
            return $this->where('class_id', $class_id);
        }

        return $query;
    }
}
