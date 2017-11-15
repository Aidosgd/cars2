<?php

namespace App\Http\Middleware;

use App\Models\City;
use Closure;

class CityMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (in_array($request->method(), ['HEAD', 'GET', 'OPTIONS'])) {
            $requestRegion = $request->query->get('region');

            if ($requestRegion) {
                $url = app('url')->full();
                $url = explode('?', $url);
                $url[1] = preg_replace('/region=([\d]+)(\&*)/', '', $url[1]);
                if (!$url[1]) unset($url[1]);

                if (! City::query()->find($requestRegion)) {
                    $requestRegion = null;
                }

                return redirect(implode('?', $url))->withCookie(cookie()->forever('region-selected', $requestRegion));
            }
        }

        return $next($request);
    }
}
