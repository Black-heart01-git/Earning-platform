@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Wallet & Withdraw</h3>

    <p>Balance: ₦{{ $wallet->balance ?? 0 }}</p>

    @if(session('success')) <p style="color:green;">{{ session('success') }}</p> @endif
    @if(session('error')) <p style="color:red;">{{ session('error') }}</p> @endif

    @if(!$wallet->is_activated)
        <form method="POST" action="{{ route('activate') }}">
            @csrf
            <button type="submit">Activate Account 🔓</button>
        </form>
    @else
        <form method="POST" action="{{ route('withdraw') }}">
            @csrf
            <button type="submit">Withdraw Now 💵</button>
        </form>
    @endif
</div>
@endsection
