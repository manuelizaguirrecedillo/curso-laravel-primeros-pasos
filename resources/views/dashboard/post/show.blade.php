@extends('dashboard.layout')

@section('content')
    <h1> {{$post->title}}</h1>  
    <p> {{$post->descripcion}}</p>
    <p> {{$post->posted}}</p>

    <div> <p> {{$post->content}}</p> </div>



</section>

@endsection