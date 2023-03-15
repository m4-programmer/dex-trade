<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\GeneralSettings;
use App\Models\Myinvestment;
use Illuminate\Http\Request;

class MyInvestmentController extends Controller
{
    public function showInvestLog(){

        $pageTitle = 'My InvestmentPlan';
        $gs = GeneralSettings::first();

        $transactions = Myinvestment::all();
        // dd($transactions);
        return view('theme2.user.invest_log', compact('pageTitle','gs', 'transactions'));
    }
}
