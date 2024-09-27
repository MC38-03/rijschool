@extends('layouts.app')

@section('content')
<div class="container">
    <h1>All Lessen</h1>
    <a href="{{ route('lessen.create') }}" class="btn btn-primary mb-3">Add New Les</a>
    
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Datum</th>
                <th>Begin Tijd</th>
                <th>Eind Tijd</th>
                <th>Leerling</th>
                <th>Instructeur</th>
                <th>Voertuig</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($lessen as $les)
                <tr>
                    <td>{{ $les->id }}</td>
                    <td>{{ $les->datum }}</td>
                    <td>{{ $les->begin_tijd }}</td>
                    <td>{{ $les->eind_tijd }}</td>
                    <td>{{ $les->leerling->naam }}</td>
                    <td>{{ $les->instructeur->naam }}</td>
                    <td>{{ $les->voertuig->type }}</td>
                    <td>
                        <a href="{{ route('lessen.show', $les->id) }}" class="btn btn-info">View</a>
                        <a href="{{ route('lessen.edit', $les->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('lessen.destroy', $les->id) }}" method="POST" class="d-inline">
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
