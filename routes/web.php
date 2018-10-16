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




Route::get('/', function () {
    return view('welcome');
});

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
Route::get('/posts/{id}', 'PostsController@posts');

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
