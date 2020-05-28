<?php

namespace App\Http\Middleware;
use Illuminate\Http\Response;

use Closure;

class cors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    
     public function handle($request, Closure $next) {
       header('Access-Control-Allow-Origin: *');
     
      $headers = [
        'Access-Control-Allow-Headers'=>'Content-Type, X-Auth-Token, Origin, Authorization',
        'Access-Control-Allow-Methods'=>'GET,HEAD,PUT,PATCH,POST,DELETE,OPTIONS',
      ];
      if ($request->getMethod() === 'OPTIONS') {
        return response()->json('ok',200,$headers);

      }
/*
    return $next($request)
      ->header('Access-Control-Allow-Origin', '*')
      ->header('Access-Control-Allow-Methods', '*')
      ->header('Access-Control-Allow-Headers','*')
      ->header('Access-Control-Allow-Credentials','true')
       ->header('X-Requested-With','XMLHttpRequest')
      ->header('Vary',' Origin');
      */

      $response = $next($request);
      foreach ($headers as $key => $value) {
       $response->header($key,$value);
      }

      return $response;
     
}
}
