<?php

namespace Shopper\Framework\Http\Middleware;

use Closure;
use Illuminate\Http\Response;
use Shopper\Framework\Models\System\Setting;

class HasConfiguration
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
        if (Setting::query()->where('key', 'shop_email')->exists()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', Response::HTTP_UNAUTHORIZED);
            }

            return redirect()->route('shopper.dashboard');
        }

        return $next($request);
    }
}