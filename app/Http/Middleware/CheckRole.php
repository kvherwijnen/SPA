<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle($request, Closure $next)
    {
//        if(Auth::user()->role === 2) {
//            return $next($request);
//        }
//        else {
//            return response()->json(['error' => 'Unauthorized'], 403);
//        }
        $roles = $this->getRequiredRoleForRoute($request->route());

        if($request->user()->hasRole($roles) || !$roles)
        {
            return $next($request);
        }
        return response(['error' =>[]], 401);

    }

    private function getRequiredRoleForRoute($route)
    {
        $actions = $route->getAction();
        return isset($actions['roles']) ? $actions['roles'] : null;
    }
}
