<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Network;
class ReferralController extends Controller
{
     public function index()
    {
        $transactions = Network::where('user_id', auth()->user()->id)->get();

        $pageTitle = "Referral Log";

        return view("theme2.user.referral", compact('transactions', 'pageTitle'));
    }
}
