import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import Tarieven from '@/views/TarievenView.vue'
import About from '@/components/About.vue'
import Register from '@/components/Register.vue'
const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView
    },
    {
      path: '/about',
      name: 'about',

      component: About
    },
    {
      path: '/tarieven',
      name: 'tarieven',
      component: Tarieven
    },
    {
      path: '/register',
      name: 'register',
      component: Register
    }
  ]
})

export default router
