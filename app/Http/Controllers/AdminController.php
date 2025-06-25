<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Wallet;
use App\Models\Deposit;
use App\Models\Withdrawal;

class AdminController extends Controller
{
    public function login()
    {
        return view('admin.login');
    }

    public function doLogin(Request $request)
    {
        if ($request->email === 'admin@platform.com' && $request->password === 'admin123') {
            session(['is_admin' => true]);
            return redirect()->route('admin.dashboard');
        }

        return back()->with('error', 'Invalid login credentials.');
    }

    public function dashboard()
    {
        if (!session('is_admin')) {
            return redirect()->route('admin.login');
        }

        $users = User::all();
        $wallets = Wallet::all();

        return view('admin.dashboard', compact('users', 'wallets'));
    }

    public function logout()
    {
        session()->forget('is_admin');
        return redirect()->route('admin.login');
    }

    public function deposits()
    {
        if (!session('is_admin')) return redirect()->route('admin.login');

        $deposits = Deposit::all();
        return view('admin.deposits', compact('deposits'));
    }

    public function approveDeposit($id)
    {
        $deposit = Deposit::findOrFail($id);
        $deposit->status = 'approved';
        $deposit->save();

        $wallet = Wallet::firstOrCreate(['user_id' => $deposit->user_id]);
        $wallet->addToBalance($deposit->amount);

        return back()->with('success', 'Deposit approved.');
    }

    public function withdrawals()
    {
        if (!session('is_admin')) return redirect()->route('admin.login');

        $withdrawals = Withdrawal::all();
        return view('admin.withdrawals', compact('withdrawals'));
    }

    public function approveWithdrawal($id)
    {
        $withdrawal = Withdrawal::findOrFail($id);
        $withdrawal->status = 'approved';
        $withdrawal->save();

        return back()->with('success', 'Withdrawal approved.');
    }
}
