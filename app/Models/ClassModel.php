<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClassModel extends Model
{
    use HasFactory, SoftDeletes, Uuids;
    protected $table = 'class';
    protected $guarded = ['id'];
    protected $dates = ['start_time', 'end_time'];

    public function masterClass(){
        return $this->belongsTo(MasterClass::class, 'master_class_id', 'id');
    }

    public function mentor(){
        return $this->belongsTo(User::class, 'responsible_id', 'id');
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

    public function mentee(){
        return $this->belongsToMany(User::class, 'user_has_class', 'class_id','user_id')->withPivot('status')->withTimestamps();;
    }
}
