@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Welcome, {{ Auth::user()->name }}</h2>

    <div>
        <h4>Wallet Balance: ₦{{ $wallet->balance ?? 0 }}</h4>
        <p>Status: 
            @if($wallet->is_activated)
                <span style="color: green;">Activated ✅</span>
            @else
                <span style="color: red;">Not Activated ❌</span>
            @endif
        </p>
    </div>

    <div style="margin-top: 20px;">
        <a href="{{ route('tasks') }}">🧾 Complete Tasks</a><br>
        <a href="{{ route('spin') }}">🎰 Play Lucky Spin</a><br>
        <a href="{{ route('mine') }}">💣 Play Mine Game</a><br>
        <a href="{{ route('deposit.page') }}">💳 Deposit</a><br>
        <a href="{{ route('wallet') }}">💸 Withdraw / Activate</a>
    </div>
</div>
@endsection
