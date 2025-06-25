<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Wallet;
// You’ll add Withdrawal model later

class AdminController extends Controller
{
    // Admin login view
    public function login()
    {
        return view('admin.login');
    }

    // Admin login logic (basic version)
    public function doLogin(Request $request)
    {
        if ($request->email === 'admin@platform.com' && $request->password === 'admin123') {
            session(['is_admin' => true]);
            return redirect()->route('admin.dashboard');
        }

        return back()->with('error', 'Invalid login credentials.');
    }

    // Admin dashboard
    public function dashboard()
    {
        if (!session('is_admin')) {
            return redirect()->route('admin.login');
        }

        $users = User::all();
        $wallets = Wallet::all();
        // $withdrawals = Withdrawal::all(); ← coming soon

        return view('admin.dashboard', compact('users', 'wallets'));
    }

    // Logout
    public function logout()
    {
        session()->forget('is_admin');
        return redirect()->route('admin.login');
    }
}
