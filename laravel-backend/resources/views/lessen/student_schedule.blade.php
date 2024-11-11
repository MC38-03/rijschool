@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Mijn rooster</h1>
    <a href="{{ route('lessen.create') }}" class="addbutton btn btn-primary mb-3">Plan een nieuwe les in</a>

    <table class="table mt-4">
        <thead>
            <tr>
                <th>Datum</th>
                <th>Start tijd</th>
                <th>Eind tijd</th>
                <th>Instructeur</th>
                <th>Voertuig</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($lessen as $les)
                <tr>
                    <td>{{ $les->datum }}</td>
                    <td>{{ \Carbon\Carbon::parse($les->begin_tijd)->format('H:i') }}</td>
                    <td>{{ \Carbon\Carbon::parse($les->eind_tijd)->format('H:i') }}</td>
                    <td>{{ $les->instructeur->naam }}</td>
                    <td>{{ $les->voertuig->type }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
