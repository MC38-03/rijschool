@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Facturen</h1>
    <a href="{{ route('facturen.create') }}" class="addbutton btn btn-primary mb-3">Voeg nieuw factuur toe</a>
    
    <table class="table mt-4">
    <thead>
    <tr>
        <th>Leerling</th>
        <th>Instructeur</th>
        <th>Bedrag</th>
        <th>Status</th>
        <th>Datum</th>
        <th>Acties</th>
    </tr>
</thead>
<tbody>
    @foreach ($facturen as $factuur)
        <tr>
            <td>{{ $factuur->leerling ? $factuur->leerling->naam : 'Onbekend' }}</td>
            <td>{{ $factuur->instructeur ? $factuur->instructeur->naam : 'Onbekend' }}</td>
            <td>{{ $factuur->bedrag == floor($factuur->bedrag) ? number_format($factuur->bedrag, 0) : number_format($factuur->bedrag, 2) }}</td>
            <td>{{ $factuur->status }}</td>
            <td>{{ $factuur->datum_uitgegeven }} - {{ $factuur->verval_datum }}</td>
            <td class="table-actions">
                <a href="{{ route('facturen.show', $factuur->id) }}" class="btn btn-view">View</a>
                <a href="{{ route('facturen.edit', $factuur->id) }}" class="btn btn-edit">Edit</a>
                <form action="{{ route('facturen.destroy', $factuur->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-delete" onclick="return confirm('Weet je zeker dat je deze factuur wilt verwijderen?')">Verwijder</button>
                </form>
            </td>
        </tr>
    @endforeach
</tbody>

    </table>
</div>
@endsection
