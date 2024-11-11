<template>
    <div class="card">
        <h1>GRATIS Proefles</h1>
        <h2>60 Minuten</h2><br>
        <p><b>Ervaar het autorijden tijdens een gratis proefles en maak kennis met je instructeur. Ontdek hoe jij snel en
            voordelig je rijbewijs haalt.</b><br><br>

            Besluit je om na de proefles een rijlespakket af te nemen bij Rijschool Recep, dan is de proefles ter
            waarde van € 45,- helemaal gratis.
        </p><br><br>
        <button @click="scrollToSection" class="scroll-button">Proefles Aanvragen!</button>
    </div>
</template>

<script>
export default {
  methods: {
    scrollToSection() {
      const targetSection = document.getElementById("doel");
      targetSection.scrollIntoView({ behavior: "smooth" });
    }
  }
}
</script>


<style scoped>

.card {
  width: 500px;
  padding: 30px;
  border-radius: 10px;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
  background-color: rgb(241, 241, 227);
  text-align: center;
}

.card h1 {
  font-size: 50px;
  color: #c9660a;
  margin-bottom: 10px;
}

.card h2 {
  font-size: 40px;
  color: #555555;
  margin-bottom: 15px;
}

.card p {
  font-size: 16px;
  color: #333333;
  line-height: 1.6;
  margin-bottom: 20px;
}

.scroll-button {
    background-color: #c9660a;
  color: white;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  font-size: 16px;
  transition: background-color 0.3s ease;
}

.scroll-button:hover {
    background-color: #8d4909;
}

.target-section {
  margin-top: 100vh; 
  padding: 20px;
  background-color: #f0f0f0;
}
</style>

