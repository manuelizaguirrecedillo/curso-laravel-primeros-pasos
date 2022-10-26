@extends('dashboard.layout')



@section('content')

    <h1>Crear category</h1>  

  @include('dashboard.fragment.errors-form');






  <form action="{{ route('category.store') }}" method="post">
      @include('dashboard.category.form');
</form>
@endsection