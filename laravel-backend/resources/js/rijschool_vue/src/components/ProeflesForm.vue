<template>
  <div class="card">
    <h1 class="upper">Start met een GRATIS proefles!</h1>
    <br><br>
    <ul>
      <li>Laagste prijs voor rijlespakketten met examengarantie</li>
      <li>Zeer hoog slagingspercentage</li>
      <li>Gratis herexamen bij rijlessenpakketten met examengarantie.</li>
      <li>60 minuten per rijles</li>
      <li>Je kunt direct starten</li>
      <li>Je kunt snel examen doen, er is bij ons geen wachttijd</li>
      <li>Je kunt achteraf gespreid betalen</li>
      <li>Gratis proefles t.w.v. € 45 bij afname van een rijlespakket</li>
    </ul>
    <br><br><br>
    <h1 class="lower">Meld je aan voor een proefles;</h1><br>
    
    <form @submit.prevent="sendForm">
      <label for="name">Naam:</label>
      <input type="text" id="name" v-model="form.name" required />

      <label for="surname">Achternaam:</label>
      <input type="text" id="surname" v-model="form.surname" required />

      <label for="email">E-mail:</label>
      <input type="email" id="email" v-model="form.email" required />

      <label for="message">Bericht:</label>
      <textarea id="message" v-model="form.message" required></textarea>
      <br>
      <button type="submit" :disabled="loading">
        {{ loading ? 'Verzenden...' : 'Verzenden' }}
      </button>
      <p v-if="successMessage" class="success-message">{{ successMessage }}</p>
      <p v-if="errorMessage" class="error-message">{{ errorMessage }}</p>
    </form>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'TestDriveCard',
  data() {
    return {
      form: {
        name: '',
        surname: '',
        email: '',
        message: ''
      },
      loading: false,
      successMessage: '',
      errorMessage: ''
    };
  },
  methods: {
    async sendForm() {
      this.loading = true;
      this.successMessage = '';
      this.errorMessage = '';

      try {
        const response = await axios.post('/send-test-drive-email', this.form);
        this.successMessage = response.data.message;
        this.form = { name: '', surname: '', email: '', message: '' }; // Reset form
      } catch (error) {
        this.errorMessage = error.response?.data?.message || 'Er is een fout opgetreden bij het verzenden.';
      } finally {
        this.loading = false;
      }
    }
  }
};
</script>

<style scoped>
.card {
  border: 2px solid #a19797;
  padding: 40px;
  margin: 10px;
  width: 500px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
  border-radius: 20px;
  background-color: rgb(241, 241, 227);
}

form {
  display: flex;
  flex-direction: column;
}

label {
  margin-top: 10px;
}

input, textarea {
  margin-bottom: 10px;
  padding: 8px;
}

button {
  padding: 10px;
  background-color: #c9660a;
  font-size: 20px;
  color: white;
  transition: background-color 0.3s ease;
  border: none;
  cursor: pointer;
  height: 50px;
}

button:disabled {
  background-color: gray;
  cursor: not-allowed;
}

button:hover {
  background-color: #68401a;
}

.success-message {
  color: green;
  margin-top: 10px;
}

.error-message {
  color: red;
  margin-top: 10px;
}

ul {
  list-style-image: url('../assets/ul_icon_small.png');
  list-style-position: inside;
}

h1.lower {
  text-align: left;
}
h1.upper {
  text-align: center;
  font-size: 38px;
}
</style>
