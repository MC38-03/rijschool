@extends('layouts.app')

@section('content')
    <h1>Instructeurs</h1>
    <a href="{{ route('instructeurs.create') }}" class="btn btn-primary">New Instructeur</a>
    <table class="table">
        <thead>
            <tr>
                <th>Naam</th>
                <th>Achternaam</th>
                <th>Email</th>
                <th>Voertuig</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($instructeurs as $instructeur)
                <tr>
                    <td>{{ $instructeur->naam }}</td>
                    <td>{{ $instructeur->achternaam }}</td>
                    <td>{{ $instructeur->email }}</td>
                    <td>{{ $instructeur->voertuig->naam ?? 'None' }}</td>
                    <td>
                        <a href="{{ route('instructeurs.edit', $instructeur) }}" class="btn btn-secondary">Edit</a>
                        <form action="{{ route('instructeurs.destroy', $instructeur) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
