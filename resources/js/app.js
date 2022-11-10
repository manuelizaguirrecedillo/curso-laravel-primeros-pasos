import './bootstrap';

import Alpine from 'alpinejs';

import {createApp}  from 'vue';
import app from './componentes/app.vue';

//ORUGA
import Oruga from '@oruga-ui/oruga-next'
import '@oruga-ui/oruga-next/dist/oruga.css'
import '@oruga-ui/oruga-next/dist/oruga-full.css'

//MATERIAL SEDIGN
import "@mdi/font/css/materialdesignicons.min.css"

//AXIOS
import axios from 'axios'

import router from "./componentes/router"


window.Alpine = Alpine;
Alpine.start();

const App = createApp(app).use(Oruga).use(router)
//implementar axios
App.config.globalProperties.$axios =axios
window.axios = axios
App.mount("#app");


