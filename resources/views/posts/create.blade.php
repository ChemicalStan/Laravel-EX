@extends('layouts.app')

@section('content')
<h1>Create Post</h1>
{{-- <form method="post" action="{{ action('PostsController@store')}}" enctype="multipart/form-data"> --}}
{!! form::open(['method'=>'POST', 'action'=>'PostsController@store']) !!}
    {{-- {{ csrf_field() }} --}}
    <div class="form-group">
    {!!form::label('title', 'Title:')!!}
    {!!form::text('title', null, ['class'=>'form-control'])!!}
    {!!form::label('content', 'Content:')!!}
    {!!form::text('content', null, ['class'=>'form-control'])!!}
    </div>
    <div class="form-group">
        {!!form::submit('Create Post', ['class'=>'btn btn-primary'])!!}
    </div>
        {{-- <input type="text" placeholder="Enter Title" name="title">
        <input type="text" placeholder="Enter Content" name="content">
        <input type="submit" name="submit"> --}}
{!! form::close()!!}

@if(!empty($errors))
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
    </ul>

@endif()
@stop
@section('footer')

@stop

