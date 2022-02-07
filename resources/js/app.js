import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import axios from 'axios'
import i18n from './i18n'

//check authentication
require('./store/subscriber')

import 'bootstrap'
import 'boxicons'
import 'bootstrap/dist/css/bootstrap.min.css'
import 'boxicons/css/boxicons.min.css'
// import tailwind
import '../../public/css/app.css'

require('./assets/css/style.css')

axios.defaults.baseURL = '/api';
axios.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem('token')}`

const app = createApp(App)
store.dispatch('auth/attempt', localStorage.getItem('token')).then(() => {
    app.use(router);
    app.use(store);
    app.use(i18n);
    app.mount('#app');
})

