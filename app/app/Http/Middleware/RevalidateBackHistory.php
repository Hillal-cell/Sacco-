<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RevalidateBackHistory
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $response= $next($request);

         return $response->header('Cache-Control','nocache', 'no-store, max-age=0, must-revalidate')
        ->header('Pragma','no-cache')
         ->header('Expires','thursday, 24 Aug 2023 12:50 GMT');
    }
}









