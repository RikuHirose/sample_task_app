<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'category_id', 'post',
    ];

    public function user()
    {
        return $this->belongsTo(\App\Post::class, 'user_id', 'id');
    }

    public function Comments(){
      // 投稿はたくさんのコメントを持つ
      return $this->hasMany(\App\Comment::class,, 'post_id');
    }

    public function Category(){
      // 投稿は1つのカテゴリーに属する
      return $this->belongsTo(\App\Category::class,'cat_id');
    }


}
