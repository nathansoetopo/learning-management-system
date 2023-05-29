<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CertificateClass extends Model
{
    use HasFactory, Uuids;

    protected $table = 'certificate_class';
    protected $guarded = ['id'];

    public function class(){
        return $this->belongsTo(ClassModel::class, 'class_id', 'id');
    }
}
