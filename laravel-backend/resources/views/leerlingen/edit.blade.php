@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Leerling</h1>
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('leerlingen.update', $leerling->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="naam">Naam:</label>
            <input type="text" name="naam" class="form-control" value="{{ $leerling->naam }}">
        </div>
        <div class="form-group">
            <label for="achternaam">Achternaam:</label>
            <input type="text" name="achternaam" class="form-control" value="{{ $leerling->achternaam }}">
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" class="form-control" value="{{ $leerling->email }}">
        </div>
        <div class="form-group">
            <label for="leeftijd">Leeftijd:</label>
            <input type="number" name="leeftijd" class="form-control" value="{{ $leerling->leeftijd }}">
        </div>
        <button type="submit" class="btn btn-primary mt-3">Update Leerling</button>
    </form>
</div>
@endsection
