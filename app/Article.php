<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = ['title', 'body'];
    //fillable campos que puedes editador a traves de la base de datos

    public function comments (){
        return $this->hasmany('App\Comment');
    }
    public function user (){
        return $this->belongsto('App\User');
    }
}
