<?php
// app/Http/Middleware/CheckIfBanned.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckIfBanned
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if ($user && $user->ban) {
            Auth::logout();
            return redirect()->route('login')->withErrors(['email' => 'Tu cuenta ha sido baneada.']);
        }

        return $next($request);
    }
}