<template>
    <div class="card">
      <h2>Sürücü Kursu Bilgileri</h2>
      <p>Burada sürücü kursunun detaylı bilgilerini ve fiyatlarını bulabilirsiniz.</p>
      <p>Örneğin, başlangıç kursu, ileri düzey kursları, özel dersler ve fiyatları hakkında bilgi.</p>
      <button @click="goToPricingPage">Fiyatlar ve Bilgiler</button>
    </div>
  </template>
  
  <script>
  export default {
    name: 'DrivingSchoolCard',
    methods: {
      goToPricingPage() {
        // Fiyatlar sayfasına yönlendirme
        this.$router.push('/pricing'); // Vue Router kullanarak yönlendirme
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