<?php

namespace App;

use Illuminate\Notifications\Notifiable;
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
// FOR ONE TO ONE RELATIONSHIP
    public function post(){
    /* 
        // This command below goes to the App\Post model 
        // automatically to look for the user_id column
        // by default. if the column name is deferent from the
        // afformentioned, you indicate the column name by
        // adding a second parameter as follows:[, 'columnName']
        // to the hasOne(); method. And if the primary key 'id'
        // of the table is also different from the default 'id',
        // you add it to the hasOne method as a third parameter. */
// MEANING OF COMMAND:: This users table hasOne column in common with
        //      the posts table.
        return $this->hasOne('App\Post');
    }
    
// ONE TO MANY ELOQUENT RELATIONSHIP
    // This is used to  get more than one related column from the posts
    // table
    public function posts(){
        return $this->hasMany('App\post');
    }

// ONE TO MANY ELOQUENT RELATIONSHIP
    public function roles(){
        // HERE, THE withPivot() method indicates the rows we permit to return. 
        return $this->belongsToMany('App\Role')->withPivot('created_at');
    }

// POLYMORPHIC ELOQUENT RELATIONSHIP
    public function photos(){
    // This denotes that more than one images can be fetched from the Photo
    // model and the second parameter contains the name of the function that
    // buffers the image
        return $this->morphMany('App\Photo', 'imageable');
    }



}
