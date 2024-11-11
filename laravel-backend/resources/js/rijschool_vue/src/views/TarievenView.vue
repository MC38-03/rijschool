<template>
  <div class="page">
    <section class="s1">
      <LamboComponent />
    </section>
    <section class="tarievensection">
      <div class="tarievenh1">    
      <h1>Rijlespaketten met Examengarantie!</h1>
    </div>
    <div class="tarieven">
      <GrootTarieven />
    </div>
    </section>
    <section class="s2">
      <GratisProeflessen />
      <OverigeLessen />
    </section>
    <section class="s3" id="doel">
      <KleinProeflesForm />
      <NogvragenComponent />
    </section>
    <section class="s4">
      <GoedkopeRijschool />
    </section>
    <footer class="footer">
      <FooterComponent />
    </footer>
  </div>

</template>



<script>
import LamboComponent from '../components/LamboComponent.vue';
import GrootTarieven from '..//components/GrootTarieven.vue'; 
import KleinProeflesForm from '../components/KleinProeflesForm.vue';
import NogvragenComponent from '../components/NogvragenComponent.vue';
import FooterComponent from '../components/FooterComponent.vue';
import GratisProeflessen from '../components/GratisProeflessen.vue';
import OverigeLessen from "../components/OverigeLessen.vue";
import GoedkopeRijschool from "../components/GoedkopeRijschool.vue"
export default{
  components:{
    LamboComponent,
    GrootTarieven,
    KleinProeflesForm,
    NogvragenComponent,
    FooterComponent,
    GratisProeflessen,
    OverigeLessen,
    GoedkopeRijschool
  }
}
</script>


<style scoped>
.s1{
  margin-top: -77px;
  margin-bottom: 77px;
}

.s2{
  background-color: rgb(224, 238, 238);
  padding: 60px;
  display: flex;
  flex-direction: row;
  align-items: center;
  justify-content: center;
  gap: 50px;
}

.s4{
  padding: 50px;
  padding-left: 110px;
  padding-right: 110px;
  background-color: rgb(224, 238, 238);
}

.tarievenh1{
  display: flex;
  justify-content: center;
  margin-bottom: 50px;
  margin-top: 30px;
  font-size: 30px;

}
.tarieven{
  display: flex;
  justify-content: center;
}

.tarievensection{
  padding-top: 10px;
  background-color: rgb(224, 238, 238);
  padding-bottom: 50px;

}

.s3{
  display: flex;
  flex-direction: row;
  justify-content: center;
  padding: 50px;
  background-color: rgb(224, 238, 238);
  gap: 100px;
}

footer{
  background-color: #ddb895;
  width: 100%;
  padding-top: 20px;
  display: flex;
  text-align: center;
}
</style>
