<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        then: function () {
            Route::middleware('admin')
                ->prefix('admin')
                ->name('admin.')
                ->group(base_path('routes/admin.php'));
        },
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'auth.admin' => \App\Http\Middleware\AuthenticateAdmin::class,
            'guest.admin' => \App\Http\Middleware\RedirectIfAuthenticatedAdmin::class,
            'jwt' => \App\Http\Middleware\JwtMiddleware::class,
        ]);

        $middleware->appendToGroup('admin', [
            Illuminate\Cookie\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (Throwable $e, Request $request){
            if(request()->is('api/*') && ( $e->getPrevious() instanceof ModelNotFoundException)) {
                $model = Str::afterLast( $e->getPrevious()->getModel(), '\\' );
                return response()->json([ 'message' => $model . ' not found' ], 404); 
            }

            if ($request->is('api/*') && $e instanceof NotFoundHttpException) {
                return response()->json(['message' => 'Route not found'], 404);
            }
        });
    })->create();
