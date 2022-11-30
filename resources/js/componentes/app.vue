<template>
    <div>
      <!-- <Save/>   -->
      <nav class="bg-white border-b border-gray-100">

      
      <header class=" max-w-7x1 px-4 sm:px-6 lg:px-8">
        <div class="flex">
          <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="40" height="35" viewBox="0 0 262 227">
              <g id="Vue.js_logo_strokes" fill="none" fill-rule="evenodd">
                <g id="Path-2">
                  <polyline class="outer" stroke="#4B8" stroke-width="46" points="12.19 -24.031 131 181 250.351 -26.016" />
                </g>
                <g id="Path-3" transform="translate(52)">
                  <polyline class="inner" stroke="#354" stroke-width="42" points="15.797 -14.056 79 94 142.83 -17.863" />
                </g>
              </g>
        </svg>
          </div>



          <div class=" w-full flex py-4 px-4 sm:px-6 justify-between">
         
             <div class="flex h-8 items-center">  
               <router-link  class="mx-3 inline-flex py-1 uppercase border-b-2 text-sm leading-5 px-4 text-gray-600 text-center font-bold hover:border-gray-700 duration-150 transition-all hover:-translate-y-1" v-if="!$root.isLoggedin" :to="{name:'login'}"  > Login</router-link>
              <router-link  class="mx-3 inline-flex py-1 uppercase border-b-2 text-sm leading-5 px-4 text-gray-600 text-center font-bold hover:border-gray-700 duration-150 transition-all hover:-translate-y-1" v-if="$root.isLoggedin" :to="{name:'list'}"  > POST</router-link>
  
              <o-button v-if="$root.isLoggedin" variant="danger" @click="logout"> Logout</o-button>
              </div>
            <div class="flex flex-col items-center" v-if="$root.isLoggedin">
            <div class="rounded-full w-9 h-9 bg-blue-300 p-1 font-bold text-center">
              {{ $root.user.name.substr(0,2).toUpperCase()}}

            </div>
            <p >{{ $root.user.name}}</p>
           </div>

          </div>



        </div>
      </header>
  </nav>


  <div class="flex gap-3 bg-gray-200">
    
   
   
  </div>



      <router-view> 

      </router-view>
    </div>

</template>
<script>
import { DOMDirectiveTransforms } from '@vue/compiler-dom';

export default{
  data() {
    return {
      isLoggedin:false,
      user:'',
      token:'',
    }
  },
  created(){
    
    console.log("ola");
    if(window.Laravel.isLoggedin){
      console.log("loggedin");
      this.isLoggedin=true;
      this.user =window.Laravel.user;
      this.token=window.Laravel.token;

    }else{
     
      const auth= this.$cookies.get("auth");
      console.log(auth);
         if(auth){ console.log("ola3");
        this.isLoggedin=true;
        this.user =auth.user;
        this.token=auth.token;

        this.$axios.post('/api/user/token-check', {'token':auth.token})
      //  .then (() => {})
        .catch (() => {
          this.setCookieAuth("");
          window.location.href = "/vue/login";

        });
      }
      
    }
   
  },
  methods: {
    logout(){
      this.$axios.post('/api/user/logout',{
        token: this.token
      }).then(() =>{
        //destruir cookie
        this.setCookieAuth('');
       window.location.href = "/vue/login";

      })
    },
    setCookieAuth(data){
      this.$cookies.set('auth', data);
    }
  },

}

</script>






<!-- <script>

import Save from '@/componentes/Save.vue';
export default {
    components:{
    Save 
    }
}
</script> -->