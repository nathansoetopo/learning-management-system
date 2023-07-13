<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory, Uuids;

    protected $table = 'article';
    protected $guarded = ['id'];

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function categories(){
        return $this->belongsToMany(BlogCategory::class, 'article_has_category', 'article_id', 'article_category_id');
    }

    public function scopeBlogTitle($query, $title){
        if($title){
            return $query->where('article.title', 'LIKE', '%'.$title.'%');
        }

        return $query;
    }

    public function scopeBlogCategory($query, $category_id){
        if($category_id){
            return $query->whereHas('categories', function($q) use ($category_id){
                $q->where('id', $category_id);
            });
        }

        return $query;
    }
}
