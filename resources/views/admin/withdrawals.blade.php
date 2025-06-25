@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Withdrawal Requests</h2>

    @foreach($withdrawals as $withdrawal)
        <div style="border: 1px solid #ccc; padding: 10px; margin-bottom: 10px;">
            <p>User ID: {{ $withdrawal->user_id }}</p>
            <p>Amount: ₦{{ $withdrawal->amount }}</p>
            <p>Status: {{ $withdrawal->status }}</p>

            @if($withdrawal->status === 'pending')
                <form method="POST" action="{{ route('admin.withdrawal.approve', $withdrawal->id) }}">
                    @csrf
                    <button type="submit">✅ Approve</button>
                </form>
            @endif
        </div>
    @endforeach
</div>
@endsection
