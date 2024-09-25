<template>
  <div class="homepage">
    <div class="ferrari">
      <Home_Ferrari />
    </div>
    <div class="card-container">
      <ProeflesForm />
      <InformatieHomepagina />
    </div>
  </div>

</template>

<script>
import Home_Ferrari from '../components/Home_Ferrari.vue'
import ProeflesForm from '../components/ProeflesForm.vue';
import InformatieHomepagina from '../components/InformatieHomepagina.vue';

export default {
  components: {
    Home_Ferrari,
    ProeflesForm,
    InformatieHomepagina
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

.card-container{
  display: flex;
  flex-direction: row;
}
.ferrari, .contact_page {
  width: 100%;
  flex-grow: 1;
}
</style>