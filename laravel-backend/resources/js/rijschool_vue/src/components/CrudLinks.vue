<template>
  <div>
    <nav>
      <!-- Blade-based routes -->
      <a href="/beschikbaarheden">Beschikbaarheden</a>
      <a href="/leerlingen">Leerlingen</a>
      <a href="/lessen">Lessen</a>
      <a href="/voertuigen">Voertuigen</a>
      <a href="/facturen">Facturen</a>
      <a href="/instructeurs">Instructeurs</a>
    </nav>
  </div>
</template>

<script>
export default {
  setup() {
    return {};
  },
};
</script>

<style scoped>
nav {
  display: flex;
  flex-direction: column;
  gap: 10px;
  padding-top: 15rem;
}

a {
  text-decoration: none;
  color: blue;
  font-weight: bold;
}

p {
  color: red;
  font-weight: bold;
}
</style>
