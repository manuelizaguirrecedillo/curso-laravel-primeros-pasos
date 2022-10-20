@extends('dashboard.layout')


<section>
    <h1>Actualizar postt  {{$category->title}}</h1>  

  @include('dashboard.fragment.errors-form')






  <form action="{{ route('category.update',$category->id) }}" method="post" >
 
   @method("PATCH")
   
   @include("dashboard.category.form")


</form>
</section>