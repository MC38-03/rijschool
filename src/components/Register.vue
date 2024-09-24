<template>
    <div class="register-container">
        <h1>Register</h1>
        <form @submit.prevent="registerUser" class="register-form">
            <input v-model="user.gebruikersnaam" type="text" placeholder="Gebruikersnaam" />
            <input v-model="user.naam" type="text" placeholder="Naam" />
            <input v-model="user.achternaam" type="text" placeholder="Achternaam" />
            <input v-model="user.leeftijd" type="number" placeholder="Leeftijd" />
            <input v-model="user.email" type="email" placeholder="Email" />
            <input v-model="user.wachtwoord" type="password" placeholder="Wachtwoord" />
            <input v-model="user.wachtwoord_confirmation" type="password" placeholder="Confirm Wachtwoord" />
            <button type="submit" class="submit-btn">Register</button>
        </form>
        <p v-if="errorMessage" class="error-message">{{ errorMessage }}</p>
    </div>
</template>

<script>
import api from '../services/api';

export default {
    data() {
        return {
            user: {
                gebruikersnaam: 'test',
                naam: 'test',
                achternaam: 'test',
                leeftijd: '32',
                email: 'test@gmail.com',
                wachtwoord: 'test123',
                wachtwoord_confirmation: 'test123',
            },
            errorMessage: null,
        };
    },
    methods: {
        async registerUser() {
            try {
                // Ensure the CSRF token is fetched from '/sanctum/csrf-cookie'
                await api.get('/sanctum/csrf-cookie');

                // Proceed with the registration request
                const response = await api.post('/register', this.user, {
                    withCredentials: true
                });
                console.log('Registration successful', response.data);
                alert('Registration successful');
            } catch (error) {
                console.error('Registration failed', error);
                if (error.response && error.response.data) {
                    this.errorMessage = error.response.data.message;
                } else {
                    this.errorMessage = 'An unexpected error occurred';
                }
            }
        }
    },
};
</script>


<style scoped>
.register-container {
    max-width: 400px;
    margin: 50px auto;
    padding: 20px;
    border-radius: 8px;
    background-color: #f7f7f7;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

h1 {
    text-align: center;
    color: #333;
    font-size: 24px;
    margin-bottom: 20px;
}

.register-form {
    display: flex;
    flex-direction: column;
}

.register-form input {
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
}

.register-form input:focus {
    border-color: #007bff;
    outline: none;
}

.submit-btn {
    padding: 10px 15px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
}

.submit-btn:hover {
    background-color: #0056b3;
}

.error-message {
    color: red;
    text-align: center;
    margin-top: 15px;
}
</style>