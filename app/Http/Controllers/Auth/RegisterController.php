<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\GeneralSettings;
use App\Models\Network;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm(Request $request)
    {
        if ($request->has('ref')) {
            session(['referrer' => $request->query('ref')]);

        }
        $pageTitle = 'Registration Page';
        return view('theme2.user.auth.register', compact('pageTitle'));
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
   protected function validator(array $data)
   {
       return Validator::make($data, [
           'name' => ['required', 'string', 'max:255'],
           'username' => ['required', 'string', 'max:255','unique:users,username'],
           'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
           'password' => ['required', 'string', 'min:8', 'confirmed'],
           'referral_id' => ['nullable', 'string', 'min:6','max:6'],
       ]);
   }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create_my_reffered_user(array $data, $user_referral_id)
    {

        if (isset($data['referral_id'])) {
            // Get the owner of the referral code
            $owner_ref_id = User::where('referral_id', $data['referral_id'])->get();

            if (count($owner_ref_id) > 0) {
                $user_id = User::insertGetId([
                    'name' => $data['name'],
                    'password' => Hash::make($data['password']),
                    'email' => $data['email'],
                    'username' => $data['username'],
                    'referral_id' => $user_referral_id,
                    'image' => 'asset/theme2/frontend/img/user.png',
                ]);
                $bonus = GeneralSettings::first('referral_bonus');

                Network::create([
                    'referral_id' => $data['referral_id'],
                    'user_id' => $owner_ref_id[0]->id,
                    'ref_id' => $user_id,
                    'amount_earned' => $bonus->referral_bonus,

                ]);

                $result = User::where('id', $owner_ref_id[0]->id)->increment('balance', $bonus->referral_bonus);


                $userModel = User::find($user_id);

                $domain = URL::to('/');
                $url = $domain.'/register?ref='.$user_referral_id;
                $datas['url']  = $url;
                $datas['name'] = $data['name'];
                $datas['email'] = $data['email'];
                $datas['password'] = $data['password'];
                $datas['title'] = 'Registration Details';

                try {
                    Mail::send('email.registerMail', ['datas' => $datas], function($message) use($datas){
                        $message->to($datas['email'])->subject($datas['title']);
                    });
                }
                catch(Exception $e){
                    echo 'Message: ' . $e->getMessage();
                }

                // We try to send a mail notification to the admin, telling him, that someone has register on the platform.
                $data['message'] = $datas['name']. " has registered successfully on ". env('APP_NAME');
                $data['email'] = env('MAIL_FROM_ADDRESS');
                $data['extra'] = "To view registered user details, visit $domain/admin/users";
                $data['title'] = "New Registration notification";
                try {
                    //  Mail::send('email.notifications', ['data' => $data], function($message) use($data){
                    //     $message->to($data['email'])->subject($data['title']);
                    //  });
                    Mail::send('email.notifications', ['data' => $data], function($message) use($data){
                        $message->to(env('MAIL_FROM_ADDRESS'))->subject($data['title']);
                    });
                }
                catch(Exception $e){
                    echo 'Message: ' . $e->getMessage();
                }

                return $userModel;
            }
        }

    }
    protected function create(array $data)
    {
        $user_referral_id = RegisterController::generateTransactionId();
        if (isset($data['referral_id'])) {
             return $this->create_my_reffered_user($data,$user_referral_id);
        }

            $domain = URL::to('/');
            $url = $domain.'/register?ref='.$user_referral_id;
            $datas['url']  = $url;
            $datas['name'] = $data['name'];
            $datas['email'] = $data['email'];
            $datas['password'] = $data['password'];
            $datas['title'] = 'Registration Details';
            try {
                Mail::send('email.registerMail', ['datas' => $datas], function($message) use($datas){
                    $message->to($datas['email'])->subject($datas['title']);
                });
            } catch(Exception $e){
                echo 'Message: ' . $e->getMessage();
            }

        $createUser = User::create([
            'name' => $data['name'],
            'referral_id' => $user_referral_id,
            'email' => $data['email'],
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
            'image' => 'asset/theme2/frontend/img/user.png',

        ]);


            
        return $createUser;
    }



    public static function generateTransactionId(int $length = 6)
    {
        $trans_id = Str::random($length); //Generates random id
        $exist = User::where('referral_id', '=', $trans_id)->get(['referral_id']);
        if (isset($exist[0]->referral_id)) {
            return self::generateTransactionId();
        }
        return $trans_id;

    }
}
