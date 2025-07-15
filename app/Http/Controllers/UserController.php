<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User; 

class UserController extends Controller
{
    public function getUser(Request $request)
    {
        return $request->user();
    }

    public function show()
    {
        $user = Auth::user();
        return view('profil', compact('user'));
    }
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('modifierProfil', compact('user'));
    }

    public function update(Request $request, $id)
{
    $user = User::findOrFail($id);  

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email,' . $id,  
        'password' => 'nullable|min:6|confirmed',  
        'prenom' => 'required|string|max:255',
        'adresse' => 'nullable|string|max:255',
        'telephone' => 'nullable|string|max:15',  
        'profession' => 'nullable|string|max:255',
        'profile' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
    ]);

    // Mise à jour des informations de l'utilisateur
    $user->name = $request->input('name');
    $user->email = $request->input('email');
    $user->prenom = $request->input('prenom');
    $user->adresse = $request->input('adresse');
    $user->telephone = $request->input('telephone');
    $user->profession = $request->input('profession');

    if ($request->hasFile('profile')) {
        $imageName = time() . '.' . $request->profile->extension();  
        $request->profile->move(public_path('images/profiles'), $imageName);  
        $user->profile = $imageName; 
    }

    // Si un mot de passe est fourni, le mettre à jour
    if ($request->filled('password')) {
        $user->password = bcrypt($request->input('password'));
    }

    // Sauvegarder les modifications
    $user->save();  

    // Redirection vers la page du profil de l'utilisateur avec un message de succès
    return redirect()->route('profile')->with('success', 'Votre profil a été mis à jour avec succès!');
}

}


