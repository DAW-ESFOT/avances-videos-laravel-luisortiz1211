<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Article extends Model
{
    protected $fillable = ['title', 'body','category_id','image'];
    //fillable campos que puedes editador a traves de la base de datos
    public static function boot()
    {
        parent::boot();
        static::creating(function ($article) {
            $article->user_id = Auth::id();
        });
    }


    public function comments (){
        return $this->hasmany('App\Comment');
    }
    public function user (){
        return $this->belongsto('App\User');
    }
}
