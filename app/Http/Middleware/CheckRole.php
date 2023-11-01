<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // public function handle(Request $request, Closure $next, ...$roles): Response
    // {
    //     if (! auth()->user() || ! $this->userHasAnyRole($roles)) {
    //     return redirect('/home');
    // }

    // // Si el usuario tiene el rol, continúa con la solicitud.
    // return $next($request);

    // }
    // private function userHasAnyRole( $roles)
    // {
    //     foreach ($roles as $role) {
    //         if (auth()->user()->hasRole($role)) {
    //             return true;
    //         }
    //     }
    //     return false;
    // }

    //lo inverso
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (! auth()->user() || ! $this->userHasAnyRole($roles)) {
        return redirect('/home');
    }

    // Si el usuario tiene el rol, continúa con la solicitud.
    return $next($request);

    }
    private function userHasAnyRole( $roles)
    {
        foreach ($roles as $role) {
            if (auth()->user()->hasRole($role)) {
                return true;
            }
        }
        return false;
    }
}
