@extends('dashboard.layout')


@section('content')
    

<a class="btn btn-success" href="{{route("category.create")}}">Crear</a>

<table class="table" mb-3>
    <thead>
<tr>
<td>TITULO</td>

<td>ACCIONES</td>

</tr>
</thead>


<tbody>
@foreach($categories as $c)
<tr>
    <td>{{$c->title}}</td>
   
    <td>
        <a class="my-2 btn btn-primary" href="{{ route("category.show",$c) }}">Ver</a>
        <a class="my-2 btn btn-primary" href="{{ route("category.edit", $c) }}">Editar</a>
        
         <form action="{{ route("category.destroy",$c) }}" method="post">
            @method("DELETE")
            @csrf
            
          <button class="my-2 btn btn-danger" type="submit">Eliminars</button>
        
        </form>
     
    </td>
    
    </tr>
@endforeach

</tbody>
</table>

{{$categories->links()}}

@endsection