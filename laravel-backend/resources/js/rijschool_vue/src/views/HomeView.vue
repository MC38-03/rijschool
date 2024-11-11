<template>
  <div class="homepage">
    <div class="ferrari">
      <Home_Ferrari />
    </div>
    <section class="info_and_proefles">
      <div class="card-container">
        <InformatieHomepagina />
        <ProeflesForm />
      </div>
    </section>
    <section class="section2">
      <div class="info2">
        <InfoKaartjes />
      </div>
    </section>
    <section class="section3">
      <h1 class="klein_tarieven_titel">Onze opties op een rijtje</h1>
      <div class="tarieven">
        <KleinTarieven />
      </div>
    </section>
    <footer class="footer">
      <FooterComponent />
    </footer>
  </div>

</template>

<script>
import Home_Ferrari from '../components/Home_Ferrari.vue';
import ProeflesForm from '../components/ProeflesForm.vue';
import InfoKaartjes from '../components/InfoKaartjes.vue';
import InformatieHomepagina from '../components/InformatieHomepagina.vue';
import KleinTarieven from '../components/KleinTarieven.vue';
import FooterComponent from '../components/FooterComponent.vue';

export default {
  components: {
    Home_Ferrari,
    ProeflesForm,
    InfoKaartjes,
    InformatieHomepagina,
    KleinTarieven,
    FooterComponent
  }
}
</script>

<style scoped>
.homepage {
  display: flex;
  flex-direction: column;
  align-items: center;
  row-gap: 78px;
  height: 100%;
  min-height: 100vh;
  margin-top: -77px;
}

footer{
  background-color: #ddb895;
  width: 100%;
  padding-top: 60px;
  padding-bottom: 30px;
  margin-top: -69px;
  display: flex;
  text-align: center;
}

.section2{
  background-color: #ddb895;
  width: 100%;
  padding-top: 30px;
  padding-bottom: 30px;
}

h1.klein_tarieven_titel{
  text-align: center;
  font-size: 50px;
  padding-bottom: 40px;
  padding-top: 40px;
}

.section3{
  background-color: rgb(224, 238, 238);
  width: 100%;
  margin-top: -78px;
  padding-top: 30px;
  padding-bottom: 70px;
}

.tarieven{
  display: flex;
  justify-content: center;
}

.info_and_proefles{
  padding-top: 100px;
  padding-bottom: 100px;
  margin-bottom: -78px;
  margin-top: -5px;
  width: 100%;
  background-color: rgb(224, 238, 238);
  align-items: center;
}

.card-container {
  display: flex;
  flex-direction: row;
  column-gap: 100px;
  justify-content: center;
}

.ferrari, .contact_page {
  width: 100%;
}
</style>