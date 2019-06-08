<?php

namespace App\Http\Middleware;

use Closure;

class user_admin
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
        //เช็คสิทธิ์ว่า user เป็น admin หรือไม่
        $user =  $request->user();
        if($user && $user->user_status=='admin'){
        return $next($request);
        }else{
            return redirect('/');
        }
        
    }
}
