@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Vehicle</h1>

    <form action="{{ route('voertuigen.update', $voertuig->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="type">Vehicle Type</label>
            <input type="text" name="type" id="type" class="form-control" value="{{ $voertuig->type }}" required>
        </div>
        <div class="form-group mt-3">
            <label for="license_plate">License Plate</label>
            <input type="text" name="license_plate" id="license_plate" class="form-control" value="{{ $voertuig->license_plate }}" required>
        </div>
        <button type="submit" class="btn btn-success mt-3">Update Vehicle</button>
    </form>
</div>
@endsection
