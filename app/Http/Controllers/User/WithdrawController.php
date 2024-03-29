<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GeneralSettings;
use App\Models\Crypto_methods;
use App\Models\Withdraw;
use App\Models\Myinvestment;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Mail;

class WithdrawController extends Controller
{
    public string $adminEmail;
    public function __construct(){
        $this->adminEmail = config("helper.admin_email");
    }
    public function index()
    {
        $withdraws = Crypto_methods::get();

        $pageTitle = "Withdraw Funds";

        $type = 'Withdrawal';
        $general = GeneralSettings::first();

        return view("theme2.user.withdraw.index", compact('withdraws', 'pageTitle', 'type','general'));
    }
    public function withdraw(Request $request)
    {

        $general = GeneralSettings::first();
        $request->validate([
            'amount' => 'required|integer',
            'wallet_address' => 'required',
        ]);

        $payment = Myinvestment::where('user_id', auth()->id())->where('status', 'active')->orWhere('status', 'ended')->count();

        if ($payment <= 0) {
            $notify[] = ['error', 'You have to invest on a plan to withdraw'];

            return back()->withNotify($notify);
        }

        /*We check if user withdraw amount is above the minimum withdrawable amount*/
        if ($request->amount < $general->minimum_withdrawable) {
            $notify[] = ['error', 'minimum withdrawable is '.$general->minimum_withdrawable];
            return back()->withNotify($notify);
        }
        if ($request->amount > $general->maximum_withdrawable) {
            $notify[] = ['error', 'maximum withdrawable is '.$general->maximum_withdrawable];
            return back()->withNotify($notify);
        }

        // check if user balance is enough for transaction to go through
        if (auth()->user()->balance < $request->amount) {
            $notify[] = ['error', 'Insuficient Balance '];
            return back()->withNotify($notify);
        }

        // if all the checks above is passed, we deduct the amount to be withdraw from user account
        auth()->user()->balance = auth()->user()->balance - $request->amount;
        auth()->user()->save();

        /*We create an instance of a withdraw*/
        $withdraw = withdraw::create([
            'user_id' => auth()->user()->id,
            'amount' => $request->amount,
            'withdraw_method' => $request->withdraw_method,
            'wallet_address' => $request->wallet_address,
            'account_info' => $request->account_info,
            'additional_info' => $request->note,
            'network' => '',
            'transaction_id' => $this->generateTransactionId(6),


        ]);

        /*We send mail to the admin*/
         $url = $url = route('admin.withdraw.pending');

         $data['url']  = $url;

         $name = auth()->user()->name;
         $data['email'] = $this->adminEmail;

         $amount = $request->amount. ' ' .$general->site_currency;

         $data['message'] = "<p>Hello Admin, {$name} has made a request to withdraw the sum of {$amount} <br> Please Verify the request and respond to it by clicking <a href={$url}>here</a>.!!!!</p>";
         $data['title'] = 'Withdrawal Request';
         try{
             Mail::send('email.notification', ['data' => $data], function($message) use($data){
            $message->to($data['email'])->subject($data['title']);
         });
         }
         catch(Exception $e){

         }

        $notify[] = ['success', 'Withdraw Successfully done'];

        return redirect()->route('withdraw_log')->withNotify($notify);
    }

     public function all()
    {
        $pageTitle = 'All withdraw';

        $withdrawlogs = Withdraw::where('user_id', auth()->user()->id)->orderBy('created_at','desc')->get();
        // dd($withdrawlogs);
        $general = GeneralSettings::first();

        return view("theme2.user.withdraw.withdraw_log", compact('withdrawlogs', 'pageTitle','general'));
    }
    public function complete()
    {
        $withdrawlogs = json_decode(json_encode(
            [
                ['id' => 1, 'name' => 'Withdrawal_Log'],
            ]
        ));

        $pageTitle = "Withdrawal Log";

        $type = 'Withdrawal_Log';

        return view("theme2.user.withdraw.withdraw_log", compact('withdrawlogs', 'pageTitle', 'type'));
    }
    public function pending()
    {
        $withdrawlogs = json_decode(json_encode(
            [
                ['id' => 1, 'name' => 'Withdrawal_Log'],
            ]
        ));

        $pageTitle = "Withdrawal Log";

        $type = 'Withdrawal_Log';

        return view("theme2.user.withdraw.withdraw_log", compact('withdrawlogs', 'pageTitle', 'type'));
    }

    /*This method act as an end point for an ajax request to fetch information from*/
    public function fetch(Request $request , $id)
    {

        $data = GeneralSettings::first();
        $response['min_amount'] = $data->minimum_withdrawable;
        $response['max_amount'] = $data->maximum_withdrawable;
        $response['withdraw_instruction'] = "Put in your Wallet Details";
        return $response;
    }

     public static function generateTransactionId(int $length = 10)
    {
        $trans_id = Str::random($length); //Generates random id
        $exist = Withdraw::where('transaction_id', '=', $trans_id)->get(['transaction_id']);
        if (isset($exist[0]->transaction_id)) {
            return self::generateTransactionId();
        }
        return $trans_id;

    }
}
