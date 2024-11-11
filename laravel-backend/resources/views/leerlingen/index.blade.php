@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Alle Leerlingen</h1>
    <a href="{{ route('leerlingen.create') }}" class="addbutton btn btn-primary mb-3">Voeg nieuw leerling toe</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table mt-4">
        <thead>
            <tr>
                <th>Naam</th>
                <th>Achternaam</th>
                <th>Email</th>
                <th>Leeftijd</th>
                <th>Acties</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($leerlingen as $leerling)
                <tr>
                    <td>{{ $leerling->naam }}</td>
                    <td>{{ $leerling->achternaam }}</td>
                    <td>{{ $leerling->email }}</td>
                    <td>{{ \Carbon\Carbon::parse($leerling->geboortedatum)->age }}</td>
                    <td class="table-actions">
                        <a href="{{ route('leerlingen.show', $leerling->id) }}" class="btn btn-view">View</a>
                        <a href="{{ route('leerlingen.edit', $leerling->id) }}" class="btn btn-edit">Edit</a>
                        <form action="{{ route('leerlingen.destroy', $leerling->id) }}" method="POST" style="display:inline;">
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
