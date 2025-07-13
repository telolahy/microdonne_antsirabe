<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Theme;
use Illuminate\Support\Facades\Storage;

class ThemeController extends Controller
{

    public function store(Request $request)
{
    $validatedData = $request->validate([
        'nom' => 'required|string|max:255',
        'description' => 'required|string',
        'nbreDonnee' => 'nullable|integer',
        'image' => 'nullable|image|mimes:jpeg,png,jpg', 
    ]);

    $user = auth()->user();

    if (!$user->direction) {
        return redirect()->route('themes.index')->with('error', 'L\'utilisateur n\'a pas de direction associée!');
    }

    $validatedData['direction_id'] = $user->direction->id;
    
    if ($request->hasFile('image')) {  
        $imageName = time() . '.' . $request->image->extension();  
        $request->image->storeAs('images/themes', $imageName, 'public');  
        $validatedData['image'] = $imageName; 
    }

    Theme::create($validatedData);

    return redirect()->route('themes.index')->with('success', 'Thème ajouté avec succès.');
}

public function index(Request $request)
{
    $user = Auth::user();
    $direction = $user->direction;
    $search = $request->input('search');

    if ($search) {
        $themes = Theme::where('direction_id', $direction->id)
                        ->where(function ($query) use ($search) {
                            $query->where('nom', 'like', '%' . $search . '%')
                                  ->orWhere('description', 'like', '%' . $search . '%');
                        })
                        ->paginate(10); 
    } else {
        $themes = Theme::where('direction_id', $direction->id)
                        ->paginate(10); 
    }

    return view('themes.index', compact('themes', 'direction', 'user'));
}

    
    public function destroy($id)
    {
        $theme = Theme::findOrFail($id);

        $theme->delete();

        return redirect()->back()->with('Succès', 'Thème supprimé.');
    }
    public function update(Request $request, $id)
{
    $request->validate([
        'nom' => 'required|string|max:255',
        'description' => 'required|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $theme = Theme::findOrFail($id);
    $theme->nom = $request->nom;
    $theme->description = $request->description;

    if ($request->hasFile('image')) {
        if ($theme->image) {
            Storage::delete('public/images/themes/' . $theme->image);
        }
        $imagePath = $request->file('image')->store('images/themes', 'public');
        $theme->image = basename($imagePath);
    }

    $theme->save();

    return redirect()->route('themes.index')->with('success', 'Thème mis à jour avec succès');
}
public function edit($id)
    {
        $theme = Theme::findOrFail($id); 
        return view('themes.edit', compact('theme')); 
    }

}

