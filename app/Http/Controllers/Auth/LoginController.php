<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Show the login form.
     */
    public function showLoginForm()
    {
        // Redirect already authenticated users
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }

        return view('auth.login');
    }


    /**
     * Authenticate the user.
     */
    public function login(Request $request)
    {
        // Validate submitted credentials
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);


        // Check Remember Me
        $remember = $request->boolean('remember');


        // Attempt login
        if (Auth::attempt($credentials, $remember)) {

            // Regenerate session
            $request->session()->regenerate();


            // Redirect to admin dashboard
            return redirect()
                ->route('admin.dashboard')
                ->with(
                    'success',
                    'Welcome back! You have successfully logged in.'
                );
        }


        // Failed login
        return back()
            ->withErrors([
                'email' => 'The email address or password is incorrect.',
            ])
            ->onlyInput('email');
    }


    /**
     * Logout the user.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();


        return redirect()
            ->route('login')
            ->with(
                'success',
                'You have been logged out successfully.'
            );
    }
}
