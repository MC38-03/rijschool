@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Les details</h1>
    
    <div class="card">
        <div class="card-header">
            Les op {{ $les->datum }} van {{ $les->instructeur->naam }}
        </div>
        <div class="card-body">
            <p><strong>Datum:</strong> {{ $les->datum }}</p>
            <p><strong>Begin Tijd:</strong> {{ $les->begin_tijd }}</p>
            <p><strong>Eind Tijd:</strong> {{ $les->eind_tijd }}</p>
            <p><strong>Leerling:</strong> {{ $les->leerling->naam }}</p>
            <p><strong>Instructeur:</strong> {{ $les->instructeur->naam }}</p>
            <p><strong>Voertuig:</strong> {{ $les->voertuig->naam }}</p>
        </div>
        <div class="card-footer">
            <a href="{{ route('lessen.index') }}" class="btn btn-primary">Terug naar lijst</a>
            <a href="{{ route('lessen.edit', $les->id) }}" class="btn btn-warning">Wijzig</a>
            <form action="{{ route('lessen.destroy', $les->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Verwijder</button>
            </form>
        </div>
    </div>
</div>
@endsection
