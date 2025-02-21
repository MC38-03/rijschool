<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Rijschool')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <meta charset="utf-8">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @stack('styles')
</head>

<body>
    <header>
        <div class="header-title">
            <a href="/">
                <h1>Home</h1>
            </a>
        </div>
        <nav>
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