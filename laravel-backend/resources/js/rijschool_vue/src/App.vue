<template>
  <header>
    <nav class="navbar">
      <div class="dropdown invisible-dropdown">
        <button class="dropdown-btn">Login/Register</button>
        <div class="dropdown-content">
          <RouterLink to="/login">Login</RouterLink>
          <RouterLink to="/register">Register</RouterLink>
        </div>
      </div>

      <div class="nav-links">
        <div class="nav-buttons-left">
          <RouterLink to="/">Home</RouterLink>
          <a href="/student/schedule">Rooster</a>
        </div>
        <div class="logo">
          <img src="../../../../public/assets/recepauto.png" alt="Logo" class="logo-image" />
        </div>
        <div class="nav-buttons-right">
          <RouterLink to="/about">Over Ons</RouterLink>
          <RouterLink to="/contact">Contact</RouterLink>
        </div>
      </div>

      <div class="new-link-right">
        <RouterLink v-if="isAuthenticated" to="/dashboard" class="btn-dashboard">Dashboard</RouterLink>
        <div class="dropdown">
          <button class="dropdown-btn">Login/Register</button>
          <div class="dropdown-content">
            <RouterLink to="/login">Login</RouterLink>
            <RouterLink to="/register">Register</RouterLink>
            <a v-if="isAuthenticated" @click.prevent="logout">Logout</a>
          </div>
        </div>
      </div>
    </nav>
  </header>
  <RouterView />
</template>

<script>
import { ref, onMounted } from 'vue';
import { useRouter } from 'vue-router';
import api from '../src/services/api';  // axios instance

export default {
  name: 'HeaderComponent',
  setup() {
    const router = useRouter();
    const isAuthenticated = ref(false);

    const logout = async () => {
      try {
        await api.post('/logout');  // Call logout API provided by Breeze
        isAuthenticated.value = false;
        router.push('/login');  // Redirect to login page after logout
        alert("Logged out")
      } catch (error) {
        console.error('Logout failed:', error);
      }
    };

    onMounted(async () => {
      try {
        const response = await api.get('/api/user');
        isAuthenticated.value = !!response.data;  // If there's a user, the user is authenticated
      } catch (error) {
        isAuthenticated.value = false;
      }
    });

    return {
      isAuthenticated,
      logout,
    };
  },
};
</script>

<style scoped>
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

header {
  width: 100%;
  background-color: #db893b;
  padding: 10px 20px;
  position: fixed;
  top: 0;
  left: 0;
  z-index: 1000;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.navbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  width: 100%;
  padding: 0 20px;
}

.nav-links {
  display: flex;
  align-items: center;
  gap: 20px;
  flex: 1;
  justify-content: center;
}

.logo img {
  height: 65px;
}

.new-link-left,
.new-link-right {
  display: flex;
  align-items: center;
}

.nav-links a,
.new-link-left a,
.new-link-right a {
  color: white;
  text-decoration: none;
  font-weight: bold;
  padding: 10px 15px;
  transition: background-color 0.3s;
  border-radius: 5px;
}

.nav-links a:hover,
.new-link-left a:hover,
.new-link-right a:hover {
  background-color: #68401a;
}

.nav-links a:hover {
  background-color: #68401a;
}

body {
  padding-top: 70px;
}


.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-btn {
  background-color: #db893b;
  color: white;
  padding: 10px 15px;
  font-weight: bold;
  border: none;
  cursor: pointer;
  border-radius: 5px;
  transition: background-color 0.3s;
}

.dropdown-btn:hover {
  background-color: #68401a;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 100%;
  box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
  z-index: 1;
  top: 100%;
  left: 0;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown-content a:hover {
  background-color: #f1f1f1;
}

.dropdown:hover .dropdown-content {
  display: block;
}

.dropdown:hover .dropdown-btn {
  background-color: #68401a;
}

.btn-dashboard {
  color: white;
  text-decoration: none;
  font-weight: bold;
  padding: 10px 15px;
  background-color: #db893b;
  border-radius: 5px;
  transition: background-color 0.3s;
}

.btn-dashboard:hover {
  background-color: #68401a;
}

.invisible-dropdown {
  opacity: 0;
  pointer-events: none;
}
</style>
