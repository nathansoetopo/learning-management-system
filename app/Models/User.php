<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Carbon\Carbon;
use App\Traits\Uuids;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Activitylog\LogOptions;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail, CanResetPassword
{
    use HasApiTokens, HasFactory, Notifiable, Uuids, HasRoles, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'phone',
        'gender',
        'password',
        'avatar',
        'address',
        'status',
        'email_verified_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function userHasClass(){
        return $this->belongsToMany(ClassModel::class, 'user_has_class', 'user_id', 'class_id')->withPivot('status')->withTimestamps();
    }

    public function certificate(){
        return $this->belongsToMany(Certificate::class, 'user_has_certificate', 'user_id', 'certificate_id')->withTimestamps();
    }

    public function cart(){
        return $this->belongsToMany(MasterClass::class, 'user_has_cart', 'user_id', 'master_class_id')->withTimestamps();
    }

    public function mentor(){
        return $this->hasMany(ClassModel::class, 'responsible_id', 'id');
    }

    public function voucher(){
        return $this->belongsToMany(Voucher::class, 'user_user_voucher', 'user_id', 'voucher_id')->withTimestamps();
    }

    public function referal(){
        return $this->hasOne(Referal::class, 'user_id', 'id');
    }

    public function claim(){
        return $this->hasOne(ReferalVoucher::class, 'user_id', 'id');
    }

    public function wishlists(){
        return $this->belongsToMany(MasterClass::class, 'user_has_wishlist', 'user_id', 'master_class_id');
    }

    public function saldo(){
        return $this->hasMany(Saldo::class, 'user_id', 'id')->whereHas('transaction', function($trans){
            $trans->where('status', 'success');
        })->orderBy('created_at', 'desc');
    }

    public function withdraw(){
        return $this->hasMany(Withdraw::class, 'user_id', 'id')->where('status', 'done')->orderBy('created_at', 'desc');
    }

    public function presence(){
        return $this->belongsToMany(Presence::class, 'user_has_presence', 'user_id', 'presence_id')->withPivot('status', 'description')->withTimestamps();
    }

    public function transaction(){
        return $this->hasMany(Transaction::class, 'user_id', 'id');
    }

    public function scopeGetWishlist($query){
        return $query->with(['wishlists' => function($w){
            $w->whereHas('class', function($c){
                $c->where('start_time', '>', Carbon::now());
            });
        }]);
    }
}
