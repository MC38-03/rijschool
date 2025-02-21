@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Wijzig Les</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('lessen.update', $les->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="datum">Datum:</label>
                <input type="date" name="datum" class="form-control" value="{{ $les->datum }}">
            </div>
            <div class="form-group">
                <label for="begin_tijd">Begin Tijd:</label>
                <input type="time" name="begin_tijd" class="form-control" value="{{ $les->begin_tijd }}">
            </div>
            <div class="form-group">
                <label for="eind_tijd">Eind Tijd:</label>
                <input type="time" name="eind_tijd" class="form-control" value="{{ $les->eind_tijd }}">
            </div>
            <div class="form-group">
                <label for="leerling_id">Leerling:</label>
                <select name="leerling_id" class="form-control">
                    @foreach($leerlingen as $leerling)
                        <option value="{{ $leerling->id }}" {{ $les->leerling_id == $leerling->id ? 'selected' : '' }}>
                            {{ $leerling->naam }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="instructeur_id">Instructeur:</label>
                <select name="instructeur_id" class="form-control">
                    @foreach($instructeurs as $instructeur)
                        <option value="{{ $instructeur->id }}" {{ $les->instructeur_id == $instructeur->id ? 'selected' : '' }}>
                            {{ $instructeur->naam }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="voertuig_id">Voertuig:</label>
                <select name="voertuig_id" class="form-control">
                    @foreach($voertuigen as $voertuig)
                        <option value="{{ $voertuig->id }}" {{ $les->voertuig_id == $voertuig->id ? 'selected' : '' }}>
                            {{ $voertuig->naam }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Wijzig les</button>
        </form>
    </div>
@endsection