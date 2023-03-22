<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Myinvestment;
use App\Models\User;
use App\Models\GeneralSettings;
use App\Models\Deposit;
use Carbon\Carbon;
use Mail;

class ManageInvestmentController extends Controller
{
    public function index($user = '')
    {
        $user = User::find($user);

        $data['payment_type'] = "Invesment";
        $data['pageTitle'] = "Invesment Log";
        $data['navDepositPaymentActiveClass'] = 'active';

        $manuals = Myinvestment::query();

        if($user){
            $manuals->where('user_id', $user->id);
        }
        $data['manuals'] = $manuals->with('user')->latest()->paginate();
        return view('backend.deposit_log')->with($data);
    }
 

    public function investment_details(Request $request, $trx)
    {
        $pageTitle = "Invesment Details";
        $payment_type = "Invesment";

        $manual = Myinvestment::where('transaction_id', $trx)->firstOrFail();


        return view('backend.deposit_details', compact('pageTitle', 'manual', 'payment_type'));
    }
     public function depositAccept(Request $request, $trx)
    {
        

        $booking = Myinvestment::where('transaction_id', $trx)->firstOrFail();
        $general = GeneralSettings::first();
        
        // $gateway = Crypto_methods::where('gateway', $booking->gateway)->first();
        $deposit = Deposit::find($trx);
        
        
        $booking->status = 'active';

        $updated_at = getPaymentEndDate($booking->duration);

        $booking->updated_at = $updated_at;

        /*If investment was done through deposit, we update the deposit status of the user*/
        if ($deposit) {
            $deposit->status = "success";
            $deposit->save();
        }
        $booking->save();
        

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

        /*I send a mail to the user telling him or her that has investment has been approved*/
        $url = route('admin.investment.details', $trx);

         $data['url']  = $url;
         
         $name = $booking->user->name;
         $data['email'] = $booking->user->email;
         
         $amount = $booking->amount. ' ' .$general->site_currency;
         
         $data['message'] = "<p>Hello {$name}, your investment of {$amount} has been confirmed !!!!</p>";
         $data['title'] = 'Invesment Success';
         try{
             Mail::send('email.notification', ['data' => $data], function($message) use($data){
            $message->to($data['email'])->subject($data['title']);
         });
         }
         catch(Exception $e){

         }

        $notify[] = ['success', "Invesment Confirmed Successfully"];


        return redirect()->back()->withNotify($notify);
    }

    public function depositReject(Request $request,$trx)
    {

        $booking = Myinvestment::where('transaction_id', $trx)->firstOrFail();
        $general = GeneralSettings::first();
        // $gateway = Gateway::where('gateway_name', 'bank')->first();

        $booking->status = "rejected";
        $booking->save();

        // sendMail('PAYMENT_REJECTED', ['trx' => $booking->transaction_id, 'amount' => $booking->amount, 'charge' => number_format($gateway->charge, 4), 'plan' => 'deposit', 'currency' => $general->site_currency], $booking->user);

        $notify[] = ['success', "Payment Rejected Successfully"];

        return redirect()->back()->withNotify($notify);
    }

}
