@extends('layouts.app')

@section('content')
<h1>Edit Post</h1>
<form method="post" action="{{ action('PostsController@update', $post->id)}}">
    {{ csrf_field() }}
    <input type="hidden" name="_method" value="PUT">
    <input type="text" name="title" value="{{$post->title}}">
    <input type="text" name="content" value="{{$post->content}}">
    <input type="submit" name="submit">
</form>
<form method="POST" action="{{action('PostsController@destroy', $post->id)}}">
    @csrf
    <input type="hidden" name="_method" value="DELETE">
    <input type="submit" name="delete" value="Delete">
</form>
@stop
@section('footer')

@stop