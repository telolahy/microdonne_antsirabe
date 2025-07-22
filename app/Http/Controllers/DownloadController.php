<?php

namespace App\Http\Controllers;

use App\File;
use App\Download;
use App\Direction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\DownloadValidatedNotification;

class DownloadController extends Controller
{
    public function demandeEnquetes(Request $request, $fileId)
    {
        dd('couocu');
        $request->validate([
            'motif' => 'nullable|string',
        ]); 

        $user = Auth::user();
        
        // Créer une nouvelle demande de téléchargement
        Download::create([
            'file_id' => $fileId,
            'user_id' => $user->id,
            'status' => 'en_attente',
            'motif' => $request->motif,
        ]);


        return back()->with('success', 'Votre demande de téléchargement a été envoyée.');
    }
    public function demandeThemes(Request $request, $fileId)
    {
        $request->validate([
            'motif' => 'required|string',
        ]); 

        $user = Auth::user();
        
        // Créer une nouvelle demande de téléchargement
        Download::create([
            'file_id' => $fileId,
            'user_id' => $user->id,   
            'status' => 'en_attente',
            'motif' => $request->motif,
        ]);


        return back()->with('success', 'Votre demande de téléchargement a été envoyée.');
    }
    public function demande(Request $request, $fileId)
{
    $request->validate([
        'motif' => 'required|string',
    ]); 

    if (!Auth::check()) {
        return back()->with('error', 'Vous devez être connecté pour faire une demande.');
    }

    $user = Auth::user();

    // Vérifier si l'utilisateur a déjà une demande en cours pour ce fichier
    $existingRequest = Download::where('file_id', $fileId)
                                ->where('user_id', $user->id)
                                ->first();

    if ($existingRequest) {
        return back()->with('error', 'Vous avez déjà une demande en cours pour ce fichier.');
    }

    // Créer une nouvelle demande de téléchargement
    Download::create([
        'file_id' => $fileId,
        'user_id' => $user->id,
        'status' => 'en_attente',
        'motif' => $request->motif,
    ]);

    return back()->with('success', 'Votre demande de téléchargement a été envoyée.');
}

     // Fonction pour valider le statut d'un téléchargement
     public function valider($id)
     {
         $download = Download::findOrFail($id);
         $download->status = 'valide';
         $download->validated_by = Auth::id();
         $download->save();
         $download->user->notify(new DownloadValidatedNotification($download));
         return redirect()->back()->with('success', 'Le téléchargement a été validé.');
     }

     public function rejeter($id)
     {
         $download = Download::findOrFail($id);
         $download->status = 'rejete';
         $download->validated_by = Auth::id();
         $download->save();
 
         return redirect()->back()->with('success', 'Le téléchargement a été rejeté.');
     }

     // Recherche
     public function search(Request $request, $fileId)
     {
         $user = Auth::user();
         $direction = Direction::findOrFail($user->direction_id);  
     
         // Vérifier que le fichier existe
         $file = File::findOrFail($fileId);
         
         // Récupérer la requête de recherche
         $query = $request->input('query');
     
         // Filtrer les téléchargements liés à ce fichier et appliquer le filtre de recherche
         $downloads = Download::where('file_id', $fileId)
             ->whereHas('user', function($q) use ($query) {
                 $q->where('name', 'LIKE', "%{$query}%")
                   ->orWhere('prenom', 'LIKE', "%{$query}%")
                   ->orWhere('email', 'LIKE', "%{$query}%")
                   ->orWhere('status', 'LIKE', "%{$query}%")
                   ->orWhere('entite', 'LIKE', "%{$query}%") 
                   ->orWhere('profession', 'LIKE', "%{$query}%")
                   ->orWhere('telephone', 'LIKE', "%{$query}%");
             })
             ->with('user', 'rapport') // Charger les relations
             ->get();
     
         // Retourner la vue avec les résultats filtrés
         return view('direction.listedownload', compact('downloads', 'direction', 'file'));
     }

    public function show(){
        $downloadsEnAttente = Download::where('status', 'en attente')->count();
        //avelako eo ihany aloh reto
        dd($downloadsEnAttente); 
        return view('direction.dashboard', compact('downloadsEnAttente'));
    }

    

    public function getDownloadsEnAttente(){
        $downloadsEnAttente = Download::where('status', 'en attente')->count();
        return response()->json(['downloadsEnAttente' => $downloadsEnAttente]);
}
public function validation() 
{
    $textes = Download::with(['demandeur', 'validateur'])->get();
      //view tsy miexiste
    return view('historique.validation', compact('textes'));
}

}
