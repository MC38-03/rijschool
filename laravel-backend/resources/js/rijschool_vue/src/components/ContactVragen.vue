<template>
    <div class="nogvragencard">
        <h1>Rijschool Recep </h1>
        <p>Abraham Kuyperstraat 15
            1067 DH Amsterdam </p>
        <ul>
            <li><a aria-label="Chat on WhatsApp" href="https://wa.me/31685559920"><img alt="Chat on WhatsApp"
                        src="../assets/300768190_383340503990757_1334850925137629076_n/ChatOnWhatsAppButton/WhatsAppButtonGreenLarge.svg" /></a>
            </li>
            <li><img src="../assets/phone_icon.png" alt="call" class="icon"><a class="telnummer"
                    href="tel:+31685559920">06 85559920</a></li>
            <li><img src="../assets/mail_icon.png" alt="mail" class="icon"><a class="mail"
                    href="mailto:etkatrabzon@gmail.com">etkatrabzon@gmail.com</a></li>
        </ul>
    </div>
</template>

<script>
</script>

<style scoped>

h1 {
    font-size: 45px;
    padding: 20px;
    text-align: center;
}

p {
    padding: 20px;
}

li {
    font-size: 20px;
    padding: 20px;
    list-style-type: none;
    display: flex;
    align-items: center;
}

.icon {
    height: 40px;
    margin-right: 10px;
}

a {
    text-decoration: none;
    color: inherit;
}

a:visited,
a:hover,
a:focus,
a:active {
    color: inherit;
    text-decoration: none;
}

.nogvragencard {
    width: 400px;
}
</style>