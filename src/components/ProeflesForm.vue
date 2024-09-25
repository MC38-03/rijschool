<template>
    <div class="card">
      <h2>Deneme Sürüşü</h2>
      <form @submit.prevent="sendForm">
        <label for="name">Adınız:</label>
        <input type="text" id="name" v-model="form.name" required />
        
        <label for="email">E-posta:</label>
        <input type="email" id="email" v-model="form.email" required />
        
        <label for="message">Mesaj:</label>
        <textarea id="message" v-model="form.message" required></textarea>
        
        <button type="submit">Gönder</button>
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
          email: '',
          message: ''
        }
      };
    },
    methods: {
      sendForm() {
        // Form gönderim işlemi
        console.log('Form gönderildi:', this.form);
        // Burada formu bir servise gönderebilirsin veya bir e-posta API'sine bağlanabilirsin
      }
    }
  };
  </script>
  
  <style scoped>
  .card {
    border: 1px solid #ddd;
    padding: 20px;
    margin: 10px;
    width: 45%;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
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
    background-color: #007bff;
    color: white;
    border: none;
    cursor: pointer;
  }
  button:hover {
    background-color: #0056b3;
  }
  </style>