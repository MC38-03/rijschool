@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Voertuigen</h1>
    <a href="{{ route('voertuigen.create') }}" class="addbutton btn btn-primary mb-3">Voeg nieuw voertuig toe</a>

    <table class="table mt-4">
        <thead>
            <tr>
                <th>Type</th>
                <th>Kenteken</th>
                <th>Acties</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($voertuigen as $voertuig)
                <tr>
                    <td>{{ $voertuig->type }}</td>
                    <td>{{ $voertuig->license_plate }}</td>
                    <td class="table-actions">
                        <a href="{{ route('voertuigen.edit', $voertuig->id) }}" class="btn btn-edit">Wijzig</a>
                        <form action="{{ route('voertuigen.destroy', $voertuig->id) }}" method="POST"
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