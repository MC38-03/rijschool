<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import api from '../services/api'

const router = useRouter()

const user = ref({
  gebruikersnaam: '',
  wachtwoord: ''
})

const errorMessage = ref(null)

const loginUser = async () => {
  errorMessage.value = null
  try {
    const response = await api.post('/login', user.value)
    alert('Login successful', response.data)

    router.push('/dashboard')
  } catch (error) {
    console.error('Login failed', error)
    if (error.response && error.response.data) {
      errorMessage.value = error.response.data.message
    } else {
      errorMessage.value = 'An unexpected error occurred'
    }
  }
}
</script>

<template>
  <div class="login-container">
    <div class="login-form">
      <h1>Login</h1>
      <input v-model="user.gebruikersnaam" type="text" placeholder="Gebruikersnaam" />
      <input v-model="user.wachtwoord" type="password" placeholder="Wachtwoord" />
      <button @click="loginUser" class="login-btn">Login</button>
      <p v-if="errorMessage" class="error-message">{{ errorMessage }}</p>
    </div>
  </div>
</template>

<style scoped>
.login-container {
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
  background-color: #f7f7f7;
}

.login-form {
  background-color: white;
  padding: 40px;
  border-radius: 10px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
  max-width: 400px;
  width: 100%;
  text-align: center;
}

h1 {
  margin-bottom: 20px;
  color: #333;
}

input {
  width: 100%;
  padding: 10px;
  margin-bottom: 20px;
  border: 1px solid #ddd;
  border-radius: 5px;
  font-size: 16px;
}

input:focus {
  border-color: #007bff;
  outline: none;
}

.login-btn {
  width: 100%;
  padding: 10px;
  background-color: #007bff;
  color: white;
  border: none;
  border-radius: 5px;
  font-size: 16px;
  cursor: pointer;
  transition: background-color 0.3s;
}

.login-btn:hover {
  background-color: #0056b3;
}

.error-message {
  color: red;
  margin-top: 15px;
  font-size: 14px;
}
</style>
