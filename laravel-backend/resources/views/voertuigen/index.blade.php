@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Voertuigen</h1>
    <a href="{{ route('voertuigen.create') }}" class="btn btn-primary">Add New Vehicle</a>
    
    <table class="table mt-4">
        <thead>
            <tr>
                <th>ID</th>
                <th>Type</th>
                <th>License Plate</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($voertuigen as $voertuig)
                <tr>
                    <td>{{ $voertuig->id }}</td>
                    <td>{{ $voertuig->type }}</td>
                    <td>{{ $voertuig->license_plate }}</td>
                    <td>
                        <a href="{{ route('voertuigen.edit', $voertuig->id) }}" class="btn btn-secondary">Edit</a>
                        <form action="{{ route('voertuigen.destroy', $voertuig->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
