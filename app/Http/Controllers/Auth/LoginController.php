<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    use AuthenticatesUsers;

    // Où rediriger les utilisateurs après la connexion
    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // Affiche le formulaire de connexion
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Gère la connexion de l'utilisateur
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            return redirect()->intended($this->redirectTo);
        }

        return redirect()->back()->withInput($request->only('email', 'remember'))->withErrors(['email' => 'Ces identifiants ne correspondent pas à nos enregistrements.']);
    }

    // Gère la déconnexion
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }
}
