@extends('layouts.app')

@section('content')
<div class="container">
    <h1>All Leerlingen</h1>
    <a href="{{ route('leerlingen.create') }}" class="btn btn-primary mb-3">Add New Leerling</a>
    
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Naam</th>
                <th>Achternaam</th>
                <th>Email</th>
                <th>Leeftijd</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($leerlingen as $leerling)
                <tr>
                    <td>{{ $leerling->id }}</td>
                    <td>{{ $leerling->naam }}</td>
                    <td>{{ $leerling->achternaam }}</td>
                    <td>{{ $leerling->email }}</td>
                    <td>{{ $leerling->leeftijd }}</td>
                    <td>
                        <a href="{{ route('leerlingen.show', $leerling->id) }}" class="btn btn-info">View</a>
                        <a href="{{ route('leerlingen.edit', $leerling->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('leerlingen.destroy', $leerling->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
