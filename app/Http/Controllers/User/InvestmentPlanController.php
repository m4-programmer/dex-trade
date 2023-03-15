<?php

namespace App\Http\Controllers\User;


use App\Http\Controllers\Controller;
use App\Models\InvestmentPlan;
use App\Models\GeneralSettings;
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
        //
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
