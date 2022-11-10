import { createRouter, createWebHistory } from "vue-router"

import List from '@/componentes/List.vue'
import Save from '@/componentes/Save.vue'

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
      }
]

const router = createRouter({
    history:createWebHistory(),
    routes: routes,
});


export default router;