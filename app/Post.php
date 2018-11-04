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

// LARAVEL ELOQUENT RELATIONSHIP
    // Inverse of ONE TO ONE
    public function user(){
    // here belongsTo() is used instead of hasOne() because the user id is
    // found in the posts table and not the other way round. 
    // In a nutshell this fetches the user that belongs to a particular post
    // see User.php for a different column name.
        return $this->belongsTo('App\User');
    }
    
// POLYMORPHIC ELOQUENT RELATIONSHIP
    public function photos(){
    // This denotes that more than one images can be fetched from the Photo
    // model and the second parameter contains the name of the function that
    // buffers the image
        return $this->morphMany('App\Photo', 'imageable');
    }

}
