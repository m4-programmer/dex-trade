<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\InvestmentPlan;
use App\Models\GeneralSettings;
use Hash;
class SiteController extends Controller
{
    public function about()
    {
        return view('theme2.pages.about');
    }

    public function allInvestmentPlan()
    {
        $plans = InvestmentPlan::where('status','active')->get();
        return view('theme2.pages.investmentplan', compact('plans'));
    }

    public function faq()
    {
        return view('theme2.pages.faq');
    }

    public function terms()
    {
        return view('theme2.pages.terms');
    }

    public function contact()
    {
        return view('theme2.pages.contact');
    }
    public function sendMessage(Request $request)
    {
        
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required'
        ]);
        $data['type'] = "contact";
        sendAdminMail($data);

        $notify[] = ['success', 'Message sent successfully'];

        return back()->withNotify($notify);
    }

    /*The method below are for changing and updating the password of a user*/
      public function changePassword()
    {
        $pageTitle = 'Change Password';
        return view( 'theme2.user.auth.changepassword', compact('pageTitle'));
    }


    public function updatePassword(Request $request)
    {

        $request->validate([
            'oldpassword' => 'required|min:5',
            'password' => 'min:5|confirmed',

        ]);

        $user = User::find(auth()->user()->id);

        if (!Hash::check($request->oldpassword, $user->password)) {
            return redirect()->back()->with('error', 'Old password do not match');
        } else {
            $user->password = Hash::make($request->password);

            $user->save();

            return redirect()->back()->with('success', 'Password Updated');
        }
    }
    public function investmentCalculate(Request $request,$id)
    {
        $request->validate([
            'amount' => 'required|gte:0|numeric',
            'selectplan' => 'required'
        ],[
            'selectplan.required'=>'please select a plan'
        ]);

        $general = GeneralSettings::first();
        $plan = InvestmentPlan::find($id);

        $amount = $request->amount;

        //check max-min amount
        if ($plan->status == 'active') {
            if ($plan->maximum_amount) {
                if ($amount > $plan->maximum_amount) {
                    return response()->json([
                        'message' => 'Maximum invest limit',
                        'amount' => $plan->maximum_amount,
                    ]);
                }
            }

            if ($plan->minimum_amount) {
                if ($amount < $plan->minimum_amount) {
                    return response()->json([
                        'message' => 'Minimum invest limit',
                        'amount' => $plan->minimum_amount,
                    ]);
                }
            }
        }
            $calculate = $amount * $plan->roi / 100;
            return view('theme2.pages.profittable', compact('plan', 'calculate', 'amount','general'));
       
    }
}
