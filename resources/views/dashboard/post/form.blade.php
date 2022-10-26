@csrf  <!! genera token para proteger los datos !!>
<label for="">Titulo</label>
 <input type="text" class="form-control" name="title" value="{{old("title",$post->title) }}" >

 <label for="">slug</label>
 <input type="text" class="form-control" name="slug" id="slug" value="{{old("slug",$post->slug) }}">
 <label for="">descripcion</label>
 <input type="text" class="form-control" name="descripcion" id="descripcion"  value="{{old("descripcion",$post->descripcion) }}"  >

 <label for="">contenido</label>
 <textarea name="content"  class="form-control"  > {{old("content",$post->content) }} </textarea>

 <label for="">categoria</label>
  <select   class="form-control" name="category_id" >
  @foreach ($categories as $title => $id)
      <option  {{old("category_id",$post->category_id) ==$id ? "selected" : " "}}  value="{{ $id }}"> {{ $title}}</option>
  @endforeach
  </select>
<label for="">posteado</label>
  <select     class="form-control" name="posted" id="">
      <option {{old("posted",$post->posted) =="not" ? "selected" : " "}}   value="not">No</option>
      <option {{old("posted",$post->posted) =="yes" ? "selected" : " "}}  value="yes">si</option>



  </select>

  @if ( isset($task) &&  $task==  'edit')
      <label for="">Imagen</label>
      <input type="file" name="image">
  @endif

<button class="btn btn-success" type="submit">Enviar</button>
