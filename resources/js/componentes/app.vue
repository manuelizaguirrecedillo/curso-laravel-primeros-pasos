<template>
    <div>
      <!-- <Save/>   -->
      <header>
        <div class="flex gap-3 bg-gray-200">
          <router-link  v-if="!$root.isLoggedin" :to="{name:'login'}"  > Login</router-link>

          <o-button v-if="$root.isLoggedin" variant="danger" @click="logout"> Logout</o-button>
          <p v-if="$root.isLoggedin">{{ $root.user.name}}</p>
        </div>
      </header>

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