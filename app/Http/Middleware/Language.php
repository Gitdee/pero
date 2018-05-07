<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use DB;


class Language
{
    public function handle($request, Closure $next)
    {
        $debug = env("APP_DEBUG");   
        if(!$debug){
          ini_set("display_errors", 0);
          error_reporting(0);
        }
        if (Session::has('applocale') && array_key_exists(Session::get('applocale'), Config::get('languages'))) {
            App::setLocale(Session::get('applocale'));
        }
        else { // This is optional as Laravel will automatically set the fallback language if there is none specified
           App::setLocale(Config::get('app.locale'));
        }
        return $next($request);
    }
}
