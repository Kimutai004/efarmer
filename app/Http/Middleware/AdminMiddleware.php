<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        if (auth()->user()->status !== 'active') {
            auth()->logout();

            return redirect()
                ->route('login')
                ->with('error', 'Your account is not active.');
        }

        return $next($request);
    }
}
