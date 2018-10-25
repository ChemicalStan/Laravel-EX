<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// REQUIRED FOR SOFT DELETING
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
// TO IMPORT THE SOFTDELETE FILE TO THIS CLASS
    use SoftDeletes;
    protected $dates = ['deleted_at'];


//  ANY CHANGES MADE HERE OVERIGHTS THE DEFAULT SETTINGS IN THE MODEL

    // protected $table = "posts";
    // protected $primaryKey = "post_id";

// MASS ASSIGMENT SETTINGS
    protected $fillable = [
        'title',
        'content'
    ];

}
