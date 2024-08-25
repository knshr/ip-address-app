<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Providers\RouteServiceProvider;
use App\Traits\AuditLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuditLog;
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

        $this->setAuditableKeyType(Auth::id(),'users')->toAudit([
            'old' => [],
            'new' => [],
        ], 'logged in');

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
