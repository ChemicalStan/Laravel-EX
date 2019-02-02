<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    // THIS FETCHES ALL THE USERS WITH THESAME ROLE.
    public function users(){
        return $this->belongsToMany('App\User');
    }
}
