@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create New Invoice</h1>

    <form action="{{ route('facturen.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="amount">Amount</label>
            <input type="number" name="amount" id="amount" class="form-control" required>
        </div>
        <div class="form-group mt-3">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control">
                <option value="unpaid">Unpaid</option>
                <option value="paid">Paid</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success mt-3">Save Invoice</button>
    </form>
</div>
@endsection
