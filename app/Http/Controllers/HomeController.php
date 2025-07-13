<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // Récupérer l'utilisateur authentifié

        if ($user) {
            // Vérifier si l'utilisateur est un superadmin
            if ($user->isSuperadmin()) {
                return redirect()->route('superadmin');  // Rediriger vers la page du superadmin
            }

            if ($user->isDirection()) {
                // Rediriger vers la page de la direction de l'utilisateur avec l'ID de direction
                return redirect()->route('themes.index', ['directionId' => $user->direction_id]);
            }
    
            // Si l'utilisateur est un simple utilisateur
            return redirect()->route('front-office'); // Rediriger vers le front office
        }

        // Si l'utilisateur n'est pas authentifié, rediriger vers la page de connexion
        return redirect()->route('login');
    }

    public function redirectToHome()
    {
        return redirect()->route('home');
    }
}

