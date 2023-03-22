<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Deposit;
use App\Models\GeneralSettings;
use App\Models\Myinvestment;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserInterest;
use App\Models\Withdraw;
use Illuminate\Http\Request;
use Auth;
use Mail;

class ManageUserController extends Controller
{
    public function index()
    {

        $data['pageTitle'] = 'All Users';
        $data['navManageUserActiveClass'] = 'active';
        $data['subNavManageUserActiveClass'] = 'active';

        $data['users'] = User::where('role_as', 'user')->latest()->paginate();

        return view('backend.users.index')->with($data);
    }

    public function userDetails(Request $request)
    {
        $user = User::where('id', $request->user)->firstOrFail();
        
        $totalRef = $user->network->count();

        $userInterest =0.00;

        $userCommission = $user->network->sum('amount_earned');

        $withdrawTotal = Withdraw::where('user_id', $user->id)->where('status', 1)->sum('amount');

        $totalDeposit = $user->deposits()->where('status', 'success')->sum('amount');

        $totalInvest = $user->payments()->where('status', 'active')->orwhere('status', 'ended')->sum('amount');

        $totalTicket = $user->tickets->count();



        $payment = Myinvestment::where('user_id', $user->id)->where('status','active')->where('status','ended')->latest()->first();

        if ($payment) {
            $plan = $payment->name;
        } else {
            $plan = 'N/A';
        }


        $pageTitle = "User Details";

        return view('backend.users.details', compact('pageTitle', 'user', 'plan', 'totalRef', 'userInterest', 'userCommission', 'withdrawTotal', 'totalDeposit', 'totalInvest', 'totalTicket'));
    }

    public function userUpdate(Request $request, User $user)
    {



        $request->validate([
            'fname' => 'required',
            
            'phone' => 'unique:users,phone,' . $user->id
        ]);

        $data = [
            'country' => $request->country,
            'city' => $request->city,
            'zip' => $request->zip,
            'state' => $request->state,
        ];


        $user->name = $request->fname;
        $user->country = $request->country;
        $user->phone = $request->phone;
        $user->city = $request->city;
        $user->zip = $request->zip;
        $user->state = $request->state;


        
        $user->save();


        $notify[] = ['success', 'User Updated Successfully'];

        return back()->withNotify($notify);
    }

    public function sendUserMail(Request $request, User $user)
    {
        $data = $request->validate([
            'subject' => 'required',
            "message" => 'required',
        ]);

        $data['name'] = $user->fullname;
        $data['email'] = $user->email;
        // To work on this functionality later
        sendGeneralMail($data);

        $notify[] = ['success', 'Send Email To user Successfully'];

        return back()->withNotify($notify);
    }

    public function disabled(Request $request)
    {
        $pageTitle = 'Disabled Users';

        $search = $request->search;

        $users = User::when($search, function ($q) use ($search) {
            $q->where('name', 'LIKE', '%' . $search . '%')
                ->orWhere('company_name', 'LIKE', '%' . $search . '%')
                ->orWhere('email', 'LIKE', '%' . $search . '%')
                ->orWhere('mobile', 'LIKE', '%' . $search . '%');
        })->where('status', 0)->latest()->paginate();

        return view('backend.users.index', compact('pageTitle', 'users'));
    }

    public function userStatusWiseFilter(Request $request)
    {
        $data['pageTitle'] = ucwords($request->status) . ' Users';
        $data['navManageUserActiveClass'] = 'active';
        if ($request->status == 'active') {
            $data['subNavActiveUserActiveClass'] = 'active';
        } else {
            $data['subNavDeactiveUserActiveClass'] = 'active';
        }

        $users = User::query();

        if ($request->status == 'active') {
            $users->where('role_as', 'user');
        } elseif ($request->status == 'deactive') {
            $users->where('role_as', 'user');
        }


        $data['users'] = $users->paginate();


        return view('backend.users.index')->with($data);
    }

    public function interestLog($user = '')
    {

        $interestLogs = UserInterest::query();

        $user = User::find($user);

        $pageTitle = "User Interest Log";

        if ($user) {

            $interestLogs->where('user_id', $user->id);
        }

        $interestLogs = $interestLogs->latest()->paginate();


        return view('backend.userinterestlog', compact('interestLogs', 'pageTitle'));
    }

    public function userBalanceUpdate(Request $request)
    {
        $user = User::findOrFail($request->user_id);
        $general = GeneralSettings::first();

        if ($request->type == 'add') {
            $user->balance =  $user->balance + $request->balance;
        } else {
            if ($user->balance < $request->balance) {
                $notify[] = ['error', 'Insufficient balance'];

                return back()->withNotify($notify);
            }
            $user->balance =  $user->balance - $request->balance;
        }

        $user->save();
        $url = $url = route('home');

         $data['url']  = $url;
         
         $name = $user->name;
         $data['email'] = $user->email;
         
         $amount = $request->balance. ' ' .$general->site_currency;
         
         $data['message'] = "<p>Good day {$name}, Your account has been credited with the sum of {$amount}. <br> Please click <a href={$url}>here</a> to login and use funds.!!!!</p> <p>Keep on investing with us</p>";
         $data['title'] = 'Account Top Up';
         try{
             Mail::send('email.notification', ['data' => $data], function($message) use($data){
            $message->to($data['email'])->subject($data['title']);
         });
         }
         catch(Exception $e){

         }

        $notify[] = ['success', 'Successfully ' . $request->type . ' balance'];

        return back()->withNotify($notify);
    }

    public function loginAsUser($id)
    {
        $user = User::findOrFail($id);

        Auth::loginUsingId($user->id);

        return redirect()->route('user.dashboard');
    }


    public function kyc()
    {
        $data['subNavkycUserActiveClass'] = 'active';

        $data['pageTitle'] = 'KYC Settings';

        return view('backend.users.kyc')->with($data);
    }


    public function kycUpdate(Request $request)
    {
        $request->validate([
            "kyc" => 'required|array',
        ]);

        $general = GeneralSetting::first();


        $general->kyc = $request->kyc;

        $general->save();


        return back()->with('success', 'Kyc settings updated successfully');
    }

    public function kycAll()
    {
        $data['infos'] = User::where('kyc', 2)->paginate();

        $data['pageTitle'] = 'KYC Requests';
        $data['subNavkycReqUserActiveClass'] = 'active';
        $data['navManageUserActiveClass'] = 'active';

        return view('backend.users.kyc_req')->with($data);
    }

    public function kycDetails($id)
    {
        $data['user'] = User::findOrFail($id);

        $data['pageTitle']  = 'KYC Details';


        $data['subNavkycReqUserActiveClass'] = 'active';
        $data['navManageUserActiveClass'] = 'active';

        return view('backend.users.kyc_details')->with($data);
    }

    public function kycStatus($status, $id)
    {
        $user = User::findOrFail($id);

        if ($status === 'approve') {
            $user->kyc = 1;
        } else {
            $user->kyc = 3;
        }

        $user->save();

        return back()->with('success', 'Successfull');
    }
}
