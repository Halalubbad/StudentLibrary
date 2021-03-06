<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        // if (! $request->expectsJson()) {
        //     if($request->guard == 'user'){
        //         return route('user.login');
        //     }else{
        //         return route('admin.login');
        //     }
        // return route('user.login');
        // }
        
        // if(Auth::guard('user')){
        //     return route('edu.login',);
        // }else{
        //     return route('edu.login');
        // }

        if (!$request->expectsJson()) {
            return route('edu.login', 'admin');
        }
    }
}
