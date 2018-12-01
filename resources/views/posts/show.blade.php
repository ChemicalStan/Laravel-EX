@extends('layouts.app')

@section('content')
<h1><a href="{{route('posts.edit', $post->id)}}">{{$post->title}}</a></h1>
<img style="max-height:20%; max-width:20%;" src="{{$post->path}}" alt="">

@stop
@section('footer')

@stop