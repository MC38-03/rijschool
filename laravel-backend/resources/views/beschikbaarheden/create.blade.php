@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add New Availability</h1>

    <form action="{{ route('beschikbaarheden.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="instructeur_id">Instructor</label>
            <select name="instructeur_id" id="instructeur_id" class="form-control" required>
                @foreach ($instructeurs as $instructor)
                    <option value="{{ $instructor->id }}">{{ $instructor->naam }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group mt-3">
            <label for="datum">Date</label>
            <input type="date" name="datum" id="datum" class="form-control" required>
        </div>
        <div class="form-group mt-3">
            <label for="begin_tijd">Begin Time</label>
            <input type="time" name="begin_tijd" id="begin_tijd" class="form-control" required>
        </div>
        <div class="form-group mt-3">
            <label for="eind_tijd">End Time</label>
            <input type="time" name="eind_tijd" id="eind_tijd" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success mt-3">Save Availability</button>
    </form>
</div>
@endsection
