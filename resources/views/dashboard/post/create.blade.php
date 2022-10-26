@extends('dashboard.layout')


@section('content')
    <h1>Crear postt</h1>  

  @include('dashboard.fragment.errors-form');






  <form action="{{ route('post.store') }}" method="post">
      @include('dashboard.post.form');
</form>
</section>

@endsection