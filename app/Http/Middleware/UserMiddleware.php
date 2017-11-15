<?php

namespace App\Http\Middleware;

use App\Models\Offer;
use App\Models\Tire;
use Closure;
use Illuminate\Support\Facades\Auth;

class UserMiddleware
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
        $user = Auth::user();
        $offer = Offer::where('id', $request->id)->first();
        if ((isset($user) && $user->id != $offer->user_id) || !isset($user)){
           return redirect('/');
        }
        return $next($request);
    }
}
