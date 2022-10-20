@extends('dashboard.layout')


<section>
    <h1>Crear category</h1>  

  @include('dashboard.fragment.errors-form');






  <form action="{{ route('category.store') }}" method="post">
      @include('dashboard.category.form');
</form>
</section>