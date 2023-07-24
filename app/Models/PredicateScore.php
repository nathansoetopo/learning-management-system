<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PredicateScore extends Model
{
    use HasFactory, Uuids;

    protected $table = 'predicate_score';
    protected $guarded = ['id'];
}
