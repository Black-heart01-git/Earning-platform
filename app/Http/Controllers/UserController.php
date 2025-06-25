<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;
use App\Models\Wallet;
use App\Models\Deposit;
use App\Models\Withdrawal;

class UserController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function dashboard()
    {
        $wallet = Wallet::where('user_id', Auth::id())->first();
        return view('user.dashboard', compact('wallet'));
    }

    public function tasks()
    {
        $tasks = Task::all();
        return view('user.tasks', compact('tasks'));
    }

    public function completeTask($taskId)
    {
        $task = Task::find($taskId);
        $wallet = Wallet::firstOrCreate(['user_id' => Auth::id()]);
        $wallet->addToBalance($task->reward_amount);

        return back()->with('success', 'Task completed! ₦' . $task->reward_amount . ' added to your wallet.');
    }

    public function wallet()
    {
        $wallet = Wallet::firstOrCreate(['user_id' => Auth::id()]);
        return view('user.wallet', compact('wallet'));
    }

    public function activate(Request $request)
    {
        $wallet = Wallet::where('user_id', Auth::id())->first();
        $wallet->is_activated = true;
        $wallet->save();

        return back()->with('success', 'Account activated successfully!');
    }

    public function withdraw(Request $request)
    {
        $wallet = Wallet::where('user_id', Auth::id())->first();

        if (!$wallet->is_activated) {
            return back()->with('error', 'Activate your account before withdrawing.');
        }

        if ($wallet->balance < 5000) {
            return back()->with('error', 'You must have at least ₦5000 to withdraw.');
        }

        Withdrawal::create([
            'user_id' => Auth::id(),
            'amount' => $wallet->balance,
            'status' => 'pending',
        ]);

        $wallet->balance = 0;
        $wallet->save();

        return back()->with('success', 'Withdrawal request sent successfully!');
    }

    public function depositPage()
    {
        $wallet = Wallet::where('user_id', Auth::id())->first();
        return view('user.deposit', compact('wallet'));
    }

    public function submitDeposit(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:100',
        ]);

        Deposit::create([
            'user_id' => Auth::id(),
            'amount' => $request->amount,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Deposit request sent. Wait for admin approval.');
    }

    public function spin()
    {
        return view('user.spin');
    }

    public function mine()
    {
        return view('user.mine');
    }
}
