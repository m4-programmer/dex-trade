<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\GeneralSettings;
use App\Models\Myinvestment;
use App\Models\Deposit;
use App\Models\InvestmentPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use App\Models\Crypto_methods;

class MyInvestmentController extends Controller
{
    public function showInvestLog(){

        $pageTitle = 'My InvestmentPlan';
        $gs = GeneralSettings::first();

        
        $transactions = Myinvestment::where('user_id', auth()->user()->id)->latest()->get();
        // dd($transactions);
        return view('theme2.user.invest_log', compact('pageTitle','gs', 'transactions'));
    }
    public function investmentUsingBalannce(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric'
        ]);

        $general = GeneralSettings::first();

        $plan_id = InvestmentPlan::findOrFail($request->plan_id);




        if ($plan_id->maximum_amount) {
            if ($request->amount > $plan_id->maximum_amount) {
                return redirect()->back()->with('error', 'Maximum Invest Limit ' . number_format($plan_id->maximum_amount, 2));
            }
        }

        if ($plan_id->minimum_amount) {
            if ($request->amount < $plan_id->minimum_amount) {
                return redirect()->back()->with('error', 'Minimum Invest Limit ' . number_format($plan_id->minimum_amount, 2));
            }
        }

        // $next_payment_date = Carbon::now()->addHours($plan_id->time->time);

        $trx = $this->generateTransactionId(6);


        $user= auth()->user();


        if($user->balance < $request->amount){
            return redirect()->back()->with('error', 'You dont have sufficient balance to invest');
        }




         $user->balance = $user->balance - $request->amount;
         $user->save();
         $deposit = Myinvestment::create([
             'transaction_id' => $trx,
             'plan_id' => $plan_id->id,
             'plan_name' => $plan_id->name,
             'amount' => $request->amount,
             'duration' => $plan_id->duration,
             'status' => 'active',
             'gateway' => 'Account Balance',
             'user_id' => auth()->id(),
             'roi' => $plan_id->roi,
         ]);
         $myinvestment = Myinvestment::findOrFail($deposit->id);
         // dd($myinvestment);
        

        // if user payment is active on payment, then add the end date for the investment to the updated_at column
        if ($myinvestment->status == 'active') {
            $duration = explode(' ', $plan_id->duration);
            // check if duration is in year
            if (strtolower($duration[1]) == 'years' or strtolower($duration[1]) == 'year' ) {
                $myinvestment->updated_at = Carbon::now()->addYears($duration[0]);
            }
            // check if duration is in Months
            if (strtolower($duration[1]) == 'months' or strtolower($duration[1]) == 'month' ) {
                $myinvestment->updated_at = Carbon::now()->addMonths($duration[0]);
                
                
            }
            // check if duration is in weeks
            if (strtolower($duration[1]) == 'weeks' or strtolower($duration[1]) == 'week' ) {
                $myinvestment->updated_at = Carbon::now()->addWeeks($duration[0]);

            }
            // check if duration is in days
            if (strtolower($duration[1]) == 'days' or strtolower($duration[1]) == 'day' ) {
                $myinvestment->updated_at = Carbon::now()->addDays($duration[0]);
            }
            // check if duration is in hours
            if (strtolower($duration[1]) == 'hours' or strtolower($duration[1]) == 'hour' ) {
                $myinvestment->updated_at = Carbon::now()->addHours($duration[0]);
            }
            $myinvestment->save();
            
        }
         auth()->user()->current_plan = $plan_id->name;
        auth()->user()->save();

        // Create an entry in the transaction table
        //  Transaction::create([
        //     'trx' => $deposit->transaction_id,
        //     'gateway_id' => $deposit->gateway_id,
        //     'amount' => $deposit->final_amount,
        //     'currency' => @$general->site_currency,
        //     'details' => 'Payment Successfull',
        //     'charge' => 0,
        //     'type' => '-',
        //     'gateway_transaction' => '',
        //     'user_id' => auth()->id(),
        //     'payment_status' => 1,
        // ]);

        // To send mail below here

        return redirect()->route('myinvestment')->with('success', 'Successfully Invest');

    }
    /*This will control the routes for the payment of the investment*/
    public function paynow(Request $request, $id)
    {

        
        $request->validate([
            'amount' => 'required|gte:0',
        ]);

        $general = GeneralSettings::first();

        $gateway = Crypto_methods::where('status', 1)->findOrFail($request->id);
        $pageTitle = $gateway->cryptocurrency. " Payment Methods";
        $plan_id = InvestmentPlan::findOrFail($request->plan_id);
        $amount = $request->amount;
        $type = 'Investment';
        if ($plan_id->maximum_amount) {
            if ($request->amount > $plan_id->maximum_amount) {
                return redirect()->back()->with('error', 'Maximum Invest Limit ' . number_format($plan_id->maximum_amount, 2));
            }
        }

        if ($plan_id->minimum_amount) {
            if ($request->amount < $plan_id->minimum_amount) {
                return redirect()->back()->with('error', 'Minimum Invest Limit ' . number_format($plan_id->minimum_amount, 2));
            }
        }
        
            // session()->put('trx', $trx);
            // session()->put('type', 'deposit');
           return view("theme2.user.gateway.gateway_manual", compact('gateway', 'pageTitle', 'general', 'amount','type','plan_id'));
        }
    
   
   

    public static function generateTransactionId(int $length = 10)
    {
        $trans_id = Str::random($length); //Generates random id
        $exist = Myinvestment::where('transaction_id', '=', $trans_id)->get(['transaction_id']);
        if (isset($exist[0]->transaction_id)) {
            return self::generateTransactionId();
        }
        return $trans_id;

    }
}
