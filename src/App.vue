<script setup>
import { RouterLink, RouterView } from 'vue-router'
</script>

<template>
  <header>
    <nav class="navbar">

      <div class="new-link-left">
      </div>

      <div class="nav-links">
        <div class="nav-buttons-left">
          <RouterLink to="/">Home</RouterLink>
          <RouterLink to="/tarieven">Tarieven</RouterLink>
        </div>
        <div class="logo">
          <img src="@/assets/recepauto.png" alt="Logo" class="logo-image" />
        </div>
        <div class="nav-buttons-right">
          <RouterLink to="/about">Over Ons</RouterLink>
          <RouterLink to="/contact">Contact</RouterLink>
        </div>
      </div>
      

      <div class="new-link-right">
        <RouterLink to="/register">Login/Register</RouterLink>
      </div>
    </nav>
  </header>

  <RouterView />
</template>

<style scoped>
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

header {
  width: 100%;
  background-color: #3f51b5;
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
  background-color: #283593;
}

body {
  padding-top: 70px;
}
</style>
