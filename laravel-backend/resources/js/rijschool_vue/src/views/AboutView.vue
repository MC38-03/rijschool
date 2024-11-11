<template>
  <div class="page">
    <section class="s1">
      <GolfComponent />
    </section>
    <section class="s2">
      <RecepinAmsterdam />
    </section>
    <footer class="footer">
      <FooterComponent />
    </footer>
  </div>
</template>

<script>
import GolfComponent from '../components/GolfComponent.vue';
import RecepinAmsterdam from "../components/RecepinAmsterdam.vue"
import FooterComponent from '../components/FooterComponent.vue';

export default{
  components: {
    GolfComponent,
    RecepinAmsterdam,
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
