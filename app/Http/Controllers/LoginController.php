<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Handle an incoming authentication request.
     *
     * @param \App\Http\Request\LoginRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
     public function store(LoginRequest $request)
     {
        $request->authenticate();

        $request->session()->regenerate();

        return to_route('app.ipaddress.list');
     }

     /**
     * Destroy and authenticated sesstion.
     *
     * @param \App\Http\Request\LoginRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerate();

        return redirect()->intended();
    }
}
