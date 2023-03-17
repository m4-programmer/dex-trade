<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Deposit;
use App\Models\Crypto_methods;
use App\Models\GeneralSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use App\Models\Myinvestment;
use App\Models\InvestmentPlan;

class DepositController extends Controller
{

    public function index()
    {
        $gateways = Crypto_methods::where('status', 1)->get();

        $pageTitle = "Payment Methods";

        $type = 'deposit';

        return view("theme2.user.gateway.gateways", compact('gateways', 'pageTitle', 'type'));
    }
    public function paynow(Request $request, $id)
    {

        $request->validate([
            'amount' => 'required|gte:0',
        ]);

        $general = GeneralSettings::first();

        $gateway = Crypto_methods::where('status', 1)->findOrFail($request->id);
        $pageTitle = $gateway->cryptocurrency. " Payment Methods";

        $amount = $request->amount;
        if (isset($request->type) && $request->type == 'deposit') {
            // session()->put('trx', $trx);
            // session()->put('type', 'deposit');
           return view("theme2.user.gateway.gateway_manual", compact('gateway', 'pageTitle', 'general', 'amount'));
        }
    }
    public function completePayment(Request $request){
        

        $request->validate([
            'proof' => 'required|image|',
        ]);
        $trx = $this->generateTransactionId(6);
        // Here we handle the payment proof image

        if ($request->hasfile('proof')) { // check if picture is uploaded and uploads it
            // $destination = 'asset/theme2/images/gateways'.$profile->proof;
            // when user uploads a new image this will delete the old image
            // if (FILE::exists($destination)) {
            //     FILE::delete($destination);
            // // dd($profile->proof);
            // }
            $file = $request->file('proof');

            $filename = 'asset/theme2/images/gateways/'.time().'.'.$file->getClientOriginalExtension();
            $file->move('asset/theme2/images/gateways/', $filename);
            // $profile->proof = $filename;
            $proof = $filename;

        }

        // Here we create a new Deposit Instance
         if (isset($request->type) and strtolower($request->type) == 'investment') { 
            $deposit = Deposit::create([
                'transaction_id' => $trx,
                'user_id' => auth()->id(),
                'gateway' => $request->payment_method,
                'proof' => $proof,
                'amount' => $request->amount,
                'status' => 'pending',
                'payment_type' => 'investment',
            ]);
            // We insert data into the myinvesmtment table for those that deposited to pay for a package
            $plan_id = InvestmentPlan::findOrFail($request->plan_id);

            Myinvestment::create([
             'transaction_id' => $trx,
             'plan_id' => $plan_id->id,
             'plan_name' => $plan_id->name,
             'amount' => $request->amount,
             'duration' => $plan_id->duration,
             'gateway' => $request->payment_method,
             'user_id' => auth()->id(),
             'roi' => $plan_id->roi,
         ]);
            auth()->user()->current_plan = $plan_id->name;
            auth()->user()->save();

        }else{
            $deposit = Deposit::create([
                    'transaction_id' => $trx,
                    'user_id' => auth()->id(),
                    'gateway' => $request->payment_method,
                    'proof' => $proof,
                    'amount' => $request->amount,
                    'status' => 'pending',

                ]);
        }
        // To create a transaction record


        // To send Mail here


        $notify[] = ['success', 'Your Payment is Successfully Recieved, Please give us sometime to confirm your payment'];
       if (strtolower($request->type) == 'investment') {
            return redirect()->route('myinvestment')->withNotify($notify);
        }
        return redirect()->route('deposit_log')->withNotify($notify);







    }
    public static function generateTransactionId(int $length = 10)
    {
        $trans_id = Str::random($length); //Generates random id
        $exist = Deposit::where('transaction_id', '=', $trans_id)->get(['transaction_id']);
        if (isset($exist[0]->transaction_id)) {
            return self::generateTransactionId();
        }
        return $trans_id;

    }


}
