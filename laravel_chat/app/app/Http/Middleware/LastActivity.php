<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class LastActivity
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            //$lastActivity = session('last_activity');

            if ($lastActivity && now()->diffInMinutes($lastActivity) >= 30) {
                Auth::logout();
                return redirect('/login');
            }

            //session(['last_activity' => now()]);
        }

        return $next($request);
    }
}
