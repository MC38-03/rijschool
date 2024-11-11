@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Maak een nieuwe les aan</h1>
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('lessen.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="datum">Datum:</label>
            <input type="date" name="datum" class="form-control" value="{{ old('datum') }}">
        </div>
        <div class="form-group">
            <label for="begin_tijd">Begin Tijd:</label>
            <input type="time" name="begin_tijd" class="form-control" value="{{ old('begin_tijd') }}">
        </div>
        <div class="form-group">
            <label for="eind_tijd">Eind Tijd:</label>
            <input type="time" name="eind_tijd" class="form-control" value="{{ old('eind_tijd') }}">
        </div>
        <div class="form-group">
            <label for="leerling_id">Leerling:</label>
            <select name="leerling_id" class="form-control">
                @foreach($leerlingen as $leerling)
                    <option value="{{ $leerling->id }}">{{ $leerling->naam }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="instructeur_id">Instructeur:</label>
            <select name="instructeur_id" class="form-control">
                @foreach($instructeurs as $instructeur)
                    <option value="{{ $instructeur->id }}">{{ $instructeur->naam }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="voertuig_id">Voertuig:</label>
            <select name="voertuig_id" class="form-control">
                @foreach($voertuigen as $voertuig)
                    <option value="{{ $voertuig->id }}">{{ $voertuig->type }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Maak les aan</button>
    </form>
</div>
@endsection
