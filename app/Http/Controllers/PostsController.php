<?php

namespace App\Http\Controllers;
use App\Post;
use Illuminate\Http\Request;
use App\Http\Requests\CreatePostsRequest;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::newest();
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    // To validate a form i.e [to make sure all columns are
    // filled with the appropriate date], we'll have to create
    // a request using php artisan
    public function store(CreatePostsRequest $request)
    {
        // Post::create($request->all());
    // CREATING A POST AND UPLOADING FILE
        $input = $request->all();
        $file = $request->file('file');
        $name = $file->getClientOriginalName();
                  //PATH   ,IMAGE_NAME
        $file->move('images', $name);

        $input['path']= $name;
        Post::Create($input);
        echo 'this post has been created';

    // RETRIEVING FILE DATE FROM FORM
                             //form name
        // echo $file = $request->file('file');
        // echo '<br>';
        // echo $file->getClientOriginalName();
                    
            
    // VALIDATION OF FORM INPUTS
        // $this->validate($request, [
        //     'title'=>'required|max:8',
        //     'content'=>'required',

        // ]);

    

        // $post = new Post;
        // $post->title = $request->title;
        // $post->content = $request->content;
        // $post->save();
        // return redirect('/posts');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $post = Post::findOrFail($id);
        $post->update(['title'=>$request->title, 'content'=>$request->content]);
        return redirect('/posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Post::whereId($id)->delete();
        return redirect('/posts');
    }

    public function posts($id)
    {
        $people = ['Stanley', 'Bello', 'Samuel'];
        return view('posts', compact('people'))->with('id', $id);
    }

}
