@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Vehicle Details</h1>

    <div class="card">
        <div class="card-body">
            <h3>{{ $voertuig->type }}</h3>
            <p><strong>License Plate:</strong> {{ $voertuig->license_plate }}</p>
        </div>
    </div>

    <a href="{{ route('voertuigen.index') }}" class="btn btn-primary mt-3">Back to List</a>
</div>
@endsection
