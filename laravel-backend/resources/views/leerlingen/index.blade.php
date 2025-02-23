@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Alle Leerlingen</h1>

    <!-- Search Form -->
    <form method="GET" action="{{ route('leerlingen.index') }}" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Zoek op naam of e-mail" value="{{ request('search') }}">
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit">Zoeken</button>
            </div>
        </div>
    </form>

    <a style="padding: 5px;" href="{{ route('leerlingen.create') }}" class="addbutton btn btn-primary mb-3">Voeg nieuw leerling toe</a>

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
            @forelse ($leerlingen as $leerling)
                <tr>
                    <td>{{ $leerling->naam }}</td>
                    <td>{{ $leerling->achternaam }}</td>
                    <td>{{ $leerling->email }}</td>
                    <td>{{ \Carbon\Carbon::parse($leerling->geboortedatum)->age }}</td>
                    <td class="table-actions">
                        <a href="{{ route('leerlingen.show', $leerling->id) }}" class="btn btn-view">View</a>
                        <a href="{{ route('leerlingen.edit', $leerling->id) }}" class="btn btn-edit">Edit</a>
                        <form style="padding: 0;" action="{{ route('leerlingen.destroy', $leerling->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-delete">Verwijder</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Geen leerlingen gevonden</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pagination Links -->
    <div class="d-flex justify-content-center">
        {{ $leerlingen->links() }}
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Container en algemene layout */
    .container {
        background: #fff;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        margin-top: 30px;
    }

    h1 {
        text-align: center;
        font-weight: bold;
        margin-bottom: 30px;
    }

    /* Zoekbalk */
    .input-group {
        display: flex;
        gap: 15px;
        margin-bottom: 20px;
        align-items: center;
    }

    .form-control {
        flex-grow: 1;
        padding: 12px;
        border-radius: 8px;
        border: 1px solid #ccc;
    }

    .btn-search {
        background-color: #a65e2e;
        color: white;
        padding: 10px 25px;
        border-radius: 8px;
        border: none;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .btn-search:hover {
        background-color: #854b24;
    }

    /* Voeg leerling toe knop */
    .addbutton {
        background-color: #008000;
        color: white;
        padding: 10px 20px;
        border-radius: 8px;
        border: none;
        margin: 15px 0;
        display: inline-block;
        transition: background-color 0.3s ease;
    }

    .addbutton:hover {
        background-color: #006400;
    }

    /* Tabel Styling */
    .table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .table th, .table td {
        padding: 15px 10px;
        text-align: center;
        border: 1px solid #e0e0e0;
    }

    .table th {
        background-color: #f5f5f5;
        font-weight: bold;
    }

    .table tbody tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    /* Acties netjes gecentreerd en uitgelijnd */
    .table-actions {
        display: flex;
        justify-content: center;
        gap: 8px;
        align-items: center;
    }

    /* Actieknoppen */
    .btn {
        padding: 8px 14px;
        border-radius: 8px;
        cursor: pointer;
        border: none;
        transition: all 0.3s ease;
    }

    .btn-view {
        background-color: #3498db;
        color: white;
    }

    .btn-edit {
        background-color: #f0ad4e;
        color: white;
    }

    .btn-delete {
        background-color: #d9534f;
        color: white;
    }

    .btn:hover {
        opacity: 0.9;
    }

    /* Responsive gedrag */
    @media (max-width: 768px) {
        .form-control {
            width: 100%;
        }

        .btn {
            padding: 6px 10px;
        }

        .table th, .table td {
            padding: 10px;
            font-size: 12px;
        }

        .table-actions {
            flex-direction: column;
            gap: 5px;
        }
    }
</style>
@endpush


