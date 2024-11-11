@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Alle lessen</h1>
    <a href="{{ route('lessen.create') }}" class="addbutton btn btn-primary mb-3">Voeg nieuw les toe</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table mt-4">
        <thead>
            <tr>
                <th>Datum</th>
                <th>Begin Tijd</th>
                <th>Eind Tijd</th>
                <th>Leerling</th>
                <th>Instructeur</th>
                <th>Voertuig</th>
                <th>Acties</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($lessen as $les)
                <tr>
                    <td>{{ $les->datum }}</td>
                    <td>{{ \Carbon\Carbon::parse($les->begin_tijd)->format('H:i') }}</td>
                    <td>{{ \Carbon\Carbon::parse($les->eind_tijd)->format('H:i') }}</td>
                    <td>{{ $les->leerling->naam }}</td>
                    <td>{{ $les->instructeur->naam }}</td>
                    <td>{{ $les->voertuig->type }}</td>
                    <td class="table-actions">
                        <a href="{{ route('lessen.show', $les->id) }}" class="btn btn-view">View</a>
                        <a href="{{ route('lessen.edit', $les->id) }}" class="btn btn-edit">Edit</a>
                        <form action="{{ route('lessen.destroy', $les->id) }}" method="POST" style="display:inline;">
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
