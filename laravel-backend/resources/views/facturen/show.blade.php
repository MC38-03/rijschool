@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Factuur Details</h1>

    <div class="card p-4 mb-4">
        <h3>Factuur #{{ $factuur->id }}</h3>
        <p><strong>Instructeur:</strong> {{ $factuur->instructeur ? $factuur->instructeur->naam : 'N/A' }}</p>
        <p><strong>Leerling:</strong> {{ $factuur->leerling ? $factuur->leerling->naam : 'N/A' }}</p>
        <p><strong>Bedrag:</strong> €{{ $factuur->bedrag }}</p>
        <p><strong>Uitgegeven:</strong> {{ \Carbon\Carbon::parse($factuur->datum_uitgegeven)->format('d-m-Y') }}</p>
        <p><strong>Vervaldatum:</strong> {{ \Carbon\Carbon::parse($factuur->verval_datum)->format('d-m-Y') }}</p>
        <p><strong>Status:</strong> {{ ucfirst($factuur->status) }}</p>
    </div>

    <a href="{{ route('facturen.index') }}" class="btn btn-primary">Terug</a>
</div>
@endsection