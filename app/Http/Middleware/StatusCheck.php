<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class StatusCheck
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
        if ($user) {
            if ($user->role == 'admin') {
                return redirect('dashboard/products');
            } else if ($user->role == 'user'){
                return redirect('products');
            } 
        } else {
            return redirect('/login');
        }

        return $next($request);
    }
}
