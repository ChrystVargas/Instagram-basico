<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';

    //Relacion Many to One Image
    public function image(){
        return $this->belongsTo('App\Models\Image', 'image_id');
    }

    //Relacion Many to One User
    public function user(){
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
