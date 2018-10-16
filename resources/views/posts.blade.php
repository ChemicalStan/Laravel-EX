@extends('layouts.app')

@section('content')
    @if(count($people))
      {{$id}}
        <ul>
            @foreach($people as $person)
                <li>{{$person}}</li>
            @endforeach
        </ul>
    @endif
@stop 

@section('footer')

@stop 