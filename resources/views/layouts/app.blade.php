<!DOCTYPE html>
<html>
<head>
    <title>NairaEarner 💸</title>
</head>
<body style="font-family: Arial; max-width: 600px; margin: auto; padding: 20px;">
    <header style="margin-bottom: 20px;">
        <h2>NairaEarner Platform 🇳🇬</h2>
        @auth
            <p>Welcome  {{ Auth::user()->name }} | 
                <a href="{{ route('dashboard') }}">Dashboard</a> | 
                <a href="{{ route('logout') }}">Logout</a>
            </p>
        @endauth
        <hr>
    </header>

    @yield('content')

    <footer style="margin-top: 50px; font-size: 12px; color: gray;">
        <hr>
        <p>&copy; {{ date('Y') }} NairaEarner. All rights reserved.</p>
    </footer>
</body>
</html>
