<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;


class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;
    public function showLinkRequestForm()
    {
        return view('theme2.user.auth.forgot_password');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $this->validateEmail($request);

        // Attempt to send the password reset link
        $response = $this->broker()->sendResetLink(
            $request->only('email')
        );
        // Check the response to determine if the email was sent successfully
        if ($response == Password::RESET_LINK_SENT) {
            return back()->with('success', trans($response));
        } else {
            return $this->sendResetLinkFailedResponse($request, $response);

        }
    }

}
