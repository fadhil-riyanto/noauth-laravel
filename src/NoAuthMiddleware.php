<?php

namespace FadhilRiyanto\NoAuthLaravel;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use FadhilRiyanto\NoAuthLaravel;

class NoAuthMiddleware
{
        public function handle(Request $request, Closure $next): Response
        {
                // Debug::noauth_debug($request);
                if (NoAuth::verify($request)) {
                        $response = $next($request);
                        return $response;
                        
                } else {
                        return redirect()->route("noauth-guest"); 
                }
                // 

                // Perform action

                // return $response;
                // return 
        }
}
