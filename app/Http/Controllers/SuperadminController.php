<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuperadminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');  // Assurez-vous que l'utilisateur est authentifié
    }

    public function index()
    {
        $user = Auth::user();

        if ($user->isSuperadmin()) {
            return view('superadmin.dashboard');
        }

        // Rediriger si l'utilisateur n'est pas un superadmin
        return redirect()->route('front-office');
    }
}

