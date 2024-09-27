<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import api from '../services/api';
import { getCsrfToken } from '../services/api';

const router = useRouter();
const user = ref({
  gebruikersnaam: '',
  wachtwoord: ''
});
const errorMessage = ref(null);

const loginUser = async () => {
  errorMessage.value = null;
  try {
    await getCsrfToken();
    const response = await api.post('/login', user.value);
    const { token, user: loggedInUser } = response.data;

    localStorage.setItem('token', token);
    localStorage.setItem('user', JSON.stringify(loggedInUser));

    alert('Login successful');
    router.push('/dashboard');
  } catch (error) {
    console.error('Login failed', error);
    if (error.response && error.response.data) {
      errorMessage.value = error.response.data.message;
    } else {
      errorMessage.value = 'An unexpected error occurred';
    }
  }
};
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
  padding: 2.5rem;
  border-radius: 0.625rem;
  box-shadow: 0 0.25rem 0.75rem rgba(0, 0, 0, 0.1);
  max-width: 25rem;
  width: 100%;
  text-align: center;
}

h1 {
  margin-bottom: 1.25rem;
  color: #333;
  font-size: 1.5rem;
}

input {
  width: 100%;
  padding: 0.625rem;
  margin-bottom: 1.25rem;
  border: 0.0625rem solid #ddd;
  border-radius: 0.3125rem;
  font-size: 1rem;
}

input:focus {
  border-color: #007bff;
  outline: none;
}

.login-btn {
  display: block;
  margin: 0 auto;
  padding: 0.625rem 2rem;
  background-color: #007bff;
  color: white;
  border: none;
  border-radius: 0.3125rem;
  font-size: 1rem;
  cursor: pointer;
  transition: background-color 0.3s;
}

.login-btn:hover {
  background-color: #0056b3;
}

.error-message {
  color: red;
  margin-top: 1rem;
  font-size: 0.875rem;
}
</style>
