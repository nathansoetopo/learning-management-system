<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory, SoftDeletes, Uuids;

    protected $table = 'tasks';
    protected $guarded = ['id'];
    protected $dates = ['start_date', 'end_date'];

    public function material(){
        return $this->belongsTo(MasterClassMaterial::class, 'master_class_material_id', 'id');
    }

    public function has_class(){
        return $this->belongsTo(ClassModel::class, 'class_id', 'id');
    }
}
