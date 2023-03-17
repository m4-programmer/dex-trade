<?php

namespace App\Http\Controllers\User;


use App\Http\Controllers\Controller;
use App\Models\InvestmentPlan;
use App\Models\GeneralSettings;
use App\Models\Crypto_methods;
use App\Http\Requests\StoreInvestmentPlanRequest;
use App\Http\Requests\UpdateInvestmentPlanRequest;

class InvestmentPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $plans = InvestmentPlan::where('status','active')->get();
        $gs = GeneralSettings::get()->first();
        $pageTitle = 'Our Packages';
        return view('theme2.pages.invest', compact('plans','gs','pageTitle'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $general = GeneralSettings::get()->first();
        $type = 'Invesment';
        $gateways = Crypto_methods::where('status', 1)->get();
        $plan_id = @$_GET['id'];
        $findPlan = InvestmentPlan::findorfail($plan_id);
        $min = $findPlan->minimum_amount;
        $max = $findPlan->maximum_amount;
        $pageTitle = "Payment Methods";
        $message = "Min Amount: $ {$min} & Max Amount: $ {$max} ";

        

        return view("theme2.user.gateway.gateways", compact('gateways', 'pageTitle', 'type', 'general','plan_id','message'));
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInvestmentPlanRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(InvestmentPlan $investmentPlan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InvestmentPlan $investmentPlan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInvestmentPlanRequest $request, InvestmentPlan $investmentPlan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InvestmentPlan $investmentPlan)
    {
        //
    }
}
