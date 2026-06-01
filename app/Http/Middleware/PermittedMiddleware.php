<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PermittedMiddleware
{
    private array $excluded =[
        'dashboard.toggle-theme',
        'dashboard.optimize',
        'dashboard.tours.options',
        'dashboard.model.auto.translate',
        'dashboard.sells',
        'dashboard.tours-search',
        'dashboard.Send-Email',
        'dashboard.car-routes.template',
    ];
    public function handle(Request $request, Closure $next)
    {
        try {
            $permission = Str::of($request->route()->getName())
                ->remove('dashboard.')
                ->replace('store', 'create')
                ->replace('index', 'list')
                ->replace('update', 'edit')
                ->replace('destroy', 'delete');

        } catch (\Exception $exception) {
            report($exception);
            $permission = '';
        }

        if ($permission && !in_array($request->route()->getName(), $this->excluded)) {
            abort_if(admin()->cannot($permission), 403);
        }

        return $next($request);
    }
}
