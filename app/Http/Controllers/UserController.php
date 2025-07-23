<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class UserController extends Controller
{
    // Récupérer l'utilisateur connecté (pas modifié)
    public function getUser(Request $request)
    {
        return $request->user();
    }

    public function profile()
    {
        $user = auth()->user();
        return view('profil', compact('user'));
    }

    // Affiche le profil d'un utilisateur donné
    public function show(User $user)
    {
        return view('profil', compact('user'));
    }

    // Affiche le formulaire de modification
    public function edit(User $user)
    {
        $directions = \App\Direction::pluck('name', 'id')->toArray();

        return view('modifierProfil', compact('user', 'directions'));
    }

    // Met à jour l'utilisateur
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'prenom' => 'required|string|max:255',
            'adresse' => 'required|string|max:255',
            'telephone' => 'required|string|max:15',
            'profession' => 'required|string|max:255',
            'profile' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'direction_id' => 'nullable|exists:directions,id',
            'password' => 'nullable|min:6|confirmed',
        ]);

        $data = $request->all();

        // Gestion de l'image de profil
        if ($request->hasFile('profile')) {
            $imageName = time() . '.' . $request->profile->extension();
            $request->profile->move(public_path('images/profiles'), $imageName);
            $data['profile'] = $imageName;
        } else {
            unset($data['profile']);
        }

        // Gestion du mot de passe : mise à jour uniquement si rempli
        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->input('password'));
        } else {
            unset($data['password']);
        }

        $user->update($data);

        // Redirection vers la page d'index avec message succès
        return redirect()->route('users.index')
                 ->with('success', 'Profil mis à jour avec succès.');
    }

    // Supprime un utilisateur
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')
                         ->with('success', 'Utilisateur supprimé avec succès.');
    }

}
