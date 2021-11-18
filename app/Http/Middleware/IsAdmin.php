<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class IsAdmin
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
      if (Auth::user() &&  Auth::user()->user_type == 2)
      {
        return $next($request);
      } else {
        // add warn message in logs.
        $intruder = Auth::user()->username ?? ''.' | '.$request->ip();
        Log::channel('admin')->warning($intruder. ' Trying access to admin permessions.');
        return redirect()->route('index');
      }
    }
}
