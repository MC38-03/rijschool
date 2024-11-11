<template>
    <section class="section-container">
      <div class="section-content">
        <img src="../assets/clio.jpg" class="background-img">
        <div class="card-content">
          <div class="content-wrapper">
            <h1 class="section-title">Stel je vraag</h1><br>
            <h2>Of maak een afspraak voor gratis een proefles</h2>

          </div>
        </div>
      </div>
    </section>
  </template>
  
  <script scoped>
  export default {
    name: 'Welcome_Card',
  };
  </script>
  
  <style scoped>
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }
  
  h1.section-title{
    font-size: 60px;
    color: #db893b;
  }
  
  h2{
    font-size: 45px;
  }
  
  .section-container {
    position: relative;
    top: 77px;
    left: 0;
    width: 100%;
    height: 750px;
    overflow: hidden;
    background: black;
    z-index: -1;
    margin: 0;
  }
  
  .section-content {
    width: 100%;
    height: 100%;
    justify-content: center; /* Yatayda ortalar */
    align-items: center; /* Dikeyde ortalar */}
  
  .background-img {
    object-fit: cover;
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    left: 0;
    z-index: -1;
  }
  
  .card-content {
    background: rgba(0, 0, 0, 0.5);
    color: white;
    display: flex;
    flex-direction: column;
    justify-content: center; /* İçeriği yatayda ortalar */
    align-items: center; /* İçeriği dikeyde ortalar */  
    height: 100%;
    padding: 20px;
    text-align: left;
    width: 100%;
  }
  
  .content-wrapper {
    width: 100%; /* Ekran genişliğine göre içerik genişliği */
    max-width: 1000px; /* Maksimum genişlik ayarlayabilirsin */
    text-align: left;
  }
  
  ul.a {
    font-size: 30px;
    font-weight: 600;
    list-style-type: circle;
    list-style-position: inside;
  }
  ul{
    list-style-image: url('../assets/ul_icon_mid.png');
    list-style-position: inside;
  }
  li {
    margin: 17px;
  }
  </style>