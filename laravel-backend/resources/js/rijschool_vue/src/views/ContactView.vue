<template>
<div class="page">
    <section class="s1">
        <ClioComponent />
    </section>
    <section class="s2">
      <ContactVragen />
      <Opneningstijden />
    </section>
    <footer>
      <FooterComponent />
    </footer>
</div>    
</template>
<script>
import ClioComponent from '../components/ClioComponent.vue';
import ContactVragen from '../components/ContactVragen.vue';
import Opneningstijden from '../components/OpeningsTijden.vue'
import FooterComponent from '../components/FooterComponent.vue';
export default {
  components: {
    ClioComponent,
    ContactVragen,
    Opneningstijden,
    FooterComponent
  }
}
</script>



<style scoped>
.s1{
  margin-top: -77px;
}
.s2{
  background-color: rgb(224, 238, 238);
  margin-top: 77px;
  display: flex;
  flex-direction: row;
  align-items: center;
  justify-content: center;
  padding: 100px;
  gap: 100px;

}
footer{
  background-color: #ddb895;
  width: 100%;
  padding-top: 20px;
  padding-bottom: 30px;
  display: flex;
  text-align: center;
}
</style>