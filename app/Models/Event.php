<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory, SoftDeletes, Uuids, CascadeSoftDeletes;

    protected $table = 'events';
    protected $guarded = ['id'];
    protected $cascadeDeletes = ['masterClass'];

    public function masterClass(){
        return $this->hasMany(MasterClass::class, 'event_id', 'id');
    }
}
