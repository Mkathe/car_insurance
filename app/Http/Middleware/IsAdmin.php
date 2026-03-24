<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user()!=null){
            $user = $request->user();
            if ($user->type=='admin'){
                return $next($request);
            }
        }
        return redirect()->route('cars.index');
    }
}
