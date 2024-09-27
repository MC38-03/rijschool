@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Invoice Details</h1>

    <div class="card">
        <div class="card-body">
            <h3>Invoice #{{ $factuur->id }}</h3>
            <p><strong>Amount:</strong> €{{ $factuur->amount }}</p>
            <p><strong>Status:</strong> {{ ucfirst($factuur->status) }}</p>
            <p><strong>Created At:</strong> {{ $factuur->created_at->format('d-m-Y') }}</p>
        </div>
    </div>

    <a href="{{ route('facturen.index') }}" class="btn btn-primary mt-3">Back to List</a>
</div>
@endsection
