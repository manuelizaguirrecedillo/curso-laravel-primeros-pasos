import './bootstrap';

import Alpine from 'alpinejs';

import {createApp}  from 'vue';
import app from './componentes/app.vue';

//tailwind
import '../css/vue.css'


//ORUGA
import Oruga from '@oruga-ui/oruga-next'
import '@oruga-ui/oruga-next/dist/oruga.css'
import '@oruga-ui/oruga-next/dist/oruga-full.css'
import '@oruga-ui/oruga-next/dist/oruga-full-vars.css'

//MATERIAL SEDIGN
import "@mdi/font/css/materialdesignicons.min.css"

//AXIOS
import axios from 'axios'
//cookie
import  VueCookies  from 'vue3-cookies';

import router from "./componentes/router"


window.Alpine = Alpine;
Alpine.start();

const App = createApp(app).use(Oruga).use(router).use(VueCookies)
//implementar axios
App.config.globalProperties.$axios =axios
window.axios = axios
App.mount("#app");


