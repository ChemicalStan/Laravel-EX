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
        'content',
        'path'
    ];

    public $directory = "/images/";
// ACCESSOR ATTRIBUTE
public function getPathAttribute($value){
    
    return $this->directory . $value;
}


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

// POLYMORPHIC MANY TO MANY ELOQUENT RELATIONSHIP
    public function tags (){
        // This pushes info from the posts table to the tag table/model 
    // which inturn pushed to other tables like videos table etc... In
    // other words, this line of code below gives permission to the tags
    // model

                            // Path, Singular table name
        return $this->morphToMany('App\Tag', 'taggable');
    }


// LARAVEL QUERY SCOPE
    // This creates a static short cut to a long code. This static method is 
    // used later on
    public static function scopeNewest($query){
        return $query->orderBy('id', 'asc')->get();
    }
}
