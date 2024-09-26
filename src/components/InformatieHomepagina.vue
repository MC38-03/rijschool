<template>
    <div class="card">
        <h1>De beste rijschool in Amsterdam!</h1>
        <br><br>
        <p><b>Je zoekt een rijschool in Amsterdam waar je de beste lessen krijgt voor de voordeligste prijs. Daarvoor
                zit
                je helemaal goed bij Rijschool Recep! </b></p><br>      
        <p>Wij bieden <b>gegarandeerd de voordeligste rijlespakketten met slagingsgarantie in Amsterdam! </b></p><br>
        <p>Heb je voor een pakket gekozen, maar slaag je eerder dan verwacht? Dan krijg je het geld van de overige
            lessen gewoon terug. <b>Je betaalt dus nooit teveel.</b></p><br>
        <p>Ons <b>zeer hoge slagingspercentage</b> voor het eerste examen behoort al jarenlang tot het beste van
            Amsterdam. Als
            je onverwacht de eerste keer niet slaagt voor je praktijkexamen, kun je <b>gratis herexamen</b> doen met
            onze
            examengarantie. Wij betalen je herexamen ter waarde van € 325,- als je gebruikt maakt van onze lespakketten
            examengarantie.</p><br><br>
        <button @click="gaNaarTarieven">Ga naar Tarieven</button>
    </div>
</template>

<script scoped>
export default {
    name: 'DrivingSchoolCard',
    methods: {
        gaNaarTarieven() {
            this.$router.push('/tarieven');
        }
    }
};
</script>

<style scoped>
h1{
    text-align: left;
    font-size: 50px;
}


.card {
    padding: 20px;
    margin: 10px;
    width: 500px;
    display: flex;
    flex-direction: column;
    align-items: center;

}


button {
    align-content: center;
    padding: 10px;
    background-color: #c9660a;
    color: white;
    border: none;
    cursor: pointer;
    display: block; 
}

button:hover {
    background-color: #0056b3;
}
</style>