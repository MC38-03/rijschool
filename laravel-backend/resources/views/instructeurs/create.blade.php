@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add New Instructor</h1>

    <form action="{{ route('instructeurs.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="naam">First Name</label>
            <input type="text" name="naam" id="naam" class="form-control" required>
        </div>

        <div class="form-group mt-3">
            <label for="achternaam">Last Name</label>
            <input type="text" name="achternaam" id="achternaam" class="form-control" required>
        </div>

        <div class="form-group mt-3">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>

        <div class="form-group mt-3">
            <label for="voertuig_id">Vehicle</label>
            <select name="voertuig_id" id="voertuig_id" class="form-control">
                <option value="">No Vehicle</option>
                @foreach ($voertuigen as $voertuig)
                    <option value="{{ $voertuig->id }}">{{ $voertuig->type }} - {{ $voertuig->license_plate }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Save Instructor</button>
    </form>
</div>
@endsection
