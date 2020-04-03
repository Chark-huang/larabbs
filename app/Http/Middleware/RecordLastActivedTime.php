<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RecordLastActivedTime
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
        // 如果是登陆用户的话
        if (Auth::user()){
             // 记录最后登陆时间
            Auth::user()->recordLastActivedAt();
        }

        return $next($request);
    }
}
