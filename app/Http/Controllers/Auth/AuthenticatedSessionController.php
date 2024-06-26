<?php

namespace App\Http\Controllers\Auth;

use App\Enums\RoleEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();

        if(Auth::guard('web')->user()->role == RoleEnum::ADMIN){
            return redirect()->intended(RouteServiceProvider::ADMIN_HOME);
        }
        else if(Auth::guard('web')->user()->role == RoleEnum::MANAGER){
            return redirect()->intended(RouteServiceProvider::MANAGER_HOME);
        }
        else if(Auth::guard('web')->user()->role == RoleEnum::EMPLOYEE){
            return redirect()->intended(RouteServiceProvider::EMPLOYEE_HOME);
        }

        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        Session::flash('error', 'Please contact admin to config a role.');

        return redirect()->route('login');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
