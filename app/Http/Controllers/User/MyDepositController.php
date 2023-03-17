<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Deposit;
use App\Models\GeneralSettings;
use App\Models\Myinvestment;
class MyDepositController extends Controller
{
    public function showDepositLog()
    {
        $pageTitle = 'My Deposits';
        $gs = GeneralSettings::first();
        if (isset($_GET['trx']) or isset($_GET['date']) ) {

            if (!empty($_GET['trx']) and !empty($_GET['date'])) {
                $transactions = Deposit::where('user_id', auth()->user()->id)->
                where('transaction_id',$_GET['trx'])->
                where('created_at',$_GET['date'])->
                get();    
                
            }
            elseif ($_GET['trx']) {
                 $transactions = Deposit::where('user_id', auth()->user()->id)->
                where('transaction_id',$_GET['trx'])->
                get(); 
                
             }
             elseif(isset($_GET['date'])){
                 $transactions = Deposit::where('user_id', auth()->user()->id)->
                
                where('created_at',$_GET['date'])->
                get();  
                
             }
        }
        else{
            $transactions = Deposit::where('user_id', auth()->user()->id)->where('payment_type','deposits')->get();
            
        }
        
        return view('theme2.user.deposit_log', compact('gs','pageTitle','transactions'));

        $pageTitle = "Transactions";

        
    }
}
