<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
// MANY TO MANY ELOQUENT POLYMORPHIC RELATIONSHIP
    public function posts(){
    // This catches the request from the tag function declared 
    // in the Post model
        return $this->morphedByMany('App\Post', 'taggable');
    }


    public function videos(){
                        //  the table name of the video id
        return $this->morphedByMany('App\Video', 'taggable');
    }
}
