<template>
    <div class="contact-container">
      <h1>Contact</h1>
      <p>
        Heb je vragen? Aarzel niet om contact met ons op te nemen via de volgende
        gegevens:
      </p>
      <ul>
        <li>Email: Recep_*!?-Ivedik95"@eenendertig.com</li>
        <li>Telefoon: 010-1234567</li>
        <li>Adres: Zwarte Ambar Vrachtwagen, Auto rijbewijs en droge bonen Vereniging, İstanbul, Kadikoy, Erenköy wijk, Hatboyu st., 31
        </li>
      </ul>
  
      <form class="contact-form">
        <div class="form-group">
          <label for="name">Naam</label>
          <input type="text" id="name" name="name" class="form-control" />
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" class="form-control" />
        </div>
        <div class="form-group">
          <label for="message">Bericht</label>
          <textarea
            id="message"
            name="message"
            rows="5"
            class="form-control"
          ></textarea>
        </div>
        <button type="submit" class="btn-submit">Verstuur</button>
      </form>
    </div>
  </template>
  
  <script>
  export default {
    name: 'ContactView',
  };
  </script>
  
  <style scoped>
  .contact-container {
    padding: 20px;
    max-width: 800px;
    margin: 0 auto;
    background-color: #f4f4f9;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    margin-top: 15rem;
  }
  
  .contact-container h1 {
    font-size: 2.5rem;
    color: #db893b;
    margin-bottom: 20px;
  }
  
  .contact-container p {
    font-size: 1.2rem;
    color: #333;
    line-height: 1.6;
  }
  
  .contact-container ul {
    font-size: 1.2rem;
    color: #333;
    list-style-type: none;
    padding: 0;
    margin-bottom: 30px;
  }
  
  .contact-container ul li {
    margin-bottom: 10px;
  }
  
  .contact-form {
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
  }
  
  .form-group {
    margin-bottom: 15px;
  }
  
  .form-control {
    width: 100%;
    padding: 10px;
    font-size: 1rem;
    border: 1px solid #ccc;
    border-radius: 5px;
  }
  
  .form-control:focus {
    outline: none;
    border-color: #db893b;
  }
  
  .btn-submit {
    background-color: #db893b;
    color: white;
    border: none;
    padding: 10px 15px;
    font-size: 1.2rem;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
  }
  
  .btn-submit:hover {
    background-color: #68401a;
  }
  </style>
  