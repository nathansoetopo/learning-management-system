<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Presence extends Model
{
    use HasFactory, SoftDeletes, Uuids, CascadeSoftDeletes;

    protected $table = 'presence';
    protected $guarded = ['id'];

    public function class(){
        return $this->belongsTo(ClassModel::class, 'class_id', 'id');
    }

    public function users(){
        return $this->belongsToMany(User::class, 'user_has_presence', 'presence_id', 'user_id')->withPivot('description', 'status')->withTimestamps();
    }
}
