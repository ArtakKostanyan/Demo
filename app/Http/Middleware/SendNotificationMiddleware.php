<?php

namespace App\Http\Middleware;

use App\Mail\OsInfoMail;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Jenssegers\Agent\Agent;

class SendNotificationMiddleware
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

        if(Auth::check()){
            $agent=new Agent();
            Mail::to(auth()->user())->send(new OsInfoMail($agent));
        }
        return $next($request);
    }
}
