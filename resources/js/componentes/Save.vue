<template>

    

<div class="container mx-auto">
  <div class="mt-6 mb-2 px-6 py-4 bg-white shadow-md rounded-md">
<h1 v-if="post"   >Actualizar Post <span class="font-bold">{{post.title}}</span></h1>
<h1 v-else >Crear Post <span class="font-bold"></span></h1>
<form @submit.prevent="submit" >
     <div class="grid grid-cols-2 gap-3">
    <div class="col-span-2">
  <o-field label="Titulo" :variant="errors.title ? 'danger' : 'primary'" :message="errors.title">
        <o-input v-model="form.title"  value=""></o-input>
    </o-field></div>

  

    <o-field  label="Descripcion"  :variant="errors.descripcion ? 'danger' : 'primary'" :message="errors.descripcion">
        <o-input v-model="form.descripcion" type="textarea" value=""></o-input>
    </o-field>
    <o-field  label="Contenido"  :variant="errors.content ? 'danger' : 'primary'" :message="errors.content">
        <o-input v-model="form.content" type="textarea"  value=""></o-input>
    </o-field>

    <o-field label="Categoria" :variant="errors.category_id ? 'danger' : 'primary'" :message="errors.category_id">
        <o-select v-model="form.category_id"   placeholder="seleccione una catgeoria">
            <option v-for="c in categories" v-bind:key="c.id"  :value="c.id"  >{{c.title}}</option>
         
        </o-select>   
    </o-field>

    <o-field label="Posted" :variant="errors.posted ? 'danger' : 'primary'" :message="errors.posted">
        <o-select v-model="form.posted" placeholder="seleccione un estado">
            <option value="yes">Si</option>
            <option value="not">No</option>
        </o-select>   
    </o-field>

    <div class="flex gap-2" v-if="post">
        <o-field :message="fileError">
    <o-upload  v-model="filesDaD" multiple drag-drop>
        <section>
          <o-icon icon="upload"></o-icon>
          <span>Drag and drop para cargar</span>
        </section>
      </o-upload>
    </o-field>
    <span v-for="(file, index) in filesDaD" :key="index">
        {{ file.name }}
        <!-- <o-button icon-left="times" size="small" native-type="button" @click="deleteDropFile(index)">
        </o-button> -->
      </span>

      <!-- <o-button icon-left="upload" @click="upload"> Subir

      </o-button> -->

</div>



<div class="flex gap-2" v-if="post">
    <o-field :message="fileError">
<o-upload v-model="file" >
    <o-button tag="a" variant="primary">
      <o-icon icon="upload"></o-icon>
      <span>Click to uploads</span>
    </o-button>
  </o-upload>
</o-field>

  <o-button icon-left="upload" @click="upload"> Subir

  </o-button>

</div>




</div>
<div>

   <o-button variant="primary" native-type="submit" class="gap-2"> Enviar</o-button>

</div>
 
</form>
</div>
</div>
</template>
<script>
export default{
data() {
    return {
        categories:[],
        form:{
            title:"",
            descripcion:"",
            content:"",
            category_id:"",
            posted:"",

        },
        errors:{
            title:"",
            descripcion:"",
            content:"",
            category_id:"",
            posted:"",

        },
        post:"",
        file:null,
        filesDaD: [],
        fileError:"",
    };
},
async mounted(){//esat funcion es asincorna porque agregamos el AWAIT
    //si hay slug(id) obtener los datos y pintar la info en el form
    if(this.$route.params.slug){
      await  this.getPost();

        this.initPost();

    }


    
      //obtiene el slug del post que esta recibiendo
    //  console.log(this.$route.params.slug)
    //obtener las catgeorias para el select
    this.getCategory()
},
methods:{
    clearErrorsForm(){
        this.errors.title=""
        this.errors.descripcion=""
        this.errors.category_id=""
        this.errors.content=""
        this.errors.posted=""
    },
    submit(){
        //limpiar errores
        this.clearErrorsForm()
        const config ={
         
         headers: {Authorization: "Bearer "+ this.$root.token }
     };
        if(this.post =="")
        //enviar los datos
       return   this.$axios.post("/api/post",
        this.form,config
        ).then(res =>{
            this.$oruga.notification.open({
        message: 'Registro Creado!',
        variant: 'success',
        duration: 4000,
        closable:true,
        position: 'bottom-right'
      });
        }).catch(error =>{
            //atrapar errores del formulario
            console.log(error.response.data)

            //esto se puede mandar a un metodo para hacerlo mas limpio se manda el error.response.data
            if(error.response.data.title)
            this.errors.title= error.response.data.title[0]

            if(error.response.data.descripcion)
            this.errors.descripcion= error.response.data.descripcion[0]

            if(error.response.data.category_id)
            this.errors.category_id= error.response.data.category_id[0]

            if(error.response.data.posted)
            this.errors.posted= error.response.data.posted[0]

            if(error.response.data.content)
            this.errors.content= error.response.data.content[0]

           
        })

        
        //actualizar
          this.$axios.patch("/api/post/"+this.post.id,
        this.form,config
        ).then(res =>{
           
       this.$oruga.notification.open({
        message: 'Registro Actualizado!',
        variant: 'success',
        duration: 4000,
        closable:true,
        position: 'bottom-right'
      });
    

        }).catch(error =>{
            //atrapar errores del formulario
            console.log(error.response.data)

            
            if(error.response.data.title)
            this.errors.title= error.response.data.title[0]

            if(error.response.data.descripcion)
            this.errors.descripcion= error.response.data.descripcion[0]

            if(error.response.data.category_id)
            this.errors.category_id= error.response.data.category_id[0]

            if(error.response.data.posted)
            this.errors.posted= error.response.data.posted[0]

            if(error.response.data.content)
            this.errors.content= error.response.data.content[0]

           
        })

    },
    upload(){
     
      const formData =new FormData()
      formData.append("image",this.file)
        
     this.$axios.post("/api/post/upload/"+this.post.id, formData,{
    headers:{
     "Content-Type": "multipart/form-data",
     "Authorization": 'Bearer'+ this.$root.token 
    },
     })
     .then((res) => {
       console.log(res);
     })
     .catch ((error) =>{
        console.log(error.response.data);
        this.fileError = error.response.data.message;
     })
    },
   getCategory(){
    const config ={
         
            headers: {Authorization: "Bearer "+ this.$root.token }
        };
    //obtiene todas las categorias para el select
    this.$axios.get("/api/category/all",config).then(res => {
       this.categories =res.data
    })
   },
   async getPost(){
    //obtiene el post a editar esto al ser una promesa lo comentamos porque no esperara el proceso
    // this.$axios.get("/api/post/slug/"+this.$route.params.slug).then(res => {
    //    this.post =res.data
    // });
    //autorizar al api
    const config ={
         
         headers: {Authorization: "Bearer "+ this.$root.token }
     };
    //le ponemos el await para que espere a completarlo y proseguir con el proceso
     this.post = await this.$axios.get("/api/post/slug/"+this.$route.params.slug,config);
     this.post =this.post.data







   },
   initPost(){
    this.form.title=this.post.title;
    this.form.descripcion=this.post.descripcion;
    this.form.content=this.post.content;
    this.form.posted=this.post.posted;
    this.form.category_id=this.post.category_id;
   }

},
watch:{
    filesDaD:{
        handle(val){

        },
        deep:true
    }
}

}
   
</script>