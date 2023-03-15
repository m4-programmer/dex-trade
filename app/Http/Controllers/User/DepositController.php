<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Deposit;
use App\Models\Crypto_methods;
use App\Models\GeneralSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
        $pageTitle = "Payment Methods";
        $general = GeneralSettings::first();

        $gateway = Crypto_methods::where('status', 1)->findOrFail($request->id);
        $trx = $this->generateTransactionId(6);
        $amount = $request->amount;
        if (isset($request->type) && $request->type == 'deposit') {

            // $deposit = Deposit::create([
            //     'gateway' => $gateway->id,

            //     'user_id' => auth()->id(),
            //     'transaction_id' => $trx,
            //     'amount' => $request->amount,

            //     'payment_status' => 0,
            //     'payment_type' => 1,
            // ]);

            // session()->put('trx', $trx);
            // session()->put('type', 'deposit');

            return view("theme2.user.gateway.gateway_manual", compact('gateways', 'pageTitle', 'general', 'amount'));

            // return redirect()->route('user.gateway.details', $gateway->id);
        }
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
