<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $lang;
    public $version;
    public $user;

    public function __construct(Request $request)
    {

        $this->version = env('APP_VERSION');
        $lang = $request['lang'] ?? app()->getLocale();
        $this->setLocale($request['lang']);
        // Usuario logueado en todos los controladores y vistas
        $this->middleware(function ($request, $next) use ($lang) {
            $this->user = Auth::user();


            view()->share('user_auth', $this->user);
            view()->share('lang', $lang);  // Idioma actual
            return $next($request);
        });
    }

    public function setLocale($idioma){
        App::setLocale($idioma!=null?$idioma:'es');
    }

    public function getLocale(){
        return App::getLocale();
    }
}
