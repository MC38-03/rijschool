@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Invoice</h1>

    <form action="{{ route('facturen.update', $factuur->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="amount">Amount</label>
            <input type="number" name="amount" id="amount" class="form-control" value="{{ $factuur->amount }}" required>
        </div>
        <div class="form-group mt-3">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control">
                <option value="unpaid" {{ $factuur->status == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                <option value="paid" {{ $factuur->status == 'paid' ? 'selected' : '' }}>Paid</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success mt-3">Update Invoice</button>
    </form>
</div>
@endsection
