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

    public function voucher(){
        return $this->hasMany(ReferalVoucher::class, 'referal_id', 'id')->orderBy('created_at', 'desc');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
