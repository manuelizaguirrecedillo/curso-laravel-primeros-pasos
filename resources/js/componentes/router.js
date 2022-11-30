import { createRouter, createWebHistory } from "vue-router"

import List from '@/componentes/List.vue'
import Save from '@/componentes/Save.vue'
import Login from '@/componentes/Auth/login.vue'

import { useCookies } from "vue3-cookies"
const  { cookies } =useCookies()
const routes =[
    {
      name:"list",
      path:'/vue',
      component:List
    },
    {
        name:"save",
        path:'/vue/save/:slug?',
        component:Save
      },
    {
        name:"login",
        path:'/vue/login',
        component:Login
      }
]

const router = createRouter({
    history:createWebHistory(),
    routes: routes,
});

//validacion tambien e puede validad por individual en cada archivo
// router.beforeEach(async (to,from,next) => {

//    const auth = cookies.get('auth')
//   console.log(""+window.Laravel.isLoggedin)
//       if(auth && to.name != 'login'){
//         return next({name:'login'})
//       }

//   return   next()

// });


export default router;