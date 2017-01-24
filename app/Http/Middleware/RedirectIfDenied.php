<?php

namespace App\Http\Middleware;

use Closure;
use Gate, Auth;

class RedirectIfDenied
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

	public function handle($request, Closure $next, $permission, $errors='', $redirectTo='')
    {
		if (Gate::forUser(Auth::guard('admin')->user())->denies($permission)) {
			if($redirectTo) {
				return redirect($redirectTo)->withErrors($errors);
			} else {
				return redirect()->back()->withErrors($errors);
			}
		}

        return $next($request);
    }
}
