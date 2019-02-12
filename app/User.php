<?php

namespace App;//namespace give identified, identified by namespace

 //dependencies
use Illuminate\Notifications\Notifiable;//use the file, illuminate is laragon code
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    //user have many post, one to many relationship
    public function posts(){
        return $this->hasMany('App\Post');
    }
}
