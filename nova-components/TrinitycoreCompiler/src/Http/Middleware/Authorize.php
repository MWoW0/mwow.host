<?php

namespace Sasin91\TrinitycoreCompiler\Http\Middleware;

use Sasin91\TrinitycoreCompiler\TrinitycoreCompiler;

class Authorize
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Illuminate\Http\Response
     */
    public function handle($request, $next)
    {
        return resolve(TrinitycoreCompiler::class)->authorize($request) ? $next($request) : abort(403);
    }
}
