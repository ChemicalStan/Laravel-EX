@extends('layouts.app')

@section('content')
<h1>Edit Post</h1>
{{-- <form method="post" action="{{ action('PostsController@update', $post->id)}}"> --}}
{!!Form::model($post, ['method'=>'PATCH', 'action'=>['PostsController@update', $post->id]])!!}

    {!!Form::label('title', 'Title:')!!}
    {!!Form::text('title', $post->title, ['class'=>'form-control'])!!}
    {!!Form::label('content', 'Content:')!!}
    {!!Form::text('content', $post->content, ['class'=>'form-control'])!!}
    {!!Form::submit('Update Post', ['class'=>'btn btn-primary'])!!}

{!!Form::close()!!}
{{-- <form method="POST" action="{{action('PostsController@destroy', $post->id)}}"> --}}
{!!Form::open(['method'=>'DELETE', 'action'=>['PostsController@destroy', $post->id]])!!}
    {!!Form::submit('Delete', ['class'=>'btn btn-danger'])!!}
{!!Form::close()!!}
@stop
@section('footer')

@stop