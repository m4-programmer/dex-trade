<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GeneralSettings;
use App\Models\Crypto_methods;

class WithdrawController extends Controller
{
    public function index()
    {
        $withdraws = json_decode(json_encode(
            [
                ['id' => 1, 'name' => 'Withdrawal_Log'],
            ]
        ));
        $withdraws = Crypto_methods::get();

        $pageTitle = "Withdraw Funds";

        $type = 'Withdrawal';
        $general = GeneralSettings::first();

        return view("theme2.user.withdraw.index", compact('withdraws', 'pageTitle', 'type','general'));
    }
    public function log()
    {
        $withdrawlogs = json_decode(json_encode(
            [
                ['id' => 1, 'name' => 'Withdrawal_Log'],
            ]
        ));

        $pageTitle = "Withdrawal Log";

        $type = 'Withdrawal_Log';

        return view("theme2.user.withdraw.withdraw_log", compact('withdrawlogs', 'pageTitle', 'type'));
    }
     public function all()
    {
        $withdrawlogs = json_decode(json_encode(
            [
                ['id' => 1, 'name' => 'Withdrawal_Log'],
            ]
        ));

        $pageTitle = "Withdrawal Log";

        $type = 'Withdrawal_Log';

        return view("theme2.user.withdraw.withdraw_log", compact('withdrawlogs', 'pageTitle', 'type'));
    }
    public function complete()
    {
        $withdrawlogs = json_decode(json_encode(
            [
                ['id' => 1, 'name' => 'Withdrawal_Log'],
            ]
        ));

        $pageTitle = "Withdrawal Log";

        $type = 'Withdrawal_Log';

        return view("theme2.user.withdraw.withdraw_log", compact('withdrawlogs', 'pageTitle', 'type'));
    }
    public function pending()
    {
        $withdrawlogs = json_decode(json_encode(
            [
                ['id' => 1, 'name' => 'Withdrawal_Log'],
            ]
        ));

        $pageTitle = "Withdrawal Log";

        $type = 'Withdrawal_Log';

        return view("theme2.user.withdraw.withdraw_log", compact('withdrawlogs', 'pageTitle', 'type'));
    }
    public function fetch($id)
    {
        $data = GeneralSettings::first();
        $response['min_amount'] = $data->minimum_withdrawable;
        $response['max_amount'] = $data->maximum_withdrawable;
        $response['withdraw_instruction'] = "Put in your Wallet Details";
        return $response;        
    }
}
