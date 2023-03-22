<?php

namespace App\Http\Controllers;
use App\Models\Deposit;
use App\Models\Withdraw;
use App\Models\Myinvestment;
use App\Models\Network;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
        $pageTitle = "Dashboard";

        $totalInvest = Myinvestment::where('user_id', auth()->user()->id)->where('status', 'active')->orWhere('status', 'ended')->where('user_id', auth()->user()->id)->sum('amount');
        $currentInvest = Myinvestment::where('user_id', auth()->user()->id)->where('status', 1)->latest()->first('amount');
        // $currentPlan = Payment::with('plan')->where('user_id', auth()->user()->id)->where('payment_status', 1)->latest()->first();
        // $allPlan = Payment::with('plan')->where('user_id', auth()->user()->id)->latest()->paginate(10, ['*'], 'plan');
        $withdraw = Withdraw::where('user_id', auth()->user()->id)->where('status', 'success')->sum('amount');
        // $interestLogs = UserInterest::with('payment')->where('user_id', auth()->user()->id)->latest()->paginate(10, ['*'], 'log');

        $commison = Network::where('user_id', auth()->user()->id)->sum('amount_earned');

        $pendingInvest = Myinvestment::where('user_id', auth()->user()->id)->where('status', 'pending')->sum('amount');
        $pendingWithdraw = Withdraw::where('user_id', auth()->user()->id)->where('status', 'pending')->sum('amount');
        $totalDeposit = auth()->user()->deposits()->where('status', 'success')->sum('amount');

        return view('theme2.user.dashboard',compact('pageTitle','pendingInvest','totalInvest','pendingWithdraw','totalDeposit','commison','currentInvest','withdraw'));
    }
    
}
