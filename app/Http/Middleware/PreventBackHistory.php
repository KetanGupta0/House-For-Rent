<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class PreventBackHistory {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        $response = $next($request);

        if (!$request->isMethod('get')) {
            return $response;
        }
    
        if (!$request->is('*/login') && !$request->is('*/logout') && !Session::has('loggedin')) {
            return $response->header('Cache-Control','no-cache, no-store, max-age=0, must-revalidate')
                             ->header('Pragma','no-cache')
                             ->header('Expires','Sat, 01 Jan 1990 00:00:00 GMT');
        }
    
        return $response;
    }
  }
