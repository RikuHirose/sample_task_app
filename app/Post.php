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
        'user_id', 'category_id', 'content', 'title'
    ];


    public function comments(){
      // 投稿はたくさんのコメントを持つ
      return $this->hasMany(\App\Comment::class, 'post_id');
    }

    public function category(){
      // 投稿は1つのカテゴリーに属する
      return $this->belongsTo(\App\Category::class,'category_id');
    }

    public function user(){
      // 投稿は1つのカテゴリーに属する
      return $this->belongsTo(\App\User::class,'user_id');
    }


}
