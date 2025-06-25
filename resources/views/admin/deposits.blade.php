@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Deposit Requests</h2>

    @foreach($deposits as $deposit)
        <div style="border: 1px solid #ccc; padding: 10px; margin-bottom: 10px;">
            <p>User ID: {{ $deposit->user_id }}</p>
            <p>Amount: ₦{{ $deposit->amount }}</p>
            <p>Status: {{ $deposit->status }}</p>

            @if($deposit->status === 'pending')
                <form method="POST" action="{{ route('admin.deposit.approve', $deposit->id) }}">
                    @csrf
                    <button type="submit">✅ Approve</button>
                </form>
            @endif
        </div>
    @endforeach
</div>
@endsection
