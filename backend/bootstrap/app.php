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
            'stateful' => EnsureFrontendRequestsAreStateful::class,  // Sanctum Middleware
        ]);

        // Add CORS handling globally for all routes
        $middleware->alias([
            'cors' => function ($request, $next) {
                $response = $next($request);

                // Set CORS headers for all requests
                $response->headers->set('Access-Control-Allow-Origin', 'http://localhost:5173');  // Set your frontend origin
                $response->headers->set('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
                $response->headers->set('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-Requested-With');
                $response->headers->set('Access-Control-Allow-Credentials', 'true');  // This is required for using credentials like cookies

                // Handle preflight OPTIONS request
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
        // Custom exception handling
    })

    ->create();
