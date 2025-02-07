<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;

class DebugAuth
{
    public function handle($request, Closure $next)
    {
        Log::info('Auth Debug', [
            'session_id' => session()->getId(),
            'user' => auth()->user(),
            'is_authenticated' => auth()->check(),
            'session_data' => session()->all(),
            'cookies' => $request->cookies->all()
        ]);
        
        return $next($request);
    }
}