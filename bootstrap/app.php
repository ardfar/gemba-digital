<?php

use App\Http\Middleware\ApiKeyMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\RoleMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        then: function() {
            Route::middleware('web')
                ->group(base_path('routes/auth.php'));

            Route::middleware('web')
                ->group(base_path('routes/user.php'));
            
            Route::middleware('web')
                ->group(base_path('routes/gemba.php'));
            
            Route::middleware('web')
                ->group(base_path('routes/issue.php'));
            
            Route::middleware('web')
                ->group(base_path('routes/appreciation.php'));
            
            Route::middleware('web')
                ->group(base_path('routes/attendance.php'));

            Route::middleware('web')
                ->group(base_path('routes/action.php'));

            Route::middleware('web')
                ->group(base_path('routes/cause.php'));

            Route::middleware(['api', 'api.key'])->prefix('api')
                ->group(base_path('routes/api.php'));
            
        }
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'role' => RoleMiddleware::class,
            'api.key' => ApiKeyMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
