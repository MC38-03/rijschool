@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Voeg nieuw beschikbaarheid toe</h1>

    <form id="availabilityForm" action="{{ route('beschikbaarheden.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="instructeur_id">Instructeur</label>
            <select name="instructeur_id" id="instructeur_id" class="form-control" required>
                @foreach ($instructeurs as $instructor)
                    <option value="{{ $instructor->id }}">{{ $instructor->naam }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group mt-3">
            <label for="voertuig_id">Voertuig</label>
            <select name="voertuig_id" id="voertuig_id" class="form-control" required>
                <option value="">Selecteer een voertuig</option>
                @foreach ($voertuigen as $voertuig)
                    <option value="{{ $voertuig->id }}">{{ $voertuig->type }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group mt-3">
            <label for="datum">Datum</label>
            <input type="date" name="datum" id="datum" class="form-control" required>
        </div>

        <div class="form-group mt-3">
            <label for="begin_tijd">Begin</label>
            <input type="time" name="begin_tijd" id="begin_tijd" class="form-control" required>
        </div>

        <div class="form-group mt-3">
            <label for="eind_tijd">Eind</label>
            <input type="time" name="eind_tijd" id="eind_tijd" class="form-control" required>
        </div>

        <button type="button" id="confirmButton" class="btn btn-success mt-3">Voeg toe</button>
    </form>
</div>

<!-- Confirmation Modal -->
<div id="confirmationModal" class="modal-overlay">
    <div class="modal-container">

        <div class="modal-body">
            <p id="confirmationMessage">Weet je zeker dat je deze beschikbaarheid wilt toevoegen?</p>
        </div>
        <div class="modal-footer">
            <button id="confirmSubmit" class="btn btn-primary">Bevestigen</button>
            <button id="cancelButton" class="btn btn-secondary">Annuleren</button>
        </div>
    </div>
</div>

@endsection


@push('styles')
<style>
    .modal-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 1050;
        justify-content: center;
        align-items: center;
    }


    .modal-container {
        background: white;
        padding: 20px;
        width: 400px;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        text-align: center;
    }

    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        text-align: center;
    }

    .modal-body {
        margin: 15px 0;
    }

    .modal-footer {
        display: flex;
        justify-content: space-between;
    }

    .close-modal {
        background: none;
        border: none;
        font-size: 20px;
        cursor: pointer;
    }

    .btn-primary {
        background-color: #4caf50;
        color: white;
        padding: 10px 20px;
        border-radius: 5px;
        border: none;
    }

    .btn-secondary {
        background-color: #b0b0b0;
        color: white;
        padding: 10px 20px;
        border-radius: 5px;
        border: none;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('availabilityForm');
        const confirmButton = document.getElementById('confirmButton');
        const confirmationModal = document.getElementById('confirmationModal');
        const confirmationMessage = document.getElementById('confirmationMessage');
        const confirmSubmit = document.getElementById('confirmSubmit');
        const cancelButton = document.getElementById('cancelButton');

        // Open the confirmation modal when clicking "Voeg toe"
        confirmButton.addEventListener('click', function () {
            confirmationMessage.textContent = 'Weet je zeker dat je deze beschikbaarheid wilt toevoegen?';
            confirmSubmit.style.display = 'inline-block';
            cancelButton.style.display = 'inline-block'; // Show Annuleren button again
            confirmationModal.style.display = 'flex';
        });

        // Confirm the form submission
        confirmSubmit.addEventListener('click', async function () {
            const formData = new FormData(form);

            try {
                const response = await fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    }
                });

                if (response.ok) {
                    // Show success message without closing the modal
                    confirmationMessage.textContent = '✅ Gelukt!';
                    confirmSubmit.style.display = 'none'; // Hide confirm button
                    cancelButton.style.display = 'none'; // Hide cancel button

                    // Redirect after 2 seconds
                    setTimeout(() => {
                        window.location.href = '/beschikbaarheden';
                    }, 2000);
                } else {
                    confirmationMessage.textContent = '❌ Er ging iets mis. Probeer het opnieuw.';
                }
            } catch (error) {
                console.error('Fout bij verzenden:', error);
                confirmationMessage.textContent = '❌ Fout tijdens verzenden.';
            }
        });

        // Close the modal without submitting
        cancelButton.addEventListener('click', function () {
            confirmationModal.style.display = 'none';
        });

        // Close the modal if clicked outside
        window.addEventListener('click', function (event) {
            if (event.target === confirmationModal) {
                confirmationModal.style.display = 'none';
            }
        });
    });
</script>
@endpush


