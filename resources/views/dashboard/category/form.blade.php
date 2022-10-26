@csrf  <!! genera token para proteger los datos !!>
<label for="">Titulo</label>
 <input class="form-control" type="text" name="title" value="{{old("title",$category->title) }}" >

 <label for="">slug</label>
 <input class="form-control" type="text" name="slug" id="slug" value="{{old("slug",$category->slug) }}">
 

<button class="btn btn-success mt-3" type="submit">Enviar</button>
