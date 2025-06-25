@extends('layouts.app')

@section('content')
<div class="container">
    <h3>🎰 Lucky Spin Game</h3>

    <p>Spin and win random rewards! 🎉</p>

    <form method="POST" action="{{ route('spin.submit') }}">
        @csrf
        <button type="submit">SPIN NOW 🎯</button>
    </form>
</div>
@endsection
