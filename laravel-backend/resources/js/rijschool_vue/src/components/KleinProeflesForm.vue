<template>
  <div class="card">
    <h1 class="upper">Meld je aan voor een gratis proefles!</h1><br><br>
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
      <button type="submit">Verzenden</button>
    </form>
  </div>
</template>

<script>
export default {
  name: 'TestDriveCard',
  data() {
    return {
      form: {
        name: '',
        surname: '',
        email: '',
        message: ''
      }
    };
  },
  methods: {
    async sendForm() {
      try {
        // Check if the CSRF token exists
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        if (!csrfToken) {
          alert('CSRF token missing. Please reload the page.');
          return;
        }

        // Sending the form data to the Laravel backend
        const response = await fetch('/send-test-drive-email', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          },
          body: JSON.stringify(this.form)
        });

        if (response.ok) {
          // Handle successful form submission
          console.log('Email sent successfully!');
          alert('Je aanvraag is verzonden.');
          this.resetForm();
        } else {
          // Handle server errors
          console.error('Failed to send email');
          alert('Er was een probleem bij het verzenden van je aanvraag. Probeer het opnieuw.');
        }
      } catch (error) {
        // Handle network errors
        console.error('Error:', error);
        alert('Er was een probleem bij het verzenden van je aanvraag. Probeer het opnieuw.');
      }
    },
    resetForm() {
      this.form = {
        name: '',
        surname: '',
        email: '',
        message: ''
      };
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

input,
textarea {
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

button:hover {
  background-color: #68401a;
}
</style>
