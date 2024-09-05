import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import Tarieven from '@/views/TarievenView.vue'
import About from '@/components/About.vue'
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
    }
  ]
})

export default router
