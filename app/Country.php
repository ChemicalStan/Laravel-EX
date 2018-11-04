<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    //
    public function posts(){
//     HERE THE hasManyThrough() method is used. This method contains several
// parameters which are as follows: The main table, the intermediate table
// which depends on the first table for a common column [user_id], then the third
// parameter deals with the name of the row of the current class that is common 
// in the intermediary table [country_id], and the fourth parameter denotes the name
// of the secondary key column that relates to the second table found on the first or main
// table [user_id].
//     IN THIS SENERIO, WE WANT TO GET ALL THE POSTS CREATED BY USERS FROM A PARTICULAR 
// COUNTRY WHO'S ID IS SPECIFIED
//     Therefore, The COUNTRY table has many POSTS created THROUGH it's USERS
        return $this->hasManyThrough('App\Post', 'App\User');
    }
}
