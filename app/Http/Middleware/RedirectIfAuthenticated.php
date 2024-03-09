<?php

namespace App\Http\Middleware;

use App\Enums\RoleEnum;
use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

//        foreach ($guards as $guard) {
//            if (Auth::guard($guard)->check()) {
////                return redirect(RouteServiceProvider::HOME);
//                return redirect()->route('admin.users.index');
//            }
//        }

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                if(Auth::guard('web')->user()->role == RoleEnum::ADMIN){
                    return redirect()->intended(RouteServiceProvider::ADMIN_HOME);
                }
                if(Auth::guard('web')->user()->role == RoleEnum::MANAGER){
                    return redirect()->intended(RouteServiceProvider::MANAGER_HOME);
                }
                if(Auth::guard('web')->user()->role == RoleEnum::EMPLOYEE){
                    return redirect()->intended(RouteServiceProvider::EMPLOYEE_HOME);
                }

                return redirect()->intended(RouteServiceProvider::HOME);
            }
        }
        return $next($request);
    }
}
