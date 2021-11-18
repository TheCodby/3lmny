<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Auth;

class Logging
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $requestData = implode(' & ', $request->all());
        $Username = Auth::user()->username ?? 'Null';
        // Logging Requests
        Log::channel('main')->info( 'NEW REQUEST: '.
            'URL: '. $request->url(). ' | '.
            'METHOD: '. $request->method(). ' | '.
            'IP: '. $request->ip(). ' | '.
            'USERNAME: '. $Username. ' | '.
            'REQUEST: '. $requestData
        );

        return $next($request);
    }
}
