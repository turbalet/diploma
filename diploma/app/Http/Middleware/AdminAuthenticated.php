<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AdminAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::check()) {
            $user = Auth::user();

            if($user->hasRole('user')) {
                return response('Access denied', 403);
            }
            else if($user->hasRole('admin')) {
                return $next($request);
            }
        } else {
            return response('Unauthorized', 401);
        }

        return response('Access denied', 403);
    }
}
