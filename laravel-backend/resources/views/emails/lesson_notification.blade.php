<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Les Notification</title>
</head>
<body>
    <h1>Les {{ ucfirst($messageType) }}</h1>

    <p>Dear {{ $lesson->leerling->naam }},</p>

    <p>Your lesson has been {{ $messageType }}.</p>
    <p><strong>Date:</strong> {{ $lesson->datum }}</p>
    <p><strong>Start Time:</strong> {{ $lesson->begin_tijd }}</p>
    <p><strong>End Time:</strong> {{ $lesson->eind_tijd }}</p>
    <p><strong>Instructor:</strong> {{ $lesson->instructeur->naam }}</p>
    <p><strong>Vehicle:</strong> {{ $lesson->voertuig->type ?? 'Not assigned' }}</p>

    <p>Thank you!</p>
</body>
</html>
