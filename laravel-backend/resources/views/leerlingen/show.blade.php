@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Leerling details</h1>
    
    <div class="card">
        <div class="card-header">
            {{ $leerling->naam }} {{ $leerling->achternaam }}
        </div>
        <div class="card-body">
            <p><strong>Email:</strong> {{ $leerling->email }}</p>
            <p><strong>Leeftijd:</strong> {{ \Carbon\Carbon::parse($leerling->geboortedatum)->age }}</p>
        </div>
        <div class="card-footer">
            <a href="{{ route('leerlingen.index') }}" class="btn btn-primary">Back to List</a>
            <a href="{{ route('leerlingen.edit', $leerling->id) }}" class="btn btn-warning">Edit</a>
            <form action="{{ route('leerlingen.destroy', $leerling->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Verwijder</button>
            </form>
        </div>
    </div>
</div>
@endsection
