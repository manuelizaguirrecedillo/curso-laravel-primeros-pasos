@csrf  <!! genera token para proteger los datos !!>
<label for="">Titulo</label>
 <input type="text" name="title" value="{{old("title",$category->title) }}" >

 <label for="">slug</label>
 <input type="text" name="slug" id="slug" value="{{old("slug",$category->slug) }}">
 

<button type="submit">Enviar</button>
