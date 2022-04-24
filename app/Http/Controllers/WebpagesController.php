<?php

namespace App\Http\Controllers;

use App\Helpers\propiedades;
use App\Models\Cabecera;
use App\Models\Noticia;
use App\Models\Servicio;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;
use Exception;


class WebpagesController extends Controller
{

    // HOMEPAGE
    public function home()
    {
        //$agent = new Agent();
        //$isMobile = ($agent->isMobile() || $agent->isTablet()) ? false : true;
        //$isMobile = false;

        return view('/web/pages/home/index', []);
    }

    // COOKIES
    public function cookies(Request $request)
    {
        return view('/web/pages/politicas/cookies');
    }

    // PRIVACIDAD
    public function privacidad(Request $request)
    {
        return view('/web/pages/politicas/privacidad');
    }

    // AVISO LEGAL
    public function aviso()
    {
        return view('/web/pages/politicas/aviso-legal');
    }

    // MANTENIMIENTO
    public function maintenance(Request $request){
        return view('errors.maintenance');
    }

    // APPEND VIEW PARA SEO
//    public function appendViews(){
//        // Servicios
//        $servicios = Servicio::query()->whereNotNull('nombre')->get();
//
//        $vServicios = view('web.pages.home.services', compact('servicios'))->render();
////        $vDivider = view('web.pages.home.divider', ['title' => 'SERVED PORTS'])->render();
//        $vMapa = view('web.pages.home.mapa')->render();
//        $vTeam = view('web.pages.home.team')->render();
//
//        return response([
//            'vServicios'=>$vServicios,
////            'vDivider'=>$vDivider,
//            'vMapa'=>$vMapa,
//            'vTeam'=>$vTeam,
//        ],200);
//
//    }

}
