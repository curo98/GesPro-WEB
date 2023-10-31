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
    public function handle(Request $request, Closure $next, String $role): Response
    {

        // $user = $request->user();

        // if ($user && ($user->role->name === 'compras' || $user->role->name === 'contabilidad')) {
        //     return $next($request);
        // }
        if ($request->user()->role->name($role)) {
            # code...
        }

        return redirect('/home');

    }
}
