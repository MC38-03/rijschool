@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Beschikbaarheden</h1>
    <a href="{{ route('beschikbaarheden.create') }}" class="btn btn-primary">Add New Availability</a>
    
    <table class="table mt-4">
        <thead>
            <tr>
                <th>ID</th>
                <th>Instructor</th>
                <th>Date</th>
                <th>Time Slot</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($beschikbaarheden as $beschikbaarheid)
                <tr>
                    <td>{{ $beschikbaarheid->id }}</td>
                    <td>{{ $beschikbaarheid->instructeur->naam ?? 'N/A' }}</td>
                    <td>{{ $beschikbaarheid->datum }}</td>
                    <td>{{ $beschikbaarheid->begin_tijd }} - {{ $beschikbaarheid->eind_tijd }}</td>
                    <td>
                        <a href="{{ route('beschikbaarheden.edit', $beschikbaarheid->id) }}" class="btn btn-secondary">Edit</a>
                        <form action="{{ route('beschikbaarheden.destroy', $beschikbaarheid->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                        <a href="{{ route('beschikbaarheden.show', $beschikbaarheid->id) }}" class="btn btn-info">View</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
