<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MasterClassMaterial extends Model
{
    use HasFactory, SoftDeletes, Uuids, CascadeSoftDeletes;

    protected $table = 'master_class_material';
    protected $guarded = ['id'];
    protected $cascadeDeletes = ['sub_materials', 'tasks'];

    public function sub_materials(){
        return $this->hasMany(Material::class, 'master_class_material_id', 'id')->orderBy('created_at');
    }

    public function tasks(){
        return $this->hasMany(Task::class, 'master_class_material_id', 'id')->orderBy('created_at');
    }
}
