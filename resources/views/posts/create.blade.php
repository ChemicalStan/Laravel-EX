@extends('layouts.app')

@section('content')
<h1>Create Post</h1>
{{-- <form method="post" action="{{ action('PostsController@store')}}" enctype="multipart/form-data"> --}}
{!! form::open() !!}
    {{ csrf_field() }}
        <input type="text" placeholder="Enter Title" name="title">
        <input type="text" placeholder="Enter Content" name="content">
        <input type="submit" name="submit">
  </form>
@stop
@section('footer')

@stop

