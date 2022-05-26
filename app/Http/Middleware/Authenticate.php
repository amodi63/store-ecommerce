<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
<<<<<<< HEAD
use Illuminate\Support\Facades\Request;
=======
>>>>>>> f8bcc95f63d19519f0259da44a5f546bcb293e1b

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
<<<<<<< HEAD
        if (!$request->expectsJson()) {
            if (Request::is('admin/*')) {
                return route('admin.login');
            }
            // return route('login');
            return 'login';
=======
        if (! $request->expectsJson()) {
            return route('login');
>>>>>>> f8bcc95f63d19519f0259da44a5f546bcb293e1b
        }
    }
}
