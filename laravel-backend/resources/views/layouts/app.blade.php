<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Rijschool')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <header>
        <h1>Rijschool</h1>
        <nav>
            <a href="/">Home</a>
            <a href="/beschikbaarheden">Beschikbaarheden</a>
            <a href="/leerlingen">Leerlingen</a>
            <a href="/lessen">Lessen</a>
            <a href="/voertuigen">Voertuigen</a>
            <a href="/facturen">Facturen</a>
            <a href="/instructeurs">Instructeurs</a>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <p>&copy; 2024 Rijschool</p>
    </footer>
</body>
</html>
