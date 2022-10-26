@extends('dashboard.layout')


@section('content')
    

    <h1>Actualizar postt  {{$post->title}}</h1>  

  @include('dashboard.fragment.errors-form')






  <form action="{{ route('post.update',$post->id) }}" method="post" enctype="multipart/form-data">
 
   @method("PATCH")
   
   @include("dashboard.post.form",["task" => "edit"])


</form>
@endsection

