<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
