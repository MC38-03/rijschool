<!DOCTYPE html>
<html>
<head>
    <title>Bevestiging van je proefles aanvraag</title>
</head>
<body>
    <h1>Bedankt voor je aanvraag!</h1>
    <p>Beste {{ $data['name'] }},</p>
    <p>We hebben je proefles aanvraag ontvangen. Ons team neemt snel contact met je op.</p>

    <p><strong>Je aanvraag details:</strong></p>
    <p>Naam: {{ $data['name'] }} {{ $data['surname'] }}</p>
    <p>E-mail: {{ $data['email'] }}</p>
    <p>Bericht: {{ $data['message'] }}</p>

    <p>Met vriendelijke groet,</p>
    <p>Rijschool X</p>
</body>
</html>
