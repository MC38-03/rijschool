@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Voeg nieuw factuur toe</h1>

    <form action="{{ route('facturen.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="instructeur_id">Instructeur</label>
            <select name="instructeur_id" id="instructeur_id" class="form-control" required>
                @foreach ($instructeurs as $instructeur)
                    <option value="{{ $instructeur->id }}">{{ $instructeur->naam }}</option>
                @endforeach
            </select>
        </div>
        
        <div class="form-group mt-3">
            <label for="leerling_id">Leerling</label>
            <select name="leerling_id" id="leerling_id" class="form-control" required>
                @foreach ($leerlingen as $leerling)
                    <option value="{{ $leerling->id }}">{{ $leerling->naam }}</option>
                @endforeach
            </select>
        </div>
        
        <div class="form-group mt-3">
            <label for="bedrag">Bedrag</label>
            <input type="number" name="bedrag" id="bedrag" class="form-control" required>
        </div>
        
        <div class="form-group mt-3">
            <label for="datum_uitgegeven">Uitgegeven</label>
            <input type="date" name="datum_uitgegeven" id="datum_uitgegeven" class="form-control" required>
        </div>
        
        <div class="form-group mt-3">
            <label for="verval_datum">Vervaldatum</label>
            <input type="date" name="verval_datum" id="verval_datum" class="form-control" required>
        </div>
        
        <div class="form-group mt-3">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control">
                <option value="open">open</option>
                <option value="betaald">betaald</option>
            </select>
        </div>
        
        <button type="submit" class="btn btn-success mt-3">Voeg toe</button>
    </form>
</div>
@endsection
