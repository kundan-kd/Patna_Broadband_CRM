<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfNotAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Step 1: Check if user is authenticated
        if (!Auth::check()) {
            return redirect()->route('index');
        }

        // Step 2: Check if session token matches
        $user = Auth::user();
        $sessionToken = session('session_token');
        if (!$sessionToken || $user->session_token != $sessionToken) {
            // Token mismatch — force logout
            Auth::logout();

            // Clear session
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            // Redirect with error
            return redirect()->route('index');
        }

        return $next($request);
    }
}
