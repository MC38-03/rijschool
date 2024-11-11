<template>
    <footer class="footer">
      <div class="container">
        <div class="row">
          <div class="col-md-4">
            <h5>Contact</h5>
            <ul class="list-unstyled">
              <li>Adres: Jan van Galenstraat 31, 1234 AB, Amsterdam</li>
              <li>Tel: +31 6 85559920</li>
              <li>Email: info@receprijschool.nl</li>
            </ul>
          </div>
          <div class="col-md-4">
            <h5>Openingstijden</h5>
            <ul class="list-unstyled">
              <li>Ma-Vr: 08:00 - 18:00</li>
              <li>Za: 09:00 - 16:00</li>
              <li>Zo: Gesloten</li>
            </ul>
          </div>
          <div class="col-md-4">
            <h5>Volg ons</h5>
            <ul class="list-unstyled">
              <li><a href="https://www.facebook.com" target="_blank">Facebook</a></li>
              <li><a href="#">Instagram</a></li>
              <li><a href="#">LinkedIn</a></li>
            </ul>
          </div>
        </div>
        <div class="text-center mt-4">
          <p>&copy; Recep Rijschool. Alle rechten voorbehouden.</p>
        </div>
      </div>
    </footer>
  </template>


<script>
export default {
  name: 'FooterComponent',
};
</script>


<style scoped lang="scss">
@import 'bootstrap/scss/bootstrap';

.footer-section {
  margin-bottom: 20px; // Her bir sütunun altına boşluk ekler
  column-gap: 150px
}

.footer-section ul {
  padding-left: 0; // Liste öğelerinin boşluklarını kontrol eder
}

.footer-section h5 {
  margin-bottom: 15px; // Başlıkların altına boşluk ekler
}

.row {
  margin-top: 20px; // Satırlar arasında boşluk oluşturur
}
</style>

