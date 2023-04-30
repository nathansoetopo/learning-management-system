<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Voucher extends Model
{
    use HasFactory, SoftDeletes, Uuids;

    protected $table = 'vouchers';
    protected $guarded = ['id'];
    protected $dates = ['start_date', 'end_date'];

    public function master_class(){
        return $this->belongsToMany(MasterClass::class, 'master_class_has_voucher', 'voucher_id', 'master_class_id');
    }

    public function users(){
        return $this->belongsToMany(User::class, 'user_use_voucher', 'voucher_id', 'user_id');
    }

    public function referal(){
        return $this->belongsToMany(Referal::class, 'referal_has_voucher', 'voucher_id', 'referal_id')->withTimestamps();
    }
}
