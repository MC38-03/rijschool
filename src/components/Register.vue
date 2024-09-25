<template>
    <div class="register-container">
        <div class="form-wrapper">
            <h1>Register</h1>
            <form @submit.prevent="registerUser" class="register-form">
                <input v-model="user.gebruikersnaam" type="text" placeholder="Gebruikersnaam" />
                <input v-model="user.naam" type="text" placeholder="Naam" />
                <input v-model="user.achternaam" type="text" placeholder="Achternaam" />
                <input v-model="user.geboortedatum" type="date" placeholder="Geboortedatum" />
                <input v-model="user.email" type="email" placeholder="Email" />
                <input v-model="user.wachtwoord" type="password" placeholder="Wachtwoord" />
                <input v-model="user.wachtwoord_confirmation" type="password" placeholder="Bevestig wachtwoord" />
                <button type="submit" class="submit-btn">Register</button>
            </form>
            <p v-if="errorMessage" class="error-message">{{ errorMessage }}</p>
        </div>
    </div>
</template>

<script>
import api from '../services/api';

export default {
    data() {
        return {
            user: {
                gebruikersnaam: '',
                naam: '',
                achternaam: '',
                geboortedatum: '',
                email: '',
                wachtwoord: '',
                wachtwoord_confirmation: '',
            },
            errorMessage: null,
        };
    },
    methods: {
        async registerUser() {
            try {
                const formattedUser = {
                    ...this.user,
                    geboortedatum: new Date(this.user.geboortedatum).toISOString().split('T')[0],
                };
                const response = await api.post('/register', formattedUser, {
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
:root {
    font-size: 16px;
}

.register-container {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background-color: #f7f7f7;
    padding: 1rem;
}

.form-wrapper {
    background-color: white;
    padding: 2.5rem;
    border-radius: 0.625rem;
    box-shadow: 0 0.25rem 0.75rem rgba(0, 0, 0, 0.1);
    max-width: 25rem;
    width: 100%;
    text-align: center;
}

h1 {
    margin-bottom: 1.5rem;
    color: #333;
    font-size: 1.5rem;
}

input {
    width: 100%;
    padding: 0.75rem;
    margin-bottom: 1.25rem;
    border: 0.0625rem solid #ddd;
    border-radius: 0.3125rem;
    font-size: 1rem;
}

input:focus {
    border-color: #007bff;
    outline: none;
}

.submit-btn {
    padding: 0.75rem;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 0.3125rem;
    font-size: 1rem;
    cursor: pointer;
    transition: background-color 0.3s;
    text-align: center;
    max-width: 10rem;
    margin: 0 auto;
}

.submit-btn:hover {
    background-color: #0056b3;
}

.error-message {
    color: red;
    margin-top: 1rem;
    font-size: 0.875rem;
}
</style>
