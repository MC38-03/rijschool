@extends('layouts.app')

@section('content')
    <h1>Wijzig Instructeur</h1>
    <form action="{{ route('instructeurs.update', $instructeur) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="naam">Naam</label>
            <input type="text" name="naam" class="form-control" value="{{ $instructeur->naam }}" required>
        </div>
        <div class="form-group">
            <label for="achternaam">Achternaam</label>
            <input type="text" name="achternaam" class="form-control" value="{{ $instructeur->achternaam }}" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" value="{{ $instructeur->email }}" required>
        </div>
        <div class="form-group">
            <label for="voertuig_id">Voertuig</label>
            <select name="voertuig_id" class="form-control">
                <option value="">None</option>
                @foreach ($voertuigen as $voertuig)
                    <option value="{{ $voertuig->id }}" {{ $instructeur->voertuig_id == $voertuig->id ? 'selected' : '' }}>{{ $voertuig->naam }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">Wijzig</button>
    </form>
@endsection
