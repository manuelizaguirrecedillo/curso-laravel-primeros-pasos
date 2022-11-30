<template>
    <div class="container mx-auto">
        <div class="mt-6 px-6 py-4 bg-white shadow-md rounded-md">

       

     <o-modal v-model:active="confirmDeleteActive">
        <div class="p-4">
        <p>Seguro que quieres eliminar el registro</p>
        </div> 
        
        <div class="flex flex-row-reverse gap-2 bg-gray-300">
        <o-button  @click="confirmDeleteActive=false">Cancelar</o-button>
        <o-button variant="danger" @click="deletePost()">Eliminar</o-button>
        </div>
     </o-modal>

        <h1 >Listado de Post</h1>
        
        <o-button  iconLeft="plus"  @click="$router.push({name:'save'})"   :to="{name:'save'}">Crear</o-button>
        <!--  -->
        <div class="mb-5"> </div>
       
         <o-table :loading="isLoading" :data="posts.current_page && posts.data.length == 0 ? [] : posts.data">

            <o-table-column field="id" label="id" numeric v-slot="p"> 
                {{p.row.id}}
               
            </o-table-column>
            <o-table-column field="title" label="Titulo"  v-slot="p">
                {{p.row.title}}
            </o-table-column>
            <o-table-column field="posted" label="Posteado"  v-slot="p">
                {{p.row.posted}}
            </o-table-column>
            <o-table-column field="created_at" label="Fecha"  v-slot="p">
                {{p.row.created_at}}
            </o-table-column>
            <o-table-column field="category" label="Categoria"  v-slot="p">
                {{p.row.category.title}}
            </o-table-column>
            <o-table-column field="slug" label="Acciones"  v-slot="p">
                
                <router-link class="mr-3" :to="{name:'save', params:{'slug': p.row.slug }}">Editar</router-link>

                <o-button  iconLeft="delete" rounded  variant="danger" @click="deletePostRow=p; confirmDeleteActive=true" >Eliminar</o-button>



            </o-table-column>


         </o-table>

         <br>

         <o-pagination
        
         v-if="posts.current_page && posts.data.length > 0"

         @change="updatePage"
         :total="posts.total"
         v-model:current="currentPage"
         :range-before="2"
         :range-after="2"
          order="centered"
         size="small"
         :simple="false"
         :rounded="true"
         :per-page="posts.per_page"
        >
       </o-pagination>

    </div>
    </div>
</template>



<script>
export default {
    data() {
        return {
            posts : [],
            isLoading : true,
            currentPage: 1,
            confirmDeleteActive:false,
            deletePostRow:""
        }
    },
    
methods:{
    updatePage(){ 
    console.log("clickxx"+this.currentPage)
    setTimeout(this.listPage,100);
    },

    listPage(){
       //config para ingresar al ruta protegida de la api
        const config ={
         //   headers: {Authorization: `Bearer ${ this.$root.$cookies.get('auth').token }`},
           headers: {Authorization: "Bearer "+ this.$root.token }
        };
       
        this.isLoading =true;
        this.$axios.get("/api/post?page="+this.currentPage, config).then((res)=>{
        this.posts =res.data;
        this.isLoading =false;
        
        
       
       });

    },
    deletePost(){
         //config para ingresar al ruta protegida de la api
         const config ={
         //   headers: {Authorization: `Bearer ${ this.$root.$cookies.get('auth').token }`},
           headers: {Authorization: "Bearer "+ this.$root.token }
        };
    
     this.posts.data.splice(this.deletePostRow.index,1) ;  //el splice botrra los elementos y el siguiente parametro es para saber cuantos eliminar
     
     console.log(this.deletePostRow.row.id)
     console.log(this.deletePostRow.index)
     this.$axios.delete("/api/post/" + this.deletePostRow.row.id , config);

     this.confirmDeleteActive=false;
     
     this.$oruga.notification.open({
        message: 'Registro Eliminadoss!',
        variant: 'danger',
        duration: 4000,
        closable:true,
        position: 'bottom-right'
      });
    
    
    }
},

    async mounted(){
        console.log(this.$cookies.get('auth'))
        this.listPage();
      
      
    },
};
</script>