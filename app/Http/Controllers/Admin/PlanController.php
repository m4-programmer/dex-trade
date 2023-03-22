<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InvestmentPlan;
// use App\Models\Time;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageTitle = 'All Plans';

        $plans = InvestmentPlan::latest()->paginate();

        return view('backend.plan.index', compact('pageTitle', 'plans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        $pageTitle = 'Create Plan';
        return view('backend.plan.create', compact('pageTitle'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:investment_plans,name',
            'minimum' => 'required_if:amount_type,==,0',
            'maximum' => 'required_if:amount_type,==,0',
            'interest' => 'required',
            'Duration'=> 'required',

            ], 
        );

        InvestmentPlan::create([
            'name' => $request->name,
            'amount_type' => $request->amount_type,
            'minimum_amount' => $request->minimum,
            'maximum_amount' => $request->maximum,
            'roi' => $request->interest,

            'duration' => $request->Duration,            
            'capital_back' => $request->capital_back,
            'status' => $request->status,           


        ]);

        $notify[] = ['success', 'Plan created successfully'];

        return redirect()->route('admin.plan.index')->withNotify($notify);
    }

    public function edit(InvestmentPlan $plan)
    {
        $pageTitle = 'Edit Plan';     
        $time=InvestmentPlan::all();  
        return view('backend.plan.edit', compact('pageTitle', 'plan','time'));
    }

    public function update(Request $request, InvestmentPlan $plan)
    {       
        $request->validate([
            'name' => 'required|unique:investment_plans,name,'.$plan->id,
            'minimum' => 'required_if:amount_type,==,0',
            'maximum' => 'required_if:amount_type,==,0',
            'interest' => 'required',
            'Duration'=> 'required',

            ], 
        );

        $plan->update([
            'name' => $request->name,
            'amount_type' => $request->amount_type,
            'minimum_amount' => $request->minimum,
            'maximum_amount' => $request->maximum,
            'roi' => $request->interest,

            'duration' => $request->Duration,            
            'capital_back' => $request->capital_back,
            'status' => $request->status, 
        ]);

        $notify[] = ['success', 'Plan Updated Successfully'];

        return redirect()->route('admin.plan.index')->withNotify($notify);
    }
    public function delete($id)
    {
        InvestmentPlan::destroy($id);
        $notify[] = ['success', 'Plan Deleted successfully'];

        return redirect()->route('admin.plan.index')->withNotify($notify);
    }

    public function planStatusChange(Request $request)
    {
        $plan = InvestmentPlan::findOrFail($request->id);

        if (strtolower($request->status) == 'active' ) {
            $plan->status = 'pending';
            $plan->save();
            $notify = ['success' => 'Plan Status Deactivated  Successfully '];
        } else {
            $plan->status = 'active';
            $plan->save();
            $notify = ['success' => 'Plan Status Activated Successfully '];
        }

        

        

        return response($notify);
    }

   
}