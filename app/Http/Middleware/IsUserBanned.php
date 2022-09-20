<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class IsUserBanned
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->check() && auth()->user()->banned_until != null) {

            if (auth()->user()->banned_until == 0) {
                $message = 'Your account has been banned permanently. Reason: ' . auth()->user()->banned_reason;
            }
            if (now()->lessThan(auth()->user()->banned_until)) {
                $banned_days = now()->diffInDays(auth()->user()->banned_until) + 1;
                $message = 'Your account has been suspended for ' . $banned_days . ' ' . Str::plural('day', $banned_days) . '. Reason: ' . auth()->user()->banned_reason;
            }

            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('login')->withMessage($message);
        }

        return $next($request);
    }
}