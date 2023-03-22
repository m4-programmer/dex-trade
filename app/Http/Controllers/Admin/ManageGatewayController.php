<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Deposit;
use App\Models\Myinvestment;
use App\Models\Gateway;
use App\Models\GeneralSettings;
use App\Models\Crypto_methods;
use App\Models\Payment;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Mail;

class ManageGatewayController extends Controller
{
    
    private function setEnv($object)
    {

       
        foreach ($object as $key => $value){
            file_put_contents(app()->environmentFilePath(), str_replace(
                $key . '=' . env($key),
                $key . '=' . $value,
                file_get_contents(app()->environmentFilePath())
            ));
        }

    }

 

    public function depositLog($user = '')
    {
        $user = User::find($user);


        $data['pageTitle'] = "Deposit Log";
        $data['navDepositPaymentActiveClass'] = 'active';

        $manuals = Deposit::query();

        if($user){
            $manuals->where('user_id', $user->id);
        }
        $data['manuals'] = $manuals->where('payment_type', 'deposits')->with('user')->latest()->paginate();
        return view('backend.deposit_log')->with($data);
    }

    public function depositDetails(Request $request,$trx)
    {
        $pageTitle = "Payment Details";
        
        $manual = Deposit::where('transaction_id', $trx)->firstOrFail();


        return view('backend.deposit_details', compact('pageTitle', 'manual'));
    }

    public function depositAccept(Request $request, $trx)
    {
        
        $booking = Deposit::where('transaction_id', $trx)->firstOrFail();
        $general = GeneralSettings::first();
        // $gateway = Crypto_methods::where('gateway', $booking->gateway)->first();

        $booking->status = 'success';


        $booking->user->balance = $booking->user->balance + $booking->amount;
        $booking->save();
        $booking->user->save();

        $url = $url = route('admin.deposit.log', $booking->user_id);

         $data['url']  = $url;
         
         $name = $booking->user->name;
         $data['email'] = $booking->user->email;
         
         $amount = $booking->amount. $general->site_currency;
         
         $data['message'] = "<p>Hello {{$name}}, your Deposit of {{$amount}} has been confirmed !!!!</p>";
         $data['title'] = 'Deposit Success';
         try{
             Mail::send('email.notification', ['data' => $data], function($message) use($data){
            $message->to($data['email'])->subject($data['title']);
         });
         }
         catch(Exception $e){

         }
        /*To create transaction table later*/
      /*  Transaction::create([
            'transaction_id' => $booking->transaction_id,
            'gateway' => $booking->gateway,
            'amount' => $booking->amount,
            'currency' => $general->site_currency,
            'details' => 'Payment Successfull',
            'type' => 'Deposit',
            'user_id' => $booking->user_id,
            'payment_status' => "success",
        ]);*/


        // sendMail('PAYMENT_CONFIRMED', ['trx' => $booking->transaction_id, 'amount' => $booking->amount, 'charge' => number_format($gateway->charge, 4), 'plan' => 'deposit', 'currency' => $general->site_currency], $booking->user);

        $notify[] = ['success', "Payment Confirmed Successfully"];

        return redirect()->back()->withNotify($notify);
    }

    public function depositReject(Request $request,$trx)
    {

        $booking = Deposit::where('transaction_id', $trx)->firstOrFail();
        $general = GeneralSettings::first();
        // $gateway = Gateway::where('gateway_name', 'bank')->first();

        $booking->status = "rejected";
        $booking->save();

        $url = $url = route('admin.deposit.log', $booking->user_id);

         $data['url']  = $url;
         
         $name = $booking->user->name;
         $data['email'] = $booking->user->email;
         
         $amount = $booking->amount. ' ' .$general->site_currency;
         
         $data['message'] = "<p>Hello {$name}, your Deposit of {$amount} has been Rejected !!!!</p>";
         $data['title'] = 'Deposit Rejected';
         try{
             Mail::send('email.notification', ['data' => $data], function($message) use($data){
            $message->to($data['email'])->subject($data['title']);
         });
         }
         catch(Exception $e){

         }
        // sendMail('PAYMENT_REJECTED', ['trx' => $booking->transaction_id, 'amount' => $booking->amount, 'charge' => number_format($gateway->charge, 4), 'plan' => 'deposit', 'currency' => $general->site_currency], $booking->user);

        $notify[] = ['success', "Payment Rejected Successfully"];

        return redirect()->back()->withNotify($notify);
    }
}
