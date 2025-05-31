<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/dashboard';
    public const ADMIN = 'admin/dashboard';
    public const STAFF = 'staff/dashboard';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            Route::middleware(['web', 'auth', 'role:admin'])
                ->group(base_path('routes/admin.php'));

            Route::middleware(['web', 'auth', 'role:staff'])
                ->group(base_path('routes/staff.php'));
            //in line above the middleware uses the middleware 'role' (that we just defined in kernel.php and we created RoleMiddleware.php)
            //this role middleware will take a string parameter that we give it which is 'admin' to pass into $role parameter in RoleMiddleware.php
            //this middleware will compare the role given and decided wether or not to allow to enter this route.
            //all of these middleware will be implemented into admin.php that means any route in admin.php will use these middlewares.
        });
    }
}
