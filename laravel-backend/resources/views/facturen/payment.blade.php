@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1>Betalingsoverzicht</h1>

        <div class="card mt-4">
            <div class="card-body text-center">
                <h5 class="card-title">Factuurdetails</h5>
                <p><strong>Leerling:</strong> {{ $factuur->leerling ? $factuur->leerling->naam : 'Onbekend' }}</p>
                <p><strong>Instructeur:</strong> {{ $factuur->instructeur ? $factuur->instructeur->naam : 'Onbekend' }}</p>
                <p><strong>Bedrag:</strong> € {{ number_format($factuur->bedrag, 2, ',', '.') }}</p>
                <p><strong>Status:</strong> {{ $factuur->status }}</p>

                @if ($factuur->status !== 'Betaald')
                    <div class="mt-4">
                        <h5>Scan de QR-code om te betalen</h5>
                        <img src="{{ $qrCode }}" alt="QR Code" class="img-fluid" >
                        <form style="padding: 4px; box-shadow: none !important; border: none !important;" action="{{ route('facturen.confirm', $factuur->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success mt-3">Bevestig Betaling</button>
                        </form>
                    </div>
                @else
                    <div class="alert alert-success mt-3">
                        Deze factuur is al betaald.
                    </div>
                @endif

                <a href="{{ route('facturen.index') }}" class="btn btn-secondary mt-3">Annuleren</a>
            </div>
        </div>
    </div>
@endsection
