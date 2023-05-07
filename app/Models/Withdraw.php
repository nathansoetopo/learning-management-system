<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Withdraw extends Model
{
    use HasFactory, Uuids, SoftDeletes;

    protected $table = 'withdraw';
    protected $guarded = ['id'];

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
