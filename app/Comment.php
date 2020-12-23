<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['text'];

    public function user (){
        return $this->belongsto('App\User');
    }
    public function article (){
        return $this->belongsto('App\Article');
    }
}
