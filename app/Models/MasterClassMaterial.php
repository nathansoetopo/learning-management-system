<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MasterClassMaterial extends Model
{
    use HasFactory, SoftDeletes, Uuids;

    protected $table = 'master_class_material';
    protected $guarded = ['id'];
}
