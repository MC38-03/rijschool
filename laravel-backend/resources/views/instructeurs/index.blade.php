@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Instructeurs</h1>
    <a style="padding: 5px; border-radius: 8px;" href="{{ route('instructeurs.create') }}" class="addbutton btn btn-primary mb-3">Nieuw Instructeur toevoegen</a>
    
    <table class="table mt-4">
        <thead>
            <tr>
                <th>Naam</th>
                <th>Achternaam</th>
                <th>Email</th>
                <th>Voertuig</th>
                <th>Acties</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($instructeurs as $instructeur)
                <tr>
                    <td>{{ $instructeur->naam }}</td>
                    <td>{{ $instructeur->achternaam }}</td>
                    <td>{{ $instructeur->email }}</td>
                    <td>{{ $instructeur->voertuig->type ?? 'None' }}</td>
                    <td class="table-actions">
                        <a href="{{ route('instructeurs.show', $instructeur) }}" class="btn btn-view">View</a>
                        <a href="{{ route('instructeurs.edit', $instructeur) }}" class="btn btn-edit">Edit</a>
                        <form action="{{ route('instructeurs.destroy', $instructeur) }}" method="POST" class="inline-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-delete">Verwijder</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
