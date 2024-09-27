@extends('layouts.app')

@section('content')
    <h1>Instructeur Details</h1>
    <p>Naam: {{ $instructeur->naam }}</p>
    <p>Achternaam: {{ $instructeur->achternaam }}</p>
    <p>Email: {{ $instructeur->email }}</p>
    <p>Voertuig: {{ $instructeur->voertuig->naam ?? 'None' }}</p>
    <a href="{{ route('instructeurs.index') }}" class="btn btn-primary">Back</a>
@endsection
