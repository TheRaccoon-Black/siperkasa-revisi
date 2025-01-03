<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // public function handle(Request $request, Closure $next): Response
    // {
    //     return $next($request);
    // }
    // public function handle(Request $request, Closure $next, $role): Response
    public function handle(Request $request, Closure $next, $roles): Response
    {

        // if($request->user()->role !== $role){
        //     return redirect('dashboard');
        // }
        // return $next($request);

        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        $rolesArray = explode('|', $roles);
        if (!in_array($user->role, $rolesArray)) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
