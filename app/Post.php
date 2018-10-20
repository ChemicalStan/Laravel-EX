<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
//  ANY CHANGES MADE HERE OVERIGHTS THE DEFAULT SETTINGS IN THE MODEL

    // protected $table = "posts";
    // protected $primaryKey = "post_id";

// MASS ASSIGMENT SETTINGS
    protected $fillable = [
        'title',
        'content'
    ];

}
