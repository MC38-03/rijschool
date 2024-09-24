<template>
  <div class="homepage">
    <div class="ferrari">
      <Home_Ferrari />
    </div>
    <div class="contact_page">
      <Contact_Page />
    </div>
  </div>

</template>

<script>
import Home_Ferrari from '../components/Home_Ferrari.vue'
import Contact_Page from '../components/Contact.vue'
export default {
  components: {
    Home_Ferrari,
    Contact_Page
  }
}
</script>

<style>
.homepage {
  display: flex;
  flex-direction: column; 
  align-items: center; 
  height: 100%; 
  min-height: 100vh;
}

.ferrari, .contact_page {
  width: 100%; 
  flex-grow: 1; /* Ekran boşluğunu eşit şekilde doldur */
}

</style>