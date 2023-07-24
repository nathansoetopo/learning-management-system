<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Predicate extends Model
{
    use HasFactory, Uuids, SoftDeletes;

    protected $table = 'predicate';
    protected $guarded = ['id'];

    public function predicate_score(){
        return $this->hasMany(PredicateScore::class, 'predicate_id', 'id')->orderBy('predicate');
    }
}
