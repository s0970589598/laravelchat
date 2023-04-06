<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use App\Events\UserLoggedIn;
use App\Events\UserLoggedOut;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        // UserLoggedIn::class => [
        //     LogSuccessfulLogin::class,
        // ],
        // UserLoggedOut::class => [
        //     LogSuccessfulLogout::class,
        // ],
        'App\Events\UserLoggedIn'    => [
            'App\Listeners\LogSuccessfulLogin',
        ],
        'App\Events\UserLoggedOut'  => [
            'App\Listeners\LogSuccessfulLogout',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
