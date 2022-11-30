<template>
   <form @submit.prevent="submit">
    <o-field :variant="errors.login ? 'danger' : 'primary'"   label="Username">
        <o-input v-model="form.email">
        </o-input>
    </o-field>

    <o-field :variant="errors.login ? 'danger' : 'primary'" :message="errors.login" label="password" >
        <o-input v-model="form.password" type="password">
        </o-input>
       
    </o-field>

 <o-button variant="primary" native-type="submit" >Enviar</o-button>
   </form>
</template>

<script>
export default{

    created(){
        console.log("estalogeado"+this.$root.isLoggedin);
        if(this.$root.isLoggedin){ 

            this.$router.push({  name:"list" });
        }

    },

    methods:{
        cleanErrorsForm(){
            this.errors.login ="";
        },
    submit(){
            this.cleanErrorsForm();
            this.$axios.post("/api/user/login", this.form).then((res)=>{
               
                this.$root.setCookieAuth(res.data);

                setTimeout(() => (window.location.href="/vue",1500))

                console.log(res.data);
                this.$oruga.notification.open({
                message: "Login sucess",
                position: "bottom-right",
                duration: 1000,
                closable:true,
                });

            }).catch((error) => {
                console.log(error)
                if(error.response.data){
                    this.errors.login=error.response.data;
                }

            });
        },
        
},
    data(){
        return {
            form:{
                email:'',
                password:'',
            },
            errors:{
                login:"",
            }
        }
    }
}


</script>