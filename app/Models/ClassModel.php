<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClassModel extends Model
{
    use HasFactory, SoftDeletes, Uuids, CascadeSoftDeletes;
    protected $table = 'class';
    protected $guarded = ['id'];
    protected $dates = ['start_time', 'end_time'];
    protected $cascadeDeletes = ['tasks'];

    public function masterClass(){
        return $this->belongsTo(MasterClass::class, 'master_class_id', 'id');
    }

    public function presence(){
        return $this->hasMany(Presence::class, 'class_id', 'id');
    }

    public function mentor(){
        return $this->belongsTo(User::class, 'responsible_id', 'id');
    }

    public function certificate(){
        return $this->hasOne(CertificateClass::class, 'class_id', 'id');
    }

    public function scopeGetUncertifiedClass($query, $certificate){
        if($certificate){
            return $query->whereDoesntHave('certificate');
        }

        return $query;
    }

    public function scopeGetMasterClass($query, $masterClass){
        if($masterClass != null){
            return $query->where('master_class_id', $masterClass);
        }

        return $query;
    }

    public function scopeGetByMentee($query, $mentee_id){
        if($mentee_id != null){
            return $query->whereHas('mentee', function($q) use ($mentee_id){
                $q->where('id', $mentee_id);
            });
        }

        return $query;
    }

    public function scopeGetByMentor($query, $mentor_id){
        if($mentor_id != null){
            return $query->where('responsible_id', $mentor_id)->withCount('mentee')->with('masterClass')->orderBy('mentee_count', 'desc');
        }

        return $query;
    }

    public function mentee(){
        return $this->belongsToMany(User::class, 'user_has_class', 'class_id','user_id')->withPivot('status')->withTimestamps();
    }

    public function tasks(){
        return $this->hasMany(Task::class, 'class_id', 'id')->orderBy('created_at', 'desc');
    }
}
