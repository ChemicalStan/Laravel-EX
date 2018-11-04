<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    //
    public function imageable (){
    // This gives this model the ability to buffer 
    // images to another model
        return $this->morphTo();
    }
}
