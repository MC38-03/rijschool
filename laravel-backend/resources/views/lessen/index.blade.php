@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Mijn Rooster</h1>

        <!-- Error Messages Display -->
        @if ($errors->any())
            <div class="alert alert-danger mt-3">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

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
            <div class="table-responsive-lg">
                <table class="table table-bordered text-center">
                    <thead class="thead-dark sticky-header">
                        <tr>
                            <th style="min-width: 120px;">Tijd</th>
                            @foreach ($weekDays as $day)
                                <th style="min-width: 150px;">
                                    {{ \Carbon\Carbon::parse($day)->translatedFormat('l d-m-Y') }}
                                </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (range(7, 20) as $hour)
                            @php
                                $timeSlot = sprintf('%02d:00:00', $hour);
                            @endphp
                            <tr>
                                <td><strong>{{ $hour }}:00 - {{ $hour + 1 }}:00</strong></td>
                                @foreach ($weekDays as $day)
                                    <td class="align-middle">
                                        @php
                                            $availableLessons = $beschikbaarheden->where('datum', $day)->filter(function ($lesson) use ($timeSlot) {
                                                return $lesson->begin_tijd <= $timeSlot && $lesson->eind_tijd > $timeSlot;
                                            });

                                            $groupedLessons = $availableLessons->groupBy('instructeur_id');
                                            $isBooked = $bookedLessons->where('datum', $day)
                                                ->where('begin_tijd', '<=', $timeSlot)
                                                ->where('eind_tijd', '>', $timeSlot)
                                                ->isNotEmpty();

                                            $disabledAttr = $isBooked ? 'disabled' : '';
                                            $buttonClass = $isBooked ? 'btn-secondary disabled' : 'btn-success';
                                            $statusText = $isBooked ? 'Geboekt' : 'Beschikbaar';
                                        @endphp

                                        @if ($groupedLessons->isNotEmpty())
                                            @foreach ($groupedLessons as $lessons)
                                                @php $lesson = $lessons->first(); @endphp
                                                <button 
                                                    class="btn {{ $buttonClass }} book-lesson mb-2 w-100"
                                                    data-date="{{ $day }}"
                                                    data-time="{{ $timeSlot }}"
                                                    data-instructor="{{ $lesson->instructeur->naam }}"
                                                    data-instructor-id="{{ $lesson->instructeur->id }}"
                                                    data-vehicle-id="{{ $lesson->voertuig->id ?? '' }}"
                                                    data-vehicle-type="{{ $lesson->voertuig->type ?? 'Geen voertuig' }}"
                                                    {{ $disabledAttr }}>
                                                    {{ $lesson->instructeur->naam }} - {{ $statusText }}
                                                </button>
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
    </div>

    <!-- Booking Modal -->
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
                    <input type="hidden" name="begin_tijd" id="selectedBeginTime">
                    <input type="hidden" name="eind_tijd" id="selectedEndTime">
                    <input type="hidden" name="instructeur_id" id="selectedInstructorId">
                    <input type="hidden" name="leerling_id" id="selectedStudentId" value="{{ auth()->user()->id }}">
                    <input type="hidden" name="voertuig_id" id="selectedVehicleId">

                    <button type="submit" class="btn btn-primary">Bevestigen</button>
                </form>
            </div>
        </div>
    </div>

    <!-- JS: Full Functionality -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let modal = document.getElementById("bookingModal");

            document.querySelectorAll(".book-lesson").forEach(button => {
                button.addEventListener("click", async function () {
                    if (this.disabled) return;

                    let date = this.getAttribute("data-date");
                    let time = this.getAttribute("data-time");
                    let instructor = this.getAttribute("data-instructor");
                    let instructorId = this.getAttribute("data-instructor-id");
                    let vehicleId = this.getAttribute("data-vehicle-id");
                    let vehicleType = this.getAttribute("data-vehicle-type");

                    let [hours, minutes] = time.split(':');
                    let formattedTime = `${hours}:${minutes}`;
                    let endHour = parseInt(hours) + 1;
                    let formattedEndTime = `${endHour.toString().padStart(2, '0')}:${minutes}`;

                    if (!vehicleId) {
                        try {
                            const response = await fetch(`/api/instructor-vehicles/${instructorId}`);
                            const voertuigen = await response.json();
                            if (voertuigen.length > 0) {
                                vehicleId = voertuigen[0].id;
                                vehicleType = voertuigen[0].type;
                            }
                        } catch (error) {
                            console.error("Voertuigen ophalen mislukt", error);
                        }
                    }

                    document.getElementById("selectedDate").value = date;
                    document.getElementById("selectedBeginTime").value = formattedTime;
                    document.getElementById("selectedEndTime").value = formattedEndTime;
                    document.getElementById("selectedInstructorId").value = instructorId;
                    document.getElementById("selectedVehicleId").value = vehicleId || '';

                    document.getElementById("bookingMessage").textContent =
                        `Bevestig dat je een les wilt boeken op ${date} om ${formattedTime} met ${instructor} in een ${vehicleType || 'Geen voertuig'}.`;

                    modal.style.display = "flex";
                });
            });

            document.getElementById('instructorFilter').addEventListener('change', function () {
                let selectedInstructorId = this.value;

                document.querySelectorAll('.book-lesson').forEach(button => {
                    let instructorId = button.getAttribute('data-instructor-id');
                    if (selectedInstructorId === "" || instructorId === selectedInstructorId) {
                        button.style.display = "block";
                    } else {
                        button.style.display = "none";
                    }
                });

                document.querySelectorAll('.align-middle').forEach(cell => {
                    let visibleSlots = cell.querySelectorAll('.book-lesson[style="display: block;"]');
                    if (visibleSlots.length === 0) {
                        cell.querySelector('.text-muted')?.classList.remove('d-none');
                    } else {
                        cell.querySelector('.text-muted')?.classList.add('d-none');
                    }
                });
            });

            // Close modal functionality
            document.querySelectorAll(".close-modal").forEach(button => {
                button.addEventListener("click", function () {
                    modal.style.display = "none";
                });
            });

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
        .week-container {
            overflow-x: auto;
            padding: 10px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .btn-secondary {
            background-color: #b0b0b0 !important;
            cursor: not-allowed !important;
            color: #ffffff !important;
        }

        .btn-success {
            background-color: #4caf50 !important;
            color: white !important;
        }

        .btn {
            padding: 5px;
            font-size: 12px;
            width: 100%;
        }

        .sticky-header th {
            position: sticky;
            top: 0;
            background-color: #db893b;
            color: white;
            z-index: 10;
        }

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

        .table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        .table th, .table td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
        }
    </style>
@endpush
