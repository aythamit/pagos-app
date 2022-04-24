<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Session;

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
        $pageConfigs = [
            'bodyClass' => "bg-full-screen-image",
            'blankPage' => true
        ];

        return view('/auth/passwords/email', [
            'pageConfigs' => $pageConfigs
        ]);
    }
    public function validateEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);
    }
    public function sendResetLinkEmail(Request $request)
    {

        try{
            $this->validateEmail($request);
            // We will send the password reset link to this user. Once we have attempted
            // to send the link, we will examine the response then see the message we
            // need to show to the user. Finally, we'll send out a proper response.

            $response = $this->broker()->sendResetLink(
                $request->only('email')
            );

//            dd($response,Password::RESET_LINK_SENT,$response == Password::RESET_LINK_SENT);
            return ($response == Password::RESET_LINK_SENT)
                ? view('auth.passwords.reset-password')
                : $this->sendResetLinkFailedResponse($request, $response);
        }catch (\Exception $exception){
            Session::flash('error_reset','No se ha podido enviar el correo al usuario introducido. Por favor contacte con Soporte.');
            return back();
        }

    }
}
