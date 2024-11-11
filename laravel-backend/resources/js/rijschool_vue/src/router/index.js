import { createRouter, createWebHistory } from 'vue-router';
import HomeView from '../views/HomeView.vue';
import Tarieven from '../views/TarievenView.vue';
import About from '../components/About.vue';
import Register from '../components/Register.vue';
import Contact from '../components/Contact.vue';
import Login from '../components/Login.vue';
import Dashboard from '../components/Dashboard.vue';
import CrudLinks from '../components/CrudLinks.vue';
import api from '../services/api';

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
      component: Dashboard,
      meta: { requiresAuth: true }
    },
    {
      path: '/crudlinks',
      name: 'crudlinks',
      component: CrudLinks,
      meta: { requiresAuth: true }
    },
  ]
});

// Single `beforeEach` guard to handle authentication
router.beforeEach(async (to, from, next) => {
  // Check if the route requires authentication
  if (to.matched.some(record => record.meta.requiresAuth)) {
    try {
      // Call the API to verify the user is authenticated
      const response = await api.get('/api/user');
      if (response.data) {
        next(); // User is authenticated, allow access
      } else {
        next({ name: 'login' }); // User not authenticated, redirect to login
      }
    } catch (error) {
      console.error('Error in authentication check:', error);
      next({ name: 'login' }); // Redirect to login if an error occurs
    }
  } else {
    next(); // Route does not require authentication, allow access
  }
});

export default router;
