<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Crypto_methods;
class DynamicGatewayController extends Controller
{
     public function index()
    {
        $pageTitle = 'Gateways';

        $gateways = Crypto_methods::paginate();

        return view('backend.gateways.index',compact('pageTitle','gateways'));
    }

    public function create()
    {
        $pageTitle = 'Create Gateway';

        return view('backend.gateways.create',compact('pageTitle'));
    }

   
    public function store(Request $request)
    {
        $request->validate([
            "name" => "required|unique:crypto_methods,cryptocurrency",

            // "instruction" => "required",
            // "gateway_currency" => "required",
            // "rate" => "required|numeric",
            // "charge" => "required|numeric",
            // "status" => "required",
            // 'qr_code' => 'required|mimes:jpg,jpeg,png',
            // 'image' => 'required|mimes:jpg,jpeg,png'
        ]);


        $gatewayParameters = [
            'gateway_currency' => strtolower($request->gateway_currency),
            'instruction' => $request->instruction,
            'qr_code' => $request->hasFile('qr_code') ? uploadImage($request->qr_code, gatewayImagePath()) : '',
        ];
        $qr_code = $request->hasFile('qr_code') ? uploadImage($request->qr_code, gatewayImagePath()) : '';

        $filename = "";
        if ($request->hasFile('image')) {
            $filename = uploadImage($request->image, gatewayImagePath());
        }

        Crypto_methods::create([
            'cryptocurrency' => $request->name,
            'wallet_address'=> $request->wallet_address,
            'qr_code'=> $qr_code,
            'blockchain_network'=> $request->network,
            'image'=> $filename,
            'short_name'=> $request->short_name,
            'status'=> $request->status,
        ]);


        $notify[] = ['success', "Gateway Created Successfully"];

        return redirect()->back()->withNotify($notify);
    }

    
    public function edit($id)
    {
       $pageTitle = 'Edit Gateway';

       $gateway = Crypto_methods::findOrFail($id);


      return view('backend.gateways.edit',compact('pageTitle','gateway'));
    }
     public function deleteGateway($id)
    {
       $pageTitle = 'Edit Gateway';

       $gateway = Crypto_methods::findOrFail($id);
       $gateway->delete();
       $notify[] = ['success', "Gateway Deleted Successfully"];
      return back()->withNotify($notify);
    }

   
    public function update(Request $request, $id)
    {
        $gateway = Crypto_methods::findOrFail($id);

        $request->validate([
            "name" => "required|unique:crypto_methods,cryptocurrency,".$gateway->id,
            "wallet_address" => "required",
            'qr_code' => 'mimes:jpg,jpeg,png',
            'image' => 'mimes:jpg,jpeg,png'
        ]);
        
         
        $gateway->update([
            'cryptocurrency' => str_replace(' ','_',$request->name),
            'wallet_address'=> $request->wallet_address,
            'qr_code' => $request->hasFile('qr_code') ? uploadImage($request->qr_code, gatewayImagePath(),'',$gateway->qr_code) : $gateway->qr_code,
            'blockchain_network'=> $request->network,
            'image' => $request->hasFile('image') ? uploadImage($request->image, gatewayImagePath(),'',$gateway->image) : $gateway->image,
            'short_name'=> $request->short_name,
            'status' => $request->status,
            

        ]);


        $notify[] = ['success', "Gateway Updated Successfully"];

        return redirect()->back()->withNotify($notify);
    }
}
