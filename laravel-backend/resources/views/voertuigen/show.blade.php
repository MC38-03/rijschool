@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Voertuig details</h1>

    <div class="card">
        <div class="card-body">
            <h3>{{ $voertuig->type }}</h3>
            <p><strong>kenteken:</strong> {{ $voertuig->license_plate }}</p>
        </div>
    </div>

    <a href="{{ route('voertuigen.index') }}" class="btn btn-primary mt-3">Terug naar lijst</a>
</div>
@endsection
