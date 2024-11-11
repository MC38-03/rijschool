@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Instructeur Details</h1>

    <div class="card p-4 mb-4">
        <p><strong>Naam:</strong> {{ $instructeur->naam }}</p>
        <p><strong>Achternaam:</strong> {{ $instructeur->achternaam }}</p>
        <p><strong>Email:</strong> {{ $instructeur->email }}</p>
        <p><strong>Voertuig:</strong> {{ $instructeur->voertuig->type ?? 'None' }}</p>
    </div>

    <a href="{{ route('instructeurs.index') }}" class="btn btn-primary">Terug</a>
</div>
@endsection
