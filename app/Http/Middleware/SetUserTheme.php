<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetUserTheme
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // return $next($request);
        $r = $next($request);

        $user = $request->user();
        $user->theme = 'dark';
        $u = str_replace('<html lang="en">', '<html lang="en" class="' . $user->theme . '">', $r->getContent());
        $r->setContent($u);

        return $r;
    }
}
