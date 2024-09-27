import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import Tarieven from '@/views/TarievenView.vue'
import About from '@/components/About.vue'
import Register from '@/components/Register.vue'
import Contact from '@/components/Contact.vue'
import Login from '@/components/Login.vue'
import Dashboard from '@/components/Dashboard.vue'

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
    },
    {
      path: '/login',
      name: 'login',
      component: Login

    },
    {
      path: '/contact',
      name: 'contact',
      component: Contact

    },
    {
      path: '/dashboard',
      name: 'dashboard',
      component: Dashboard

    }
  ]
})

export default router
