<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Referal extends Model
{
    use HasFactory, SoftDeletes, Uuids;

    protected $table = 'referal';
    protected $guarded = ['id'];

    public function users(){
        return $this->belongsToMany(User::class, 'referal_has_users', 'referal_id', 'user_id')->withTimestamps();
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function voucher(){
        return $this->belongsToMany(Voucher::class, 'referal_has_voucher', 'referal_id', 'voucher_id')->withTimestamps();
    }
}
