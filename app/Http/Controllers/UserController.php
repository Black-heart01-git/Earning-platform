<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;
use App\Models\Wallet;

class UserController extends Controller
{
    // Home page
    public function index()
    {
        return view('welcome');
    }

    // Dashboard
    public function dashboard()
    {
        $wallet = Wallet::where('user_id', Auth::id())->first();
        return view('user.dashboard', compact('wallet'));
    }

    // Show tasks
    public function tasks()
    {
        $tasks = Task::all();
        return view('user.tasks', compact('tasks'));
    }

    // Complete task and reward user
    public function completeTask($taskId)
    {
        $task = Task::find($taskId);
        $wallet = Wallet::firstOrCreate(['user_id' => Auth::id()]);
        $wallet->addToBalance($task->reward_amount);

        return back()->with('success', 'Task completed! ₦' . $task->reward_amount . ' added to your wallet.');
    }

    // Wallet Page
    public function wallet()
    {
        $wallet = Wallet::firstOrCreate(['user_id' => Auth::id()]);
        return view('user.wallet', compact('wallet'));
    }

    // Activate account for withdrawal
    public function activate(Request $request)
    {
        $wallet = Wallet::where('user_id', Auth::id())->first();
        $wallet->is_activated = true;
        $wallet->save();

        return back()->with('success', 'Account activated successfully!');
    }

    // Withdraw request
    public function withdraw(Request $request)
    {
        $wallet = Wallet::where('user_id', Auth::id())->first();

        if (!$wallet->is_activated) {
            return back()->with('error', 'Activate your account before withdrawing.');
        }

        if ($wallet->balance < 5000) {
            return back()->with('error', 'You must have at least ₦5000 to withdraw.');
        }

        // Logic to save withdrawal request will be added later

        return back()->with('success', 'Withdrawal request sent successfully!');
    }

    // Lucky Spin (coming soon)
    public function spin()
    {
        return view('user.spin');
    }

    // Mine Game (coming soon)
    public function mine()
    {
        return view('user.mine');
    }
}
