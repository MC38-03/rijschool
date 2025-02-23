@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Facturen</h1>

        @if (session('payment_success'))
            <div id="paymentModal" class="modal-overlay">
                <div class="modal-container">
                    <h2>Gelukt!</h2>
                    <button class="btn btn-primary close-modal">Afsluiten</button>
                </div>
            </div>
        @endif


        <a style="padding: 5px; border-radius: 8px;" href="{{ route('facturen.create') }}"
            class="addbutton btn btn-primary mb-3">Voeg nieuw factuur toe</a>

        <table class="table mt-4">
            <thead>
                <tr>
                    <th>Leerling</th>
                    <th>Instructeur</th>
                    <th>Bedrag</th>
                    <th>Status</th>
                    <th>Betaling</th>
                    <th>Acties</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($facturen as $factuur)
                    <tr>
                        <td>{{ $factuur->leerling ? $factuur->leerling->naam : 'Onbekend' }}</td>
                        <td>{{ $factuur->instructeur ? $factuur->instructeur->naam : 'Onbekend' }}</td>
                        <td>€ {{ number_format($factuur->bedrag, 2, ',', '.') }}</td>
                        <td>{{ $factuur->status }}</td>
                        <td>
                            @if ($factuur->status !== 'Betaald')
                            <a href="{{ route('facturen.payment', $factuur->id) }}" class="btn btn-success"
                                onclick="window.location.href='{{ route('facturen.payment', $factuur->id) }}'; return false;">
                                    Betaal
                            </a>

                            @else
                                <span class="badge badge-success">Betaald</span>
                            @endif
                        </td>


                        <td class="table-actions">
                            <a href="{{ route('facturen.show', $factuur->id) }}" class="btn btn-view">View</a>
                            <a href="{{ route('facturen.edit', $factuur->id) }}" class="btn btn-edit">Edit</a>

                            <form style="padding: 0;" action="{{ route('facturen.destroy', $factuur->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-delete"
                                    onclick="return confirm('Weet je zeker dat je deze factuur wilt verwijderen?')">Verwijder</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
@endsection

@push('styles')
    <style>
        .form {
            padding: 0 !important;
            background-color: transparent !important;
            box-shadow: none !important;
            border: none !important;

        }

        /* Main Button Styles */

        /* Action Buttons */
        .table-actions {
            display: flex;
            gap: 10px;
        }

        .btn-success {
            background-color: #28a745;
            color: white;
        }

        .btn-success:hover {
            background-color: #218838;
        }

        /* QR Code Section */
        .qr-code-wrapper {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background-color: #f8f9fa;
            border-radius: 10px;
            margin: 10px auto;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 200px;
            text-align: center;
            padding: 5px;
        }

        .qr-code-wrapper img {
            max-width: 150px;
            margin-bottom: 10px;
        }

        .qr-code-wrapper p {
            font-size: 14px;
            color: #555;
            margin-bottom: 10px;
        }

        /* Payment Button */
        .btn-pay {
            background-color: #28a745;
            color: white;
            padding: 8px 16px;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
            border: none;
            margin-top: 10px;
        }

        .btn-pay:hover {
            background-color: #218838;
        }

        /* Payment Success Modal */
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .modal-container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            width: 300px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }

        .modal-container h2 {
            color: #28a745;
        }

        /* Close Button */
        .close-modal {
            margin-top: 10px;
            padding: 5px 10px;
            background-color: #ccc;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        .close-modal:hover {
            background-color: #bbb;
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const modal = document.getElementById('paymentModal');
            const closeModal = document.querySelector('.close-modal');

            if (modal) {
                modal.style.display = 'flex'; // Dynamically show the modal

                closeModal.addEventListener('click', function () {
                    modal.style.display = 'none';
                });

                window.addEventListener('click', function (e) {
                    if (e.target === modal) {
                        modal.style.display = 'none';
                    }
                });
            }
        });



        @if(session('success'))
            $(document).ready(function () {
                $('#successModal').modal('show');
            });
        @endif

    </script>
@endpush