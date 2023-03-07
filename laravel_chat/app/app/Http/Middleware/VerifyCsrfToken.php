<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'centrifugo/*',
        'http://localhost/api/rooms/*',
        'https://localhost/api/rooms/*',
        'https://motc.faninsights.io/api/rooms/*',
        'https://motc.faninsights.io/api/rooms/firstadd',
        'http://motc.faninsights.io/api/rooms/*',
        'http://motc.faninsights.io/api/rooms/firstadd',
        'http://localhost/api/*',
        'https://localhost/api/*',
        'https://motc.faninsights.io/api/*',
        'http://motc.faninsights.io/api/*',
        'http://localhost/dialogue/*',
        'https://localhost/dialogue/*',
        'http://motc.faninsights.io/dialogue/*',
        'https://motc.faninsights.io/dialogue/*',
    ];
}
