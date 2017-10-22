<?php

namespace App\Http\Middleware;

use Closure;

class Cors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $domains = ['http://localhost:8001','http://localhost:3000','http://192.168.8.103:8080'];
        if(isset($request->server()['HTTP_ORIGIN'])){
            
          $origin = $request->server()['HTTP_ORIGIN'];
         // var_dump($origin);
       //   if(in_array($origin,$domains)){
            header('Access-Control-Allow-Origin: *');
            header('Access-Control-Allow-Headers: Origin, Content-Type, Authorization');
            header('Access-Control-Allow-Methods: GET,POST,PATCH,PUT,DELETE,OPTIONS');
         // }
        }
        return $next($request);
    }
}
