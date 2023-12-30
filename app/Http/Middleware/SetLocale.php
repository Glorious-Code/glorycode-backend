<?php

namespace App\Http\Middleware;

use App\Actions\Languages\ChangeUserLanguage;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $language = 'en';

        if (isset(auth()->user()->language)) {
            $language = auth()->user()->language;
        }

        ChangeUserLanguage::run($language);

        return $next($request);
    }
}
