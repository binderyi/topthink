<?php

namespace app\http\middleware;

class Auth
{
    public function handle($request, \Closure $next)
    {
    	    session('?user')
    	        ? $next($request)
    	        : redirect('user/session/create')->with('validate', '请先登录');
    }
}
