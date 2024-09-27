@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Facturen</h1>
    <a href="{{ route('facturen.create') }}" class="btn btn-primary">Create New Invoice</a>
    
    <table class="table mt-4">
        <thead>
            <tr>
                <th>ID</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($facturen as $factuur)
                <tr>
                    <td>{{ $factuur->id }}</td>
                    <td>{{ $factuur->amount }}</td>
                    <td>{{ $factuur->status }}</td>
                    <td>{{ $factuur->created_at->format('d-m-Y') }}</td>
                    <td>
                        <a href="{{ route('facturen.edit', $factuur->id) }}" class="btn btn-secondary">Edit</a>
                        <form action="{{ route('facturen.destroy', $factuur->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                        <a href="{{ route('facturen.show', $factuur->id) }}" class="btn btn-info">View</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
