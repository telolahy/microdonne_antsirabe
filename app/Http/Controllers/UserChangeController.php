<?php

// stagiaire

namespace App\Http\Controllers;

use App\User; 
use App\Direction; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class UserChangeController extends Controller
{

    public function index(Request $request)
    {
        if (!Gate::allows('DSIC')) {
            abort(403, 'Accès non autorisé.');
        }
        $search = $request->input('search');
        $users = User::query()
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            })
            // ->get();
            ->paginate(10);
        $directions = Direction::pluck('name', 'id');
        return view('users.index', compact('users', 'directions'));
    }

    public function changerRole(Request $request, User $user)
    {
        $request->validate([
            'direction_id' => 'required|exists:directions,id',
        ]);

        $user->direction_id = $request->direction_id;
        $user->save();

        return redirect()->route('users.index')->with('success', 'Rôle modifié avec succès.');
    }
}
