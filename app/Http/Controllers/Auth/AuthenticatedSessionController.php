<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\Log;

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

        $user = Auth::user();
        $log = Log::where('user_id', $user->id)->orderBy('created_at', 'desc')->first();

        if ($log && is_null($log->logout_time)) {
            // Update the login time if there's an existing log with no logout time
            $log->update(['login_time' => now()]);
        } else {
            // Create a new log entry if there's no existing log or if it has a logout time
            Log::create([
                'user_id' => $user->id,
                'login_time' => now(),
            ]);
        }

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {

        if (Auth::check()) {
            // User is authenticated
            $user = Auth::user();
            $log = Log::where('user_id', $user->id)->orderBy('created_at', 'desc')->first();

            if ($log && is_null($log->logout_time)) {
                // Update the logout time if there's an existing log with no logout time
                $log->update(['logout_time' => now()]);
            } else {
                // Create a new log entry if there's no existing log or if it has a login time
                Log::create([
                    'user_id' => $user->id,
                    'logout_time' => now(),
                ]);
            }
        }

        Auth::guard('web')->logout();



        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
