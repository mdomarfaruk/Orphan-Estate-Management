<?php

namespace App\Http\Middleware;

use Closure;
use App\user;


class user_login_check
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$name)
    {
        $user=user::find(1);
        if(isset($user) && ($user->name != $name)){
            return redirect('/login');
        }else {
            return $next($request);
        }
    }
}
