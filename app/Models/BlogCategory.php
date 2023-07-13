<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    use HasFactory, Uuids;

    protected $table = 'article_categories';
    protected $guarded = ['id'];

    public function articles(){
        return $this->belongsToMany(Blog::class, 'article_has_category', 'article_category_id', 'article_id');
    }
}
