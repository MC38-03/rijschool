@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Mijn Rooster</h1>

    <!-- Instructor Filter -->
    <div class="mb-3">
        <label for="instructorFilter"><strong>Filter op instructeur:</strong></label>
        <select id="instructorFilter" class="form-control">
            <option value="">Alle instructeurs</option>
            @foreach ($instructeurs as $instructeur)
                <option value="{{ $instructeur->id }}">{{ $instructeur->naam }}</option>
            @endforeach
        </select>
    </div>

    <!-- Weekly Schedule Grid -->
    <div class="week-container">
        <table class="table table-bordered text-center">
            <thead class="thead-dark">
                <tr>
                    <th>Tijd</th>
                    @foreach ($weekDays as $day)
                        <th>{{ \Carbon\Carbon::parse($day)->format('d-m-Y') }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach (range(7, 20) as $hour) <!-- Generates hours from 07:00 to 20:00 -->
                    @php
                        $timeSlot = sprintf('%02d:00:00', $hour);
                    @endphp
                    <tr>
                        <td><strong>{{ $hour }}:00 - {{ $hour+1 }}:00</strong></td>
                        @foreach ($weekDays as $day)
                            <td class="align-middle">
                                @php
                                    $availableLessons = $beschikbaarheden->where('datum', $day)->where('begin_tijd', $timeSlot);
                                @endphp

                                @if ($availableLessons->isNotEmpty())
                                    @foreach ($availableLessons as $lesson)
                                        <button class="btn btn-success book-lesson mb-2"
                                            data-date="{{ $day }}"
                                            data-time="{{ $timeSlot }}"
                                            data-instructor="{{ $lesson->instructeur->naam }}"
                                            data-instructor-id="{{ $lesson->instructeur->id }}"
                                            data-vehicle="{{ $lesson->voertuig->type ?? 'Geen voertuig' }}">
                                            {{ $lesson->instructeur->naam }} - Beschikbaar
                                        </button>
                                        <br>
                                    @endforeach
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div id="bookingModal" class="modal-overlay">
    <div class="modal-container">
        <div class="modal-header">
            <h5 class="modal-title">Bevestig jouw rijles</h5>
            <button class="close-modal">&times;</button>
        </div>
        <div class="modal-body">
            <p id="bookingMessage"></p>
        </div>
        <div class="modal-footer">
            <form method="POST" action="{{ route('lessen.store') }}" id="bookingForm">
                @csrf
                <input type="hidden" name="datum" id="selectedDate">
                <input type="hidden" name="tijd" id="selectedTime">
                <input type="hidden" name="instructeur_id" id="selectedInstructorId">
                <input type="hidden" name="voertuig" id="selectedVehicle">
                <button type="submit" class="btn btn-primary">Bevestigen</button>
            </form>
            <button class="btn btn-secondary close-modal">Annuleren</button>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    let modal = document.getElementById("bookingModal");

    document.querySelectorAll(".book-lesson").forEach(button => {
        button.addEventListener("click", function () {
            let date = this.getAttribute("data-date");
            let time = this.getAttribute("data-time");
            let instructor = this.getAttribute("data-instructor");
            let instructorId = this.getAttribute("data-instructor-id");
            let vehicle = this.getAttribute("data-vehicle");

            document.getElementById("selectedDate").value = date;
            document.getElementById("selectedTime").value = time;
            document.getElementById("selectedInstructorId").value = instructorId;
            document.getElementById("selectedVehicle").value = vehicle;
            document.getElementById("bookingMessage").textContent = 
                `Bevestig dat je een les wilt boeken op ${date} om ${time} met ${instructor} in een ${vehicle}.`;

            // Show modal
            modal.style.display = "flex";
        });
    });

    // Close modal when clicking close button
    document.querySelectorAll(".close-modal").forEach(button => {
        button.addEventListener("click", function () {
            modal.style.display = "none";
        });
    });

    // Close modal when clicking outside of it
    window.addEventListener("click", function (event) {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    });
});


</script>
@endsection

@push('styles')
<style>
/* Modal Overlay - Fullscreen Background */
.modal-overlay {
    display: none; /* Hide modal by default */
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5); /* Semi-transparent background */
    z-index: 1050; /* Ensure it's above everything */
    justify-content: center;
    align-items: center;
}

/* Modal Container - Centered Box */
.modal-container {
    background: white;
    padding: 20px;
    width: 400px;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    text-align: center;
}

/* Header and Close Button */
.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.close-modal {
    background: none;
    border: none;
    font-size: 20px;
    cursor: pointer;
}

.modal-body {
    margin: 15px 0;
}

.modal-footer {
    display: flex;
    justify-content: space-between;
}
</style>
@endpush
