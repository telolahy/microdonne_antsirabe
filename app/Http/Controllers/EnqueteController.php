<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Enquete;
use App\Direction;

class EnqueteController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'images' => 'nullable|image|mimes:jpeg,png,jpg', 
        ]);
    
        $user = auth()->user();
        if (!$user->direction) {
            return redirect()->route('enquete.index')->with('error', 'L\'utilisateur n\'a pas de direction associée!');
        }
    
        $validatedData['direction_id'] = $user->direction->id;

        if ($request->hasFile('images')) {
            $imageName = time() . '.' . $request->images->extension(); 
            $request->images->storeAs('images/enquetes', $imageName, 'public'); 
            $validatedData['images'] = $imageName; 
        }
        
        Enquete::create($validatedData);
        
    
        return redirect()->route('enquete.index')->with('success', 'Enquête créée avec succès!');
    }
    public function edit($id)
    {
        $enquete = Enquete::findOrFail($id); 
        return view('enquete.edit', compact('enquete')); 
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required|max:255',
            'description' => 'required',
            'images' => 'nullable|image', 
        ]);

        $enquete = Enquete::findOrFail($id); 
        $enquete->nom = $request->input('nom');
        $enquete->description = $request->input('description');

        if ($request->hasFile('images')) {
            $imagePath = $request->file('images')->store('public/images/enquetes');
            $enquete->images = basename($imagePath);
        }

        $enquete->save();

        return redirect()->route('enquete.index', $enquete->id)->with('success', 'Enquête modifiée avec succès.');
    }
    
public function index(Request $request)
{
    //dd('coucou');
    $user = Auth::user();
    $direction = $user->direction;
    $search = $request->get('search');
    $startDate = $request->get('start_date');
    $endDate = $request->get('end_date');
    
    $enquetes = Enquete::where('direction_id', $direction->id)
        ->when($search, function ($query, $search) {
            return $query->where('nom', 'like', "%$search%")
                         ->orWhere('description', 'like', "%$search%");
        })
        ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
            return $query->whereBetween('created_at', [$startDate, $endDate]);
        })
        ->paginate(10); 

    return view('enquete.index', compact('enquetes', 'direction', 'user'));
}



    public function destroy($id)
    {
        $enquetes = Enquete::findOrFail($id);
        if ($enquetes->direction_id != Auth::user()->direction_id) {
            return redirect()->back()->with('error', 'Vous n\'avez pas la permission de supprimer ce fichier.');
        }
        $enquetes->delete();
        return redirect()->back()->with('success', 'Fichier supprimé avec succès.');
    }
    public function showMicrodatas($id){
        $enquete = Enquete::findOrFail($id);
        $files = $enquete->files;
        $direction = auth()->user()->direction;
        $enquetes = Enquete::all();
        return view('enquete.show', compact('enquete', 'files', 'direction','enquetes'));
}
}
