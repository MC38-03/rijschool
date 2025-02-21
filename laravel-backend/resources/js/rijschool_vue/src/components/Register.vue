<template>
    <div class="register-container">
        <h1>Register</h1>
        <form @submit.prevent="registerUser" class="register-form">
            <input v-model="user.gebruikersnaam" type="text" placeholder="Gebruikersnaam" />
            <input v-model="user.naam" type="text" placeholder="Naam" />
            <input v-model="user.achternaam" type="text" placeholder="Achternaam" />
            <input v-model="user.geboortedatum" type="date" placeholder="geboortedatum" />
            <input v-model="user.email" type="email" placeholder="Email" />
            <input v-model="user.wachtwoord" type="password" placeholder="Wachtwoord" />
            <input v-model="user.wachtwoord_confirmation" type="password" placeholder="Bevestig wachtwoord" />
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
.register-container {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    min-height: 100vh;
    background-color: #f7f7f7;
}

.register-form {
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

.submit-btn {
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

.submit-btn:hover {
    background-color: #0056b3;
}

.error-message {
    color: red;
    margin-top: 15px;
    font-size: 14px;
}
</style>
