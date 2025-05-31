<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response //$parameter $role
    {
        if ($request->user()->role === $role) { //user()->role will access the 'role column' of 'user' table in the database.
            return $next($request); //if the given parameter is equals to role, will allow user to passthrough.
        }
        return to_route('dashboard');
    }
}
