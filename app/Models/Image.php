<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'images';

    //Relacion One to Many Comments
    public function comments(){
        return $this->hasMany('App\Models\Comment')->orderBy('id','desc');
    }

    //Relacion One to Many Likes
    public function likes(){
        return $this->hasMany('App\Models\Like');
    }

    //Relacion Many to One User
    public function user(){
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
