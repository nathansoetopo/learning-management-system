<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory, Uuids;

    protected $table = 'user_score';
    protected $guarded = ['id'];
}
