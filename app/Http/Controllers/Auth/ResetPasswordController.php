<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    public function showResetForm(Request $request, $token = null)
    {
        $pageConfigs = [
            'bodyClass' => "bg-full-screen-image",
            'blankPage' => true
        ];
        $enlace_caducado = false;
        $passReset = DB::table('password_resets')->where('email', $request->email)->first();
        if(is_null($passReset) || !Hash::check($token,$passReset->token)){
            $enlace_caducado = true;
        }

        return view('auth.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email, 'pageConfigs' => $pageConfigs, 'enlace_caducado' => $enlace_caducado]
        );
    }

    public function validationErrorMessages()
    {
        return [
                'min' => [
                'string' => 'El :attribute debe tener al menos :min caracteres.',
                ],
                'max' => [
                    'string' => 'El :attribute debe tener como máximo :min caracteres.',
                ],
                'confirmed' => 'La confirmación del :attribute no es igual.',
            ];
    }
}
