<script setup>
import { RouterLink, RouterView } from 'vue-router'
</script>

<template>
  <header>
    <nav class="navbar">
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
    </nav>
  </header>

  <RouterView />
</template>

<style scoped>
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
  justify-content: space-evenly;
  align-items: center;
  max-width: 1200px;
  margin: 0 auto;
}

.logo {
  display: flex;
  flex-direction: row;
  align-items: center;
}

.logo img {
  height: 65px;
}

.nav-links {
  display: flex;
  gap: 20px;
}

.nav-links a {
  color: white;
  text-decoration: none;
  font-weight: bold;
  padding: 10px 15px;
  transition: background-color 0.3s;
  border-radius: 5px;
}

.nav-links a:hover {
  background-color: #283593;
}

body {
  padding-top: 70px;
}

.nav-buttons-left {
  display: flex;
  flex-direction: row;
  align-items: center;
}

.nav-buttons-right {
  display: flex;
  flex-direction: row;
  align-items: center;
}
</style>
