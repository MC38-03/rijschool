@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Maak een nieuwe les aan</h1>

    <!-- Display Form Validation Errors -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Dynamic Availability Error -->
    <div id="availabilityError" class="alert alert-danger d-none"></div>

    <form action="{{ route('lessen.store') }}" method="POST" id="lessonForm">
        @csrf
        <div class="form-group">
            <label for="datum">Datum:</label>
            <input type="date" name="datum" class="form-control" id="datum" value="{{ old('datum') }}">
        </div>
        <div class="form-group">
            <label for="begin_tijd">Begin Tijd:</label>
            <input type="time" name="begin_tijd" class="form-control" id="begin_tijd" value="{{ old('begin_tijd') }}">
        </div>
        <div class="form-group">
            <label for="eind_tijd">Eind Tijd:</label>
            <input type="time" name="eind_tijd" class="form-control" id="eind_tijd" value="{{ old('eind_tijd') }}">
        </div>
        <div class="form-group">
            <label for="leerling_id">Leerling:</label>
            <select name="leerling_id" class="form-control">
                @foreach($leerlingen as $leerling)
                    <option value="{{ $leerling->id }}">{{ $leerling->naam }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="instructeur_id">Instructeur:</label>
            <select name="instructeur_id" class="form-control" id="instructeur_id">
                @foreach($instructeurs as $instructeur)
                    <option value="{{ $instructeur->id }}">{{ $instructeur->naam }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="voertuig_id">Voertuig:</label>
            <select name="voertuig_id" class="form-control">
                @foreach($voertuigen as $voertuig)
                    <option value="{{ $voertuig->id }}">{{ $voertuig->type }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary mt-3" id="submitLesson">Maak les aan</button>
    </form>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById('lessonForm');
    const errorDiv = document.getElementById('availabilityError');

    // Trigger validation when any relevant field changes
    ['datum', 'begin_tijd', 'eind_tijd', 'instructeur_id'].forEach(id => {
        document.getElementById(id).addEventListener('change', validateAvailability);
    });

    form.addEventListener('submit', function (e) {
        if (errorDiv.classList.contains('d-block')) {
            e.preventDefault(); // Prevent submission if error exists
        }
    });

    async function validateAvailability() {
        const datum = document.getElementById('datum').value;
        const beginTijd = document.getElementById('begin_tijd').value;
        const eindTijd = document.getElementById('eind_tijd').value;
        const instructeurId = document.getElementById('instructeur_id').value;

        if (datum && beginTijd && eindTijd && instructeurId) {
            const response = await fetch("{{ route('lessen.checkAvailability') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    datum: datum,
                    begin_tijd: beginTijd,
                    eind_tijd: eindTijd,
                    instructeur_id: instructeurId
                })
            });

            const data = await response.json();

            if (!data.available) {
                errorDiv.textContent = data.message;
                errorDiv.classList.remove('d-none');
                errorDiv.classList.add('d-block');
                document.getElementById('submitLesson').disabled = true;
            } else {
                errorDiv.classList.remove('d-block');
                errorDiv.classList.add('d-none');
                document.getElementById('submitLesson').disabled = false;
            }
        }
    }
});
</script>
@endsection
