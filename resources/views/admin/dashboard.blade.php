@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Admin Dashboard</h2>

    <p><a href="{{ route('admin.deposits') }}">💳 View Deposits</a></p>
    <p><a href="{{ route('admin.withdrawals') }}">💸 View Withdrawals</a></p>
    <p><a href="{{ route('logout') }}">🚪 Logout</a></p>

    <hr>

    <h4>All Users</h4>
    <ul>
        @foreach($users as $user)
            <li>{{ $user->name }} ({{ $user->email }})</li>
        @endforeach
    </ul>
</div>
@endsection
