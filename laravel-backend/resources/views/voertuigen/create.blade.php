@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Voeg nieuw voertuig toe</h1>

    <form action="{{ route('voertuigen.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="type">Voertuig Type</label>
            <input type="text" name="type" id="type" class="form-control" required>
        </div>
        <div class="form-group mt-3">
            <label for="license_plate">Kenteken</label>
            <input type="text" name="license_plate" id="license_plate" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success mt-3">Voeg toe</button>
    </form>
</div>
@endsection
