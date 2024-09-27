@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Availability</h1>

    <form action="{{ route('beschikbaarheden.update', $beschikbaarheid->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="instructeur_id">Instructor</label>
            <select name="instructeur_id" id="instructeur_id" class="form-control" required>
                @foreach ($instructeurs as $instructeur)
                    <option value="{{ $instructeur->id }}" {{ $beschikbaarheid->instructeur_id == $instructeur->id ? 'selected' : '' }}>
                        {{ $instructeur->naam }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group mt-3">
            <label for="datum">Date</label>
            <input type="date" name="datum" id="datum" class="form-control" value="{{ $beschikbaarheid->datum }}" required>
        </div>
        <div class="form-group mt-3">
            <label for="begin_tijd">Begin Time</label>
            <input type="time" name="begin_tijd" id="begin_tijd" class="form-control" value="{{ $beschikbaarheid->begin_tijd }}" required>
        </div>
        <div class="form-group mt-3">
            <label for="eind_tijd">End Time</label>
            <input type="time" name="eind_tijd" id="eind_tijd" class="form-control" value="{{ $beschikbaarheid->eind_tijd }}" required>
        </div>
        <button type="submit" class="btn btn-success mt-3">Update Availability</button>
    </form>
</div>
@endsection
