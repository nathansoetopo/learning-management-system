<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory, SoftDeletes, Uuids;

    protected $table = 'events';
    protected $guarded = ['id'];

    public function masterClass(){
        return $this->hasMany(MasterClass::class, 'event_id', 'id');
    }
}
