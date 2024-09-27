<template>
  <div class="row row-cols-1 row-cols-md-4 g-5">
    <div class="col">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Autorijlessen</h5>
          <p class="card-text">Complete rijopleiding met examengarantie.</p><br>
          <p class="vanaf"><b>vanaf</b></p>
          <strong>€1175,-</strong><br><br>
          <ul class="details">
            <li>Vanaf 15 lessen</li>
            <li>Tussentijdse CBR toets</li>
            <li>Inclusief Rijexamen</li>
          </ul>
          <button class="more-info" @click="gaNaarTarieven">Meer info</button>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Motorrijlessen</h5>
          <p class="card-text">Complete rijopleiding met examengzarantie.</p><br>
          <p class="vanaf"><b>vanaf</b></p>
          <strong>€1450,-</strong><br><br>
          <ul class="details">
            <li>Vanaf 15 lessen</li>
            <li>Tussentijdse CBR toets</li>
            <li>Inclusief Rijexamen</li>
          </ul>
          <button class="more-info" @click="gaNaarTarieven">Meer info</button>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Brommerrijlessen</h5>
          <p class="card-text">Complete rijopleiding met examengarantie.</p><br>
          <p class="vanaf"><b>vanaf</b></p>
          <strong>€375,-</strong><br><br>
          <ul class="details">
            <li>Vanaf 15 lessen</li>
            <li>Tussentijdse CBR toets</li>
            <li>Inclusief Rijexamen</li>
          </ul>
          <button class="more-info" @click="gaNaarTarieven">Meer info</button>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Taxirijlessen</h5>
          <p class="card-text">Complete rijopleiding met examengarantie.</p><br>
          <p class="vanaf"><b>vanaf</b></p>
          <strong>€140,-</strong><br><br>
          <ul class="details">
            <li>Vanaf 15 lessen</li>
            <li>Tussentijdse CBR toets</li>
            <li>Inclusief Rijexamen</li>
          </ul>
          <button class="more-info" @click="gaNaarTarieven">Meer info</button>
        </div>
      </div>
    </div>
  </div>
</template>



<script>
export default {
  methods: {
    gaNaarTarieven() {
      this.$router.push('/tarieven'); // 'tarieven' sayfasına yönlendirme
    }
  }
}
</script>


<style scoped lang="scss">
@import 'bootstrap/scss/bootstrap';

.card {
  width: 380px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
  border-radius: 8px;
  background-color: rgb(255, 255, 255);
  overflow: hidden;
}


strong {
  font-size: 30px;
  padding: 0cm;
}

ul {
  background-color: rgb(230, 230, 230);
  list-style-image: url('../assets/ul_icon_small.png');
  margin: 0px 0 0 0;
  padding: 15px;
  padding-left: 40px;
  width: 100%;
  border-radius: 0 0 8px 8px;
}

p.vanaf {
  margin-bottom: -10px;
  line-height: 1.2;
}

.more-info {
  background-color: #c9660a;
  color: white;
  padding: 10px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  font-size: 16px;
  transition: background-color 0.3s ease;
  margin-top: 20px;
  width: 100%;
}

.more-info:hover {
  background-color: #68401a;
}
</style>