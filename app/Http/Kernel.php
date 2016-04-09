<?php

namespace Stellar\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{

    /**
     * The application's global HTTP middleware stack.
     *
     * @var array
     */
    protected $middleware = [
      \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
      'web' => [
        \Stellar\Http\Middleware\EncryptCookies::class,
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \Stellar\Http\Middleware\VerifyCsrfToken::class,
      ],

      'api' => [
        'throttle:60,1',
      ],
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
      'auth'       => \Stellar\Http\Middleware\Authenticate::class,
      'role'       => \Stellar\Http\Middleware\RoleMiddleware::class,
      'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
      'guest'      => \Stellar\Http\Middleware\RedirectIfAuthenticated::class,
      'throttle'   => \Illuminate\Routing\Middleware\ThrottleRequests::class,
    ];
}

