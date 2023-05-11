<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Referal extends Model
{
    use HasFactory, SoftDeletes, Uuids, CascadeSoftDeletes;

    protected $table = 'referal';
    protected $guarded = ['id'];
    protected $cascadeDeletes = ['voucher'];

    public function voucher(){
        return $this->hasMany(ReferalVoucher::class, 'referal_id', 'id')->orderBy('created_at', 'desc');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
