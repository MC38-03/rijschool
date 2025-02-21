@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Wijzig Availability</h1>

    <form action="{{ route('beschikbaarheden.update', $beschikbaarheid->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="instructeur_id">Instructeur</label>
        <select name="instructeur_id" id="instructeur_id" class="form-control" required>
            @foreach ($instructeurs as $instructeur)
                <option value="{{ $instructeur->id }}" {{ $beschikbaarheid->instructeur_id == $instructeur->id ? 'selected' : '' }}>
                    {{ $instructeur->naam }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="form-group mt-3">
        <label for="voertuig_id">Voertuig</label>
        <select name="voertuig_id" id="voertuig_id" class="form-control" required>
            <option value="">Selecteer een voertuig</option>
            @foreach ($voertuigen as $voertuig)
                <option value="{{ $voertuig->id }}" {{ $beschikbaarheid->voertuig_id == $voertuig->id ? 'selected' : '' }}>
                    {{ $voertuig->type }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="form-group mt-3">
        <label for="datum">Datum</label>
        <input type="date" name="datum" id="datum" class="form-control" value="{{ $beschikbaarheid->datum }}" required>
    </div>

    <div class="form-group mt-3">
        <label for="begin_tijd">Begin</label>
        <input type="time" name="begin_tijd" id="begin_tijd" class="form-control" value="{{ $beschikbaarheid->begin_tijd }}" required>
    </div>

    <div class="form-group mt-3">
        <label for="eind_tijd">Eind</label>
        <input type="time" name="eind_tijd" id="eind_tijd" class="form-control" value="{{ $beschikbaarheid->eind_tijd }}" required>
    </div>

    <button type="submit" class="btn btn-success mt-3">Wijzig</button>
</form>

</div>
@endsection
