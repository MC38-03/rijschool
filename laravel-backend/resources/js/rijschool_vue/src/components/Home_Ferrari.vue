<template>
  <section class="section-container">
    <div class="section-content">
      <img src="../assets/ferrari_stuur.jpg" class="background-img">
      <div class="card-content">
        <div class="content-wrapper">
          <h1 class="section-title">Je rijbewijs halen was nog nooit zo makkelijk geweest!</h1>
          <p class="section-text">This is a wider section with supporting text below as a natural lead-in to additional
            content. This content is a little bit longer.</p>
          <ul class="a">
            <li>goedkoop</li>
            <li>korting</li>
            <li>zart zurt</li>
          </ul>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
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


.section-container {
  position: relative;
  top: 77px;
  left: 0;
  width: 100%;
  height: 450px;
  overflow: hidden;
  background: black;
  z-index: -1;
  margin: 0;
}

.section-content {
  width: 100%;
  height: 100%;
  /* position: relative; */
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
  height: 100%;
  padding: 20px;
  text-align: left;
  width: 100%;
}

.content-wrapper {
  width: 60%;
  margin-left: 25%;
  text-align: left;
}

ul.a {
  list-style-type: circle;
  list-style-position: inside;
}
</style>