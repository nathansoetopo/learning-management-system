<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory, SoftDeletes, Uuids, CascadeSoftDeletes;
    protected $table = 'transaction_log';
    protected $guarded = ['id'];
    protected $cascadeDeletes = ['saldo'];

    public function master_class(){
        return $this->belongsTo(MasterClass::class, 'master_class_id', 'id');
    }

    public function saldo(){
        return $this->hasMany(Saldo::class, 'transaction_id', 'id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
