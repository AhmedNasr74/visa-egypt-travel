<?php

namespace App\Http\Middleware;

use App\Support\SiteSeo;
use Closure;
use Illuminate\Http\Request;

class ApplyDefaultSiteSeo
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->is('dashboard*') && !$request->is('admin*') && !$request->is('api*')) {
            SiteSeo::applyDefaults();
        }

        return $next($request);
    }
}
