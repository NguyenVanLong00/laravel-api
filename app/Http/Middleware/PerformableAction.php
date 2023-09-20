<?php

namespace App\Http\Middleware;

use App\Exceptions\Auth\ForbiddenException;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PerformableAction
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     * @throws ForbiddenException
     */
    public function handle(Request $request, Closure $next, ...$permissions): Response
    {
        $hasPermission = $request->user()->whereHas("roles.permissions",fn($q) => $q->whereIn("name",$permissions))->count();
        if (!$hasPermission){
            throw new ForbiddenException();
        }

        return $next($request);
    }

    /**
     * @param string $pattern
     * @return array
     */
    public function getListPermissions(string $pattern): array
    {
        $permissions = explode(":", $pattern);

        return explode(",", $permissions[1]);
    }
}
