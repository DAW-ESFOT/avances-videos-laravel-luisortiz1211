<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = ['title', 'body'];
    //fillable campos que puedes editador a traves de la base de datos
}
