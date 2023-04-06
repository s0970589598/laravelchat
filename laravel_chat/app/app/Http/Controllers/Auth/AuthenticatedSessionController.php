<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Events\UserLoggedIn;
use App\Events\UserLoggedOut;


class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();
        $user = Auth::user();
        //event(new \App\Events\UserLoggedIn(Auth::user()));
        event(new UserLoggedIn($user, $request->getClientIp(), $request->header('User-Agent'),now()->toDateTimeString()));

        return redirect()->intended(RouteServiceProvider::DASHBOARD);
        // return view('dashboard.index');
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        $user = Auth::user();
        // $time = now()->toDateTimeString();
        // $ip = $request->ip();
        // $device = $request->header('User-Agent');
        // $user = $request->user();

        event(new UserLoggedOut($user, $request->getClientIp(), $request->header('User-Agent'),now()->toDateTimeString()));

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
