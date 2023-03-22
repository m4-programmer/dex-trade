<?php

namespace App\Http\Controllers\Admin;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Withdraw;
use App\Models\Deposit;
use App\Models\Myinvestment;
use App\Models\InvestmentPlan;
use App\Models\Crypto_methods;

use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
    public function dashboard()
    {
        $data['pageTitle'] = 'Dashboard';
        $data['navDashboardActiveClass'] = "active";

        $data['totalPayments'] = Myinvestment::where('status', 'active')->orWhere('status', 'ended')->sum('amount');
        $data['totalPendingPayments'] = Myinvestment::where('status', 'pending')->sum('amount');

        // $data['totalPayments'] = Payment::where('payment_status', 1)->sum('amount');
        // $data['totalPendingPayments'] = Payment::where('payment_status', 0)->sum('final_amount');
        $data['totalWithdraw'] = Withdraw::where('status', 'success')->sum('amount');

        $data['totalUser'] = User::where('role_as', 'user')->count();

        $data['activeUser'] = User::where('role_as', 'user')->count();

        $data['deActiveUser'] = 0;

        $months = collect([]);
        $totalAmount = collect([]);
        $data['users'] = User::where('role_as', 'user')->latest()->paginate(5);
        // Payment::where('status', 1)
        //     ->select(DB::raw('SUM(amount) as total'), DB::raw('MONTHNAME(created_at) month'))
        //     ->groupby('month')
        //     ->get()
        //     ->map(function ($q) use ($months, $totalAmount) {
        //         $months->push($q->month);
        //         $totalAmount->push($q->total);
        //     });

        $data['months'] = $months;
        $data['totalAmount'] = $totalAmount;

        $withdrawMonths = collect([]);
        $withdrawTotalAmount = collect([]);
        $withdrawMonths = Withdraw::where('status', 'active')
            ->select(DB::raw('SUM(amount) as total'), DB::raw('MONTHNAME(created_at) month'))
            ->groupby('month')
            ->get()
            ->map(function ($q) use ($withdrawMonths, $withdrawTotalAmount) {
                $withdrawMonths->push($q->month);
                $withdrawTotalAmount->push($q->total);
            });

        $data['withdrawMonths'] = $withdrawMonths;
        $data['withdrawTotalAmount'] = $withdrawTotalAmount;
        $data['totalGateways'] = Crypto_methods::where('status', 'active')->count();
        $data['totalWithdrawCharge'] = 0;
        $data['totalWithdrawGateways'] = Crypto_methods::where('status', 'active')->count();
        $data['totalInterest'] = 0;
        $data['pendignWithdraw'] = Withdraw::where('status', 'pending')->sum('amount');
        $data['totalDeposit'] = Deposit::where('payment_type', 'deposits')->where('status', 'success')->sum('amount');


        return view('backend.dashboard')->with($data);
    }

    //  public function transaction(Request $request, $user = '')
    // {

    //     $user = User::find($user);

    //     $data['pageTitle'] = 'Transaction Log';
    //     $data['navReportActiveClass'] = 'active';
    //     $data['subNavTransactionActiveClass'] = 'active';


    //     $dates = array_map(function ($date) {
    //         return Carbon::parse($date);
    //     }, explode('-', $request->dates));

    //     $transactions = Transaction::query();

    //     if($user){
    //         $transactions->where('user_id', $user->id);
    //     }


    //     $data['transactions'] = $transactions->when($request->dates, function ($q) use ($dates) {
    //         $q->whereBetween('created_at', $dates);
    //     })->where('payment_status', 1)->latest()->paginate();

    //     $data['gateways'] = Crypto_methods::where('status', 'active')->get();

    //     $data['plans'] = InvestmentPlan::where('status', 'active')->get();

    //     return view('backend.transaction')->with($data);
    // }

}
