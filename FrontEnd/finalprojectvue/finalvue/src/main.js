import { createApp } from 'vue'
import { createPinia } from 'pinia'
import App from './App.vue'
import router from './router'

import './assets/main.css'
import '@fortawesome/fontawesome-free/css/all.css'
import axios from 'axios';

import piniaPluginPersistedstate from 'pinia-plugin-persistedstate'

import Toast from "vue-toastification";
import "vue-toastification/dist/index.css";

import { createI18n } from 'vue-i18n'

window.axios = axios;
axios.defaults.baseURL = 'http://127.0.0.1:8000/api/v1';

import messages from '../messages.json'

const pinia = createPinia();

const i18n = createI18n({
    locale: localStorage.getItem('locale') ?? 'en' , // set locale
    fallbackLocale: 'en', // set fallback locale
    messages, // set locale messages
})

// const pinia = createPinia()
// pinia.use(context => {
//     const storeId = context.store.$id

//     const serializer = {
//         serialize: JSON.stringify,
//         deserialize: JSON.parse
//     }

//     const data = serializer.deserialize(window.localStorage.getItem(storeId))

//     if(data) {
//         context.store.$patch(data)
//     }

//     context.store.$subscribe((m, s) => {
//         window.localStorage.setItem(storeId, serializer.serialize(s))
//     })

// })

const app = createApp(App)

// app.use( createPinia())
app.use(pinia)

// app.use(pinia)
pinia.use(piniaPluginPersistedstate)
app.use(Toast);
app.use(i18n)

app.use(router)

app.mount('#app')
