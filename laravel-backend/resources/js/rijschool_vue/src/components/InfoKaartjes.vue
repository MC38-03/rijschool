<template>
    <div class="kaartjes">
        <div class="card">
            <img src="../assets/achterstuur.jpg" class="card-img-top">
            <div class="card-body">
                <h5 class="card-title"><b>NEEM PLAATS ACHTER STUUR</b></h5>
                <p class="card-text">Ben jij 16,5 of ouder? Dan mag jij al plaats nemen achter het stuur bij
                    Rijschool Recep! Iedereen kan een rijbewijs halen, waar wacht jij nog op?
                    <br><br>
                    Neem een proefles, of meld je aan voor een rijles pakket!
                </p>
            </div>
        </div>
        <div class="card">
            <img src="../assets/theorie.jpg" class="card-img-top">
            <div class="card-body">
                <h5 class="card-title"><b>THEORIE HALEN IN EEN DAG</b></h5>
                <p class="card-text">In "no-time" je theorie behalen met onze theoriecursus pakket!
                    <br><br>
                    <b>Eendaagse cursus voor maar €117,-</b>
                </p>
            </div>
        </div>
        <div class="card">
            <img src="../assets/automaat-dsg-volkswagen.jpg" class="card-img-top">
            <div class="card-body">
                <h5 class="card-title"><b>RIJLES IN AUTOMAAT</b></h5>
                <p class="card-text"><strong>Wil je liever rijles in een automaat?</strong>
                    <br><br>
                    Ook dat is mogelijk bij Rijschool Recep!
                    Jij bepaald in wat voor auto je les krijgt, heb je liever een Automaat? Dan regelen we dat.
                    Als je vragen hebt kun je gerust even contact opnemen.</p>
            </div>
        </div>
    </div>
</template>

<script>
</script>



<style lang="scss" scoped>
   @import 'bootstrap/scss/bootstrap';
    
    .kaartjes {
        display: flex;
        justify-content: center;
        gap: 50px; 
        margin: 80px 0;
    }

    .card {
        width: 380px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5); 
        border-radius: 8px;
        background-color: rgb(255, 255, 255);
    }

    .card-img-top {
        width: 100%; 
        height: 200px; 
        object-fit: cover;
    }

    .card-body {
        padding: 15px;
        text-align: left;
        background-color: rgb(255, 255, 255);
    }

    .card-title {
        font-size: 25px;
        margin-bottom: 10px;
    }

    .card-text {
        font-size: 0.95rem;
    }
</style>