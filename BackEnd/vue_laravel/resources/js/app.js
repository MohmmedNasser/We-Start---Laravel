import './bootstrap';
import "bootstrap/dist/css/bootstrap.min.css"
import "bootstrap"

import { createApp } from "vue";
import router from './routes'
import App from './App.vue';
import Swal from 'sweetalert2';

window.Swal = Swal;

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
})

window.Toast = Toast;

createApp(App)
    .use(router)
    .mount('#app');
