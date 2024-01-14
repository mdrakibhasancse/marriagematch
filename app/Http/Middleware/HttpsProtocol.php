<?php

namespace App\Http\Middleware;

use Closure;

class HttpsProtocol {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (env('FORCE_HTTPS') == "On" && !$request->secure()) {
            // return redirect()->secure($request->getRequestUri());

            if (substr($request->header('Host'), 0, 4)  !== 'www.') 
            {
                    $request->headers->set('Host', 'www.marriagematchbd.com');

                return redirect()->secure($request->path(), 301);
            }
        }elseif(env('FORCE_HTTPS') == "On" && $request->secure()){
            if (substr($request->header('Host'), 0, 4)  !== 'www.') 
            {
                    $request->headers->set('Host', 'www.marriagematchbd.com');

                return redirect()->secure($request->path(), 301);
            }

        }
        return $next($request);
    }
}