<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\Post;
use App\Tag;


/*
|--------------------------------------------------------------------------
| Laravel Default Route
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
|   LARAVEL FORM VALIDATION.
|--------------------------------------------------------------------------
*/

Route::resource('/posts', 'PostsController');




/*
|--------------------------------------------------------------------------
| Laravel DATABASE Raw Queries
|--------------------------------------------------------------------------
*/
// LARAVEL INSERT QUERY
Route::get('/insert', function(){

    DB::insert("insert into posts(title, content) values(?, ?)", ['Laravel with php', 'Laravel is the best part of php']);
    return "POST ADDED";

});

// LARAVEL READ QUERY
Route::get('/read', function(){
    $results = DB::select("select * from posts");

    // return $results;
    foreach($results as $result){
        return $result->title;
    }
});

// LARAVEL UPDATE QUERY
Route::get('/update', function(){
   $update = DB::update("update posts set title = ? where id = ?", ['Updated Title', 1]);
   return $update;
});


// LARAVEL DELETE QUERY
Route::get('/delete', function(){
    DB::delete('delete from posts where id = ?', [2]);
    return "post deleted";
});

/*-------------------------------------------------------------------------
|--------------------------------------------------------------------------
|   ELOQUENT OR OBJECT RELATIONAL MAPPER [ORM]
|--------------------------------------------------------------------------
-------------------------------------------------------------------------*/

/*
|--------------------------------------------------------------------------
| RETRIEVING DATA FROM DATABASE
|--------------------------------------------------------------------------
*/
// QUERY TO FETCH ALL
Route::get('/show', function(){
    // 
    $posts = Post::all();
    
    // return $posts;

    foreach($posts as $post){
        return $post->title;
    }

});

// QUERY TO FETCH A PARTICULAR POST
Route::get('/find', function(){
    $post = Post::find(1);
    return $post->title;
});

// QUERY TO RETRIEVE INFORMATION USING CONDITIONS
Route::get('/display', function(){
    $posts = Post::where('id', 1)->orderBy('id', 'desc')->take(1)->get();
    return $posts;
});

// QUERY TO RETRIEVE DATA CONTAINING EXCEPTIONS
Route::get('/findMore', function(){
    $posts = Post::findOrFail(2);
    return $posts;
    // $posts = where('user_count', '<', 50)->findOrFail();
    // return $posts;
});

/*
|--------------------------------------------------------------------------
| INSERTING DATA INTO DATABASE USING ELOQUENT
|--------------------------------------------------------------------------
*/

// INSERTING DATA USING SAVE METHOD
Route::get('/basicInsert', function(){
    $post = new Post;
    $post->title = 'This is my first eloquent title';
    $post->content = 'This content contains my first eloquent statement';
    $post->save();
    return "Post created successfully";
});

// Updating data using eloquent save method
Route::get('/basicUpdate', function(){
    $post = Post::find(2);
    $post->title = 'First eloquent update';
    $post->content = 'Eloquent is php made easy';
    $post->save();
    return 'post updated succesfully';
});

// BEST WAY TO CREATE DATA FOR FORMS ** don't forget mass assigmnt settings
Route::get('/create', function(){
    Post::create(['title'=>'proper way to insert', 'content'=>'proper content insertion']);    
    return "post created succesfully";
});

// NORMAL CONVENTION FOR UPDATING POST USING THE UPDATE METHOD
Route::get('/updatePost', function(){
    Post::where('id', 2)->where('is_admin', 0)->update(['title'=>'i\'m supper exited to learn laravel', 'content'=>'THIS SHIT IS GETTING INTERESTING']);
    return 'post updated';
});

// DELETING USING ELOQUENT
Route::get('/basicDelete', function(){
    $post = Post::find(2);
    $post->delete();
    // THE DESTROY METHOD ABOVE IS USED WHEN USING THE KEY TO DELETE
    Post::destroy([3, 4]);
    return "Succesfully Deleted";
    // DELETING USING THE NORMAL ELOQUENT QUERY
    Post::where('id', 5)->where('is_admin', 0)->delete();
    return 'Deleted succes';
});

// SOFT DELETING USING ELOQUENT (DELETED FILE THAT CAN BE RECOVERED)
    // for this to be done, you have to create a new migration to add deleted_at
    // column to each table.. after this, use/include the softDeletes file into your
    // model and use it within the class extention, then create a protected dates instance
    // which should carry the deleted_at array in it, also create a dropColumn for rollback purpose in your migration..
Route::get('/softDelete', function(){
    $post = Post::find(3);
    $post->delete();
    return 'soft delete was successful!';
});

// HOW TO RETRIEVE SOFT DELETED DATAS FROM THE DATABASE
Route::get('/readsoftdelete', function(){
    // THIS METHOD RETRIEVES EVERYTHING INCLUDING THE TRASHED ITEMS
         $post = Post::withTrashed()->get();
         return $post;
    // THIS METHOD RETRIEVES ONLY THE TRASHED ITEMS
        // $post = Post::onlyTrashed()->get();
        // return $post;
});

// RESTORING DELETED ITEMS
Route::get('/restoreDeleted', function (){
    Post::withTrashed()->where('id', 2)->restore();
    return "Restored Succesfully";
});


// DELETING A RECORD PERMANENTLY
Route::get('forceDelete', function(){
// THIS DELETES ONLY THE TRASHED ITEM WITH EMPTY IS_ADMIN
    Post::onlyTrashed()->where('is_admin', 0)->forceDelete();
    return 'Deleted Parmanently';
// THIS DELETES EVERY COLUMN WITH AN EMPTY IS_ADMIN
    // Post::withTrashed()->whete('is_admin', 0)->forceDelete();
});


/*
|--------------------------------------------------------------------------
| ELOQUENT RELATONSHIPS
|--------------------------------------------------------------------------
*/
use App\User;

// ONE TO ONE RELATIONSHIP
Route::get('/user/{id}/post', function($id){
 // ModelName::find(userId)->functionName->column;
    return User::find($id)->post->title;
});

// INVERSE OF ONE TO ONE RELATIONSHIP
Route::get('/post/{id}/user', function($id){
// modelName::find(postId)->functionName->column;
    return Post::find($id)->user->name;
});

// ONE TO MANY ELOQUENT RELATIONSHIP
Route::get('/oneToMany', function(){
    $user = User::find(1);
    $posts = $user->posts;
    foreach($posts as $post){
        echo $post->title . "<br>";
    }

});


// MANY TO MANY ELOQUENT RELATIONSHIP
    // EXPLANATION:: find user with the id {id}, for 
    // that user, select the user role where it is equal
    // to the id of the user, return the role name.
Route::get('/user/{id}/role', function($id){
    $users = User::find($id);

    foreach($users->roles as $role){
        return $role->name;

    }
});

// THE INTERMEDIATE TABLE [PIVOT OR LOOKUP TABLE]
Route::get('/user/pivot', function(){
    $user = User::find(1);
    foreach($user->roles as $role){
        return $role->pivot->created_at;
    }
});

// HAS MANY THROUGH ELOQUENT RELATIONSHIP
use App\Country;

Route::get('/user/country', function(){
    $country = Country::find(4);
    foreach($country->posts as $post){
        echo $post->title;
    }
});

// LARAVEL POLYMORPHIC ELOQUENT RELATIONSHIP
use App\Photo;

    // to get a particular users image
Route::get('/user/photo', function(){
    $user = User::find(1);
    foreach($user->photos as $photo){
        return $photo->imageable_type;
    }

});
    // to get the image of a particular post
Route::get('/post/photo', function(){
    $post = Post::find(2);
    foreach ($post->photos as $photo) {
        return $photo->path;
    }
});

// INVERSE OF LARAVEL POLYMORPHIC ELOQUENT RELATIONSHIP
Route::get('/photo/{id}/owner', function($id){
    $photo = Photo::findOrFail($id);
                // function name in App\photo
    $owner = $photo->imageable;
    return $owner;
});


// MANY TO MANY POLYMORPHIC LARAVEL ELOQUENT RELATIONSHIP

Route::get('/post/tags', function() {
    $post = Post::find(1);
    foreach ($post->tags as $tag){
        echo $tag->name;
    }
});

Route::get('/tag/posts', function (){
    $tag = Tag::find(2);
    foreach($tag->posts as $post){
        echo $post->title;
    }
});

Route::get('/testinsert', function(){
    $user = User::findOrFail(1);
    $post = new Post(['title'=>'testing', 'content'=>'checking shits']);
    
    $user->post()->save($post);
    echo 'post Added';
});

/*
|--------------------------------------------------------------------------
| SIMPLE USES OF ROUTE
|--------------------------------------------------------------------------
*/
// PASSING PARAMETERS TO A ROUTE
    // Route::get('/collect/{id}/{name}', function($id,$name){
    //     return "Hello World " . $id . " " . $name ;
    // });

// RENAMEING A ROUTE PATH
    // Route::get('/homepage/class/nameshhd', array('as' => 'home.com', function (){
        
    //     $url = Route('home.com');
    //     return $url;

    // }));

// ROUTING A CONTROLLER AND PASSING PARAMETER TO IT
    // Route::get('/comments/{id}', 'CommentsController@index');

// USING A RESOURCE METHOD THAT LINKS TO A RESOURCE CONTROLLER
    // Route::resource('posts', 'PostController');

// ROUTE TO A VIEW
// Route::get('/posts/{id}', 'PostsController@posts');

// PASSING PARAMETERS FROM ROUTE TO VIEWS
    // Route::get('/savepost/{id}/{name}/{password}', 'CommentsController@create');






//*************OLD ROUTE DOCUMENTATIONS ******************/

// HOW TO PASS A PARAMETER TO A CONTROLLER {ORDINARY METHOD}
// Route::get('/emmanuel/{id}', 'PostController@index');

 // How to pass parameters through the route.
// Route::get('/post/{id}/{name}', function($id, $name){

// return "i'm please to inform you." . $id . " $name";

// });

// Naming Route

// Route::get('/home/class/rep', array('as'=>'home.class', function(){
// $url = route('home.class');
// return "<a href='{$url}' target='blank'>Click Here</a>";


// }));

// ROUTING A CONTROLLER {ORDINARY METHOD}
// Route::get('/posts', 'PostsController@index');

// HOW TO USE A RESOURCE ROUTING METHOD

// Route::resource('container', 'PostsController');


// Route::get('/contact/{id}', 'PostController@contact');

// Route::get('/show/{id}/{name}/{password}', 'PostController@showAll');
