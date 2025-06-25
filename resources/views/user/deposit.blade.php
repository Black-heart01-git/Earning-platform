@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Make Deposit</h3>

    @if(session('success')) <p style="color:green;">{{ session('success') }}</p> @endif

    <form method="POST" action="{{ route('deposit.submit') }}">
        @csrf
        <label>Amount (₦):</label><br>
        <input type="number" name="amount" min="100" required><br><br>

        <button type="submit">Submit Deposit</button>
    </form>

    <p style="margin-top: 20px;">
        Note: Admin will approve your deposit manually.
    </p>
</div>
@endsection
