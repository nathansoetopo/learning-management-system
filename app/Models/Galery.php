<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Galery extends Model
{
    use HasFactory, SoftDeletes, Uuids;

    protected $table = 'galery';
    protected $guarded = ['id'];

    public function event(){
        return $this->belongsTo(Event::class, 'event_id', 'id');
    }
}
