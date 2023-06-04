<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Certificate extends Model
{
    use HasFactory, Uuids, SoftDeletes;

    protected $table = 'certificate';
    protected $guarded = ['id'];
    protected $dates = ['realese_date'];

    public function class(){
        return $this->belongsToMany(ClassModel::class, 'certificate_class', 'certificate_id', 'class_id')->withTimestamps();
    }

    public function user(){
        return $this->belongsToMany(User::class, 'user_has_certificate', 'certificate_id', 'user_id')->withTimestamps();
    }
}
