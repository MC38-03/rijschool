<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;

return Application::configure(basePath: dirname(__DIR__))

    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        api: __DIR__.'/../routes/api.php',
        health: '/up',
    )

    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'stateful' => EnsureFrontendRequestsAreStateful::class,
        ]);


        $middleware->alias([
            'cors' => function ($request, $next) {
                $response = $next($request);

                $response->headers->set('Access-Control-Allow-Origin', 'http://localhost:5173');
                $response->headers->set('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
                $response->headers->set('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-Requested-With');
                $response->headers->set('Access-Control-Allow-Credentials', 'true');

                if ($request->getMethod() === 'OPTIONS') {
                    return response('', 204)
                        ->header('Access-Control-Allow-Origin', 'http://localhost:5173')
                        ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
                        ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-Requested-With')
                        ->header('Access-Control-Allow-Credentials', 'true');
                }

                return $response;
            }
        ]);
    })

    ->withExceptions(function (Exceptions $exceptions) {

    })

    ->create();
