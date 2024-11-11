<template>
  <section class="section-container">
    <div class="section-content">
      <img src="../assets/ferrari_stuur.jpg" class="background-img">
      <div class="card-content">
        <div class="content-wrapper">
          <h1 class="section-title">Je rijbewijs halen was nog nooit zo makkelijk geweest!</h1><br>
          <ul class="a">
            <li>Laagste prijs voor rijlespakketten met examengarantie</li>
            <li>Gratis herexamen bij rijlessenpakketten met examengarantie</li>
            <li>Zeer hoog slagingspercentage</li>
            <li>60 minuten per rijles</li>
            <li>Je kunt direct starten</li>
            <li>Je kunt snel examen doen, er is bij ons geen wachttijd!</li>
            <li>Je kunt achteraf gespreid betalen</li>
          </ul>
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

h1.section-title {
  font-size: 40px;
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
  justify-content: center;
  align-items: center;
}

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
  justify-content: center;
  align-items: center;
  height: 100%;
  padding: 20px;
  text-align: left;
  width: 100%;
}

.content-wrapper {
  width: 100%;
  max-width: 1000px;
  text-align: left;
}

ul.a {
  font-size: 30px;
  font-weight: 600;
  list-style-type: circle;
  list-style-position: inside;
}

ul {
  list-style-image: url('../../../../js/rijschool_vue/src/assets/ul_icon_mid.png');
  list-style-position: inside;
}

li {
  margin: 17px;
}
</style>