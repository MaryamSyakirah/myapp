<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //Table Name
    protected $table = 'posts';
    //Primary Key
    public $primaryKey = 'id';
    //Timestamps
    public $timestamps = true;
    //post has relationship to user and belong to single post belong to a user, user
    public function user(){
        return $this->belongsTo('App\User');
    }
}
