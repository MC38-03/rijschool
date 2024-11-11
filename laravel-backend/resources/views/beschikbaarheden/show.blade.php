@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Beschikbaarheid Details</h1>

    <div class="card">
        <div class="card-body">
            <h3>Beschikbaarheid #{{ $beschikbaarheid->id }}</h3>

            @if($beschikbaarheid->instructeur)
                <p><strong>Instructeur:</strong> {{ $beschikbaarheid->instructeur->naam }}</p>
            @else
                <p><strong>Instructeur:</strong> Niet gekozen</p>
            @endif

            <p><strong>Datum:</strong> {{ $beschikbaarheid->datum }}</p>
            <p><strong>Begin:</strong> {{ $beschikbaarheid->begin_tijd }}</p>
            <p><strong>End:</strong> {{ $beschikbaarheid->eind_tijd }}</p>
        </div>
    </div>

    <a href="{{ route('beschikbaarheden.index') }}" class="btn btn-primary mt-3">Terug</a>
</div>
@endsection
