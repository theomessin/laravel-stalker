<?php

namespace Theomessin\Stalker\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Theomessin\Stalker\StalkerEntry;

class StalkRequests
{
    public function handle($request, Closure $next)
    {
        return $next($request);
    }

    public function terminate($request)
    {
        StalkerEntry::create([
            'stalkable' => Auth::user(),
            'url' => $request->fullUrl(),
            'method' => $request->method(),
            'ip_address' => $request->ip(),
        ]);
    }
}
