<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
<<<<<<< HEAD
                if ($guard == 'admin') {
                    return redirect(RouteServiceProvider::ADMIN);
                }
                else {
                    return redirect(RouteServiceProvider::HOME);
                }

=======
                return redirect(RouteServiceProvider::HOME);
>>>>>>> f8bcc95f63d19519f0259da44a5f546bcb293e1b
            }
        }

        return $next($request);
    }
}
