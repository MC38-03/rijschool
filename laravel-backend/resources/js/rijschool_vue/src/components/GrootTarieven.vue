<template>
    <div class="container">
      <div class="row row-cols-1 row-cols-md-4 g-5">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Autorijles pakket A</h5>
              <p class="card-text">Complete rijopleiding met examengarantie.</p><br>
              <p class="vanaf"><b>vanaf</b></p>
              <strong>€1175,-</strong><br><br>
              <ul class="details">
                <li>15 lessen</li>
                <li>Tussentijdse CBR toets</li>
                <li>Inclusief Rijexamen</li>
              </ul>
              <button class="more-info" @click="gaNaarTarieven">Beginnen met een Proefles!</button>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Autorijles pakket B</h5>
              <p class="card-text">Complete rijopleiding met examengarantie.</p><br>
              <p class="vanaf"><b>vanaf</b></p>
              <strong>€2300,-</strong><br><br>
              <ul class="details">
                <li>25 lessen</li>
                <li>Tussentijdse CBR toets</li>
                <li>Inclusief Rijexamen</li>
              </ul>
              <button class="more-info" @click="gaNaarTarieven">Beginnen met een Proefles!</button>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Autorijles pakket C</h5>
              <p class="card-text">Complete rijopleiding met examengarantie.</p><br>
              <p class="vanaf"><b>vanaf</b></p>
              <strong>€3100,-</strong><br><br>
              <ul class="details">
                <li>35 lessen</li>
                <li>Tussentijdse CBR toets</li>
                <li>Inclusief Rijexamen</li>
              </ul>
              <button class="more-info" @click="gaNaarTarieven">Beginnen met een Proefles!</button>
            </div>
          </div>
        </div>
        
      </div>
    </div>
  </template>
  
  
  
  <script>
  export default {
    methods: {
      gaNaarTarieven() {
        this.$router.push('/tarieven'); 
      }
    }
  }
  </script>
  
  
  <style scoped lang="scss">
@import 'bootstrap/scss/bootstrap';

.page {
  overflow-x: hidden; 
  width: 100%; 
  max-width: 90%; 
  margin: 0 auto; 
  padding: 10px; 
}


.card {
  width: 100%; 
  padding: 10px;
  max-width: 400px;
  height: 100%;
  display: flex;
  flex-direction: column;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
  border-radius: 8px;
  background-color: rgb(255, 255, 255);
  overflow: hidden;
  transform: scale(0.9);
}

.card-body {
  flex-grow: 1;
}

.row {
  display: flex;
  flex-wrap: wrap;
  margin-left: auto;
  margin-right: auto;
  max-width: 100%;
  padding: 0 15px; // Kartların ekrandan taşmasını önler
}

.col {
  display: flex;
  flex: 1;
  min-width: 200px; // minimum genişlik ayarı
  justify-content: center;
}

strong {
  font-size: 30px;
  padding: 0cm;
}

ul {
  background-color: rgb(230, 230, 230);
  list-style-image: url('../assets/ul_icon_small.png');
  margin: 0;
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

/* Ekran boyutları küçüldüğünde kart boyutlarını ayarlamak için @media sorguları */
@media (max-width: 992px) {
  .card {
    transform: scale(0.85);
  }
}

@media (max-width: 768px) {
  .card {
    transform: scale(0.8);
  }
}

</style>
