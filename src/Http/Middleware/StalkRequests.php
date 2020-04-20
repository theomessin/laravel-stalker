<?php

namespace Theomessin\Stalker\Http\Middleware;

use Closure;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Http\Response;
use Theomessin\Stalker\Request;

class StalkRequests
{
    public function handle(HttpRequest $request, Closure $next): Response
    {
        $response = $next($request);

        Request::create([
            'url' => $request->url(),
            'method' => $request->method(),
            'ip_address' => $request->ip(),
        ]);

        return $response;
    }
}
