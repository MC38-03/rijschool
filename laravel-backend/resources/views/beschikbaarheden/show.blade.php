@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Availability Details</h1>

    <div class="card">
        <div class="card-body">
            <h3>Availability #{{ $beschikbaarheid->id }}</h3>

            @if($beschikbaarheid->instructeur)
                <p><strong>Instructor:</strong> {{ $beschikbaarheid->instructeur->naam }}</p>
            @else
                <p><strong>Instructor:</strong> Not Assigned</p>
            @endif

            <p><strong>Date:</strong> {{ $beschikbaarheid->datum }}</p>
            <p><strong>Begin Time:</strong> {{ $beschikbaarheid->begin_tijd }}</p>
            <p><strong>End Time:</strong> {{ $beschikbaarheid->eind_tijd }}</p>
        </div>
    </div>

    <a href="{{ route('beschikbaarheden.index') }}" class="btn btn-primary mt-3">Back to List</a>
</div>
@endsection
