import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'

import 'bootstrap'
import 'boxicons'
import 'bootstrap/dist/css/bootstrap.min.css'
import 'boxicons/css/boxicons.min.css'
// import tailwind
import '../../public/css/app.css'

const app = createApp(App)
app.use(router)
app.use(store)
app.mount('#app')