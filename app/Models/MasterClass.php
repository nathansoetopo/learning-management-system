<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MasterClass extends Model
{
    use HasFactory, SoftDeletes, Uuids;

    protected $table = 'master_class';
    protected $guarded = ['id'];
    protected $fillable = ['event_id', 'name', 'slug', 'image', 'active_dashboard', 'status'];

    public function event(){
        return $this->belongsTo(Event::class, 'event_id', 'id');
    }
}
