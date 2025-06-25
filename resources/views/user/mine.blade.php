@extends('layouts.app')

@section('content')
<div class="container">
    <h3>💣 Mine Game</h3>

    <p>Click to play and win! Random chance to lose or gain balance.</p>

    <form method="POST" action="{{ route('mine.submit') }}">
        @csrf
        <button type="submit">Play Mine Game 🪙</button>
    </form>
</div>
@endsection
