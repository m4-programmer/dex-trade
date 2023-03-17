<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Hash;
class SiteController extends Controller
{
    public function about()
    {
        return view('theme2.pages.about');
    }

    public function allInvestmentPlan()
    {
        return view('theme2.pages.investmentplan');
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
}
