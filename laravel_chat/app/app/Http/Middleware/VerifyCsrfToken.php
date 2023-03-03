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
    ];
}
