<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReferralController extends Controller
{
     public function index()
    {
        $gateways = Crypto_methods::where('status', 1)->get();

        $pageTitle = "Transaction History";

        $type = 'Transaction History';

        return view("theme2.user.gateway.gateways", compact('gateways', 'pageTitle', 'type'));
    }
}
