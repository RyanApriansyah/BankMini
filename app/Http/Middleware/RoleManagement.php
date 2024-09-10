<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleManagement
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {

        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $authRole = Auth::user()->role;

        switch ($role) {
            case 'admin';
                if ($authRole == 0) {
                    return $next($request);
                }
                break;
            case 'officer';
                if ($authRole == 1) {
                    return $next($request);
                }
                break;
            case 'user';
                if ($authRole == 2) {
                    return $next($request);
                }
                break;
        }
        switch ($authRole) {
            case 0;
                return redirect()->route('Admin/admin');
            case 1;
                return redirect()->route('Officer/officer');
            case 2;
                return redirect()->route('dashboard');
        }
        return redirect()->route('login');
    }
}
