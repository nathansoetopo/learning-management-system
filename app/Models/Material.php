<?php

namespace App\Models;

use App\Traits\Uuids;
use Spatie\Activitylog\LogOptions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Material extends Model
{
    use LogsActivity;

    use HasFactory, SoftDeletes, Uuids, CascadeSoftDeletes;

    protected $table = 'material';
    protected $guarded = ['id'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->setDescriptionForEvent(fn(string $eventName) => "Material has been {$eventName} by ".Auth::user()->name)
        ->logOnly(['name']);
    }
}
