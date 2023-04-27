<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaskAsset extends Model
{
    use HasFactory, SoftDeletes, Uuids;

    protected $table = 'tasks_assets';
    protected $guarded = ['id'];
}
