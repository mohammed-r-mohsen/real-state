<?php

namespace App\Http\Middleware;

use Closure;

class Editor
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
        if(auth()->guard('admin')->check()){
            if(admin()->type=='editor'){
                return $next($request);
            }else{
                return redirect('/admin/dashboard');
            }
        }else{
            return redirect('/admin/login');
        }
    }
}
