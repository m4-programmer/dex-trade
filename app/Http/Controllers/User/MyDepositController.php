<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MyDeposit;
use App\Models\GeneralSettings;
use App\Models\Myinvestment;
class MyDepositController extends Controller
{
    public function showDepositLog()
    {
        $pageTitle = 'My Dposits';
        $gs = GeneralSettings::first();
        $transactions = Myinvestment::all();
        return view('theme2.user.deposit_log', compact('gs','pageTitle','transactions'));

        $pageTitle = "Transactions";

        // $transactions = Deposit::when($request->trx , function($item)use($request){ $item->where('transaction_id', $request->trx);})->
        // when($request->date, function($item) use($request) {$item->whereDate('created_at', $request->date);})->where('user_id', auth()->id())->latest()->with('user')->where('payment_status',1)->paginate();

        // return view($this->template.'user.deposit_log', compact('pageTitle', 'transactions'));
    }
}
