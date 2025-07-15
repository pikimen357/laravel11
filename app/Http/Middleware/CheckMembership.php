<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class CheckMembership
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if($request->header('membership') !== 'true'){
            return redirect(route('pricing'));
        }

        Log::info('Before Request:', [
            'url' => $request->url(),
            'params' => $request->header('membership'),
        ]);

        $response = $next($request);

        Log::info('After Request:', [
            'content' => $response->getContent(),
            'status' => $response->getStatusCode(),
        ]);

        return $response;
    }
}
