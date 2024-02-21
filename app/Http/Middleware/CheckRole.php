<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$role): Response
    {
        $scan = array_search('mod', $role);
        if ($scan !== false) {
            unset($role[$scan]);
            $role = array_merge($role, ['admin','advisor']);
        }
        
        if (auth()->check() && in_array(auth()->user()->role, $role)) {
            return $next($request);
        }
        
        abort(403, 'Unauthorized');
    }
}
