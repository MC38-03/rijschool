@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create New Leerling</h1>
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('leerlingen.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="naam">Naam:</label>
            <input type="text" name="naam" class="form-control" value="{{ old('naam') }}">
        </div>
        <div class="form-group">
            <label for="achternaam">Achternaam:</label>
            <input type="text" name="achternaam" class="form-control" value="{{ old('achternaam') }}">
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}">
        </div>
        <div class="form-group">
            <label for="leeftijd">Leeftijd:</label>
            <input type="number" name="leeftijd" class="form-control" value="{{ old('leeftijd') }}">
        </div>
        <button type="submit" class="btn btn-primary mt-3">Create Leerling</button>
    </form>
</div>
@endsection
