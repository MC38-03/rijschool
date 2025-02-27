@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Beschikbaarheden</h1>
    <a style="padding: 5px; border-radius: 8px;" href="{{ route('beschikbaarheden.create') }}" class="addbutton btn btn-primary mb-3">Voeg nieuw beschikbaarheid toe</a>

    <table class="table mt-4">
        <thead>
            <tr>
                <th>Instructeur</th>
                <th>Voertuig</th> <!-- Added Vehicle Column -->
                <th>Datum</th>
                <th>Tijd</th>
                <th>Acties</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($beschikbaarheden as $beschikbaarheid)
                <tr>
                    <td>{{ $beschikbaarheid->instructeur->naam ?? 'N/A' }}</td>
                    <td>{{ $beschikbaarheid->voertuig->type ?? 'Geen voertuig' }}</td> <!-- Added Voertuig -->
                    <td>{{ $beschikbaarheid->datum }}</td>
                    <td>{{ \Carbon\Carbon::parse($beschikbaarheid->begin_tijd)->format('H:i') }} -
                        {{ \Carbon\Carbon::parse($beschikbaarheid->eind_tijd)->format('H:i') }}</td>
                    <td class="table-actions">
                        <a href="{{ route('beschikbaarheden.show', $beschikbaarheid->id) }}" class="btn btn-view">View</a>
                        <a href="{{ route('beschikbaarheden.edit', $beschikbaarheid->id) }}" class="btn btn-edit">Edit</a>
                        <form style="padding: 0;" action="{{ route('beschikbaarheden.destroy', $beschikbaarheid->id) }}" method="POST" class="deletebtn-padding"
                            style="display:inline;">
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
