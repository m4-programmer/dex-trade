<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Network;
use App\Models\RefferedCommission;
use App\Models\User;

class ReferralController extends Controller
{
    public function index()
    {
        $pageTitle = 'Manage Referral';

        $Network = Network::with('user')->latest()->paginate();
        // dd($Network);
        $interest_referral = Network::latest()->first();


        return view('backend.referral.index', compact('pageTitle','interest_referral','Network'));
    }



    public function investStore(Request $request)
    {
        Network::updateOrCreate([
            'id'=>2
        ],[
            'type' => $request->type,
            'level' => $request->level,
            'commision' => $request->commision,
        ]);

        $notify[] = ['success', 'Invest Commision Created Successfully'];

        return redirect()->route('admin.referral.index')->withNotify($notify);
    }

    public function interestStore(Request $request)
    {
        Network::updateOrCreate([
            'id'=>3
        ],[
            'type' => $request->type,
            'level' => $request->level,
            'commision' => $request->commision,
        ]);

        $notify[] = ['success', 'Interest Commision Created Successfully'];

        return redirect()->route('admin.referral.index')->withNotify($notify);
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function refferalStatusChange(Request $request)
    {
        $refferal = Refferal::findOrFail($request->id);

        if ($request->status) {
            $refferal->status = false;
        } else {
            $refferal->status = true;
        }

        $refferal->save();

        $notify = ['success' => 'Plan Status Change Successfully'];

        return response($notify);
    }

    public function Commision($user = '')
    {
        $user = User::find($user);

        $commison = RefferedCommission::query();

        if($user){
            $commison->where('reffered_by', $user->id);
        }
        
        $commison = $commison->latest()->paginate();

        $pageTitle = 'Commission Log';

        return view('backend.report.commission',compact('commison','pageTitle'));
    }
}
