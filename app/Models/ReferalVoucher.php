<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ReferalVoucher extends Model
{
    use HasFactory, Uuids, SoftDeletes, CascadeSoftDeletes;

    protected $table = 'referal_has_voucher';
    protected $guarded = ['id'];

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function affiliate(){
        return $this->belongsTo(Referal::class, 'referal_id', 'id');
    }

    public function voucher(){
        return $this->belongsTo(Voucher::class, 'voucher_id', 'id');
    }
}
