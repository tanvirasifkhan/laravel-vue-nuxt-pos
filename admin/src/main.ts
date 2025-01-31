import { createApp } from 'vue'
import './assets/main.css'
import './assets/font.css'
import App from './App.vue'
import { router } from './routes/router'
import { createPinia } from 'pinia'
import Notifications from '@kyvg/vue3-notification'

createApp(App).use(router).use(createPinia()).use(Notifications).mount('#app')
