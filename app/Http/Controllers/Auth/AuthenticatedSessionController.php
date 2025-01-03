<?php

namespace App\Http\Controllers\Auth;

use App\Models\LoginLog;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\Auth\LoginRequest;
use Carbon\Carbon;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }
    public function createToken()
    {
        return view('auth.token-login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // $request->authenticate();

        // $request->session()->regenerate();

        // return redirect()->intended(RouteServiceProvider::HOME);
        $request->authenticate();

        $request->session()->regenerate();

        LoginLog::create([
        'user_id' => $request->user()->id,
        'ip_address' => $request->ip(),
        'user_agent' => $request->header('User-Agent'),
        'logged_in_at' => Carbon::now('Asia/Jakarta'),
    ]);

        $url = "";
        if ($request->user()->role === "admin") {
            $url = "petugas";
        } elseif ($request->user()->role === "petugas") {
            $url = "dashboard";
        } else {
            $url = "dashboard";
        }

        return redirect()->intended($url);
    }

    /**
     * Destroy an authenticated session.
     */
    public function loginWithToken(Request $request): RedirectResponse
    {
        // Validasi input
        $request->validate([
            'token' => 'required|string',
        ]);

        // Cari user berdasarkan token
        $user = \App\Models\User::where('unique_token', $request->token)->first();

        // Jika user tidak ditemukan
        if (!$user) {
            return back()->with('error', 'Invalid token. Please try again.');
        }

    // Login pengguna
    Auth::login($user);
    LoginLog::create([
        'user_id' => $request->user()->id,
        'ip_address' => $request->ip(),
        'user_agent' => $request->header('User-Agent'),
        'logged_in_at' => Carbon::now('Asia/Jakarta'),
    ]);
    // Redirect berdasarkan peran
    $url = match ($user->role) {
        'admin' => 'petugas',
        'petugas' => 'dashboard',
        default => 'dashboard',
    };

        return redirect()->intended($url)->with('success', 'Login successful!');
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
