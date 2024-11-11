<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rijschool X</title>
    @vite('resources/js/rijschool_vue/src/main.js')
</head>
<body>
    <div id="app"></div>

    <script>
        window.Laravel = {!! json_encode([
            'user' => Auth::user(),
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</body>
</html>
