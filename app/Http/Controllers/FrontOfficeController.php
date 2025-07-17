<?php

namespace App\Http\Controllers;

use App\Download;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\File;
use App\Theme;
use App\Enquete;
use App\Historique;

class FrontOfficeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); 
    }

    public function index(Request $request)
    {
        $themeId = $request->input('theme_id');
        $search = $request->input('search');

        $themes = Theme::when($search, function ($query) use ($search) {
            $query->where(function ($query) use ($search) {
                $query->where('nom', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%')
                    ->orWhereHas('files', function ($q) use ($search) {
                        $q->where('file_name', 'like', '%' . $search . '%');
                    });
            });
        })
        ->has('files') //condition pour ne retourner que les thèmes avec des fichiers
        ->orderBy('nom')
        ->paginate(8);
 
        //dd($themes);
        $files = File::when($themeId, function ($query, $themeId) {
                return $query->whereHas('themes', function ($q) use ($themeId) {
                    $q->where('themes.id', $themeId);
                });
            })
            ->with('themes', 'downloads') 
            ->when($search, function ($query) use ($search) {
                return $query->where('file_name', 'like', '%' . $search . '%');
            })
            ->get(); 
    
        return view('front-office', compact('files', 'themes', 'search'));
    }

    public function frontsearch(Request $request, $fileId)
    {
        $user = Auth::user(); 
        
        // Vérifier que le fichier existe
        $file = File::findOrFail($fileId);
        
        // Récupérer la requête de recherche
        $searchQuery = $request->input('query');
        
        $files = File::where('file_name', 'LIKE', "%{$searchQuery}%")->get();

        $downloads = Download::whereHas('user', function($q) use ($searchQuery) {
            $q->where('status', 'LIKE', "%{$searchQuery}%");
        })
        ->with('user', 'rapport')
        ->get();
    
        
        // Récupérer la direction de l'utilisateur
        $direction = $user->direction ? $user->direction : null;
        
        // Retourner la vue avec les résultats filtrés
        return view('front-office', compact('files', 'file', 'user', 'direction', 'downloads'));
    }
    
    public function showEnquetes(Request $request)
    {
       // dd('coucou');
        $user = Auth::user();
        $search = $request->input('search'); 
    
        $enquetes = Enquete::query();

        if ($search) {
            $enquetes = $enquetes->where(function ($query) use ($search) {
                $query->where('nom', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%')
                    ->orWhereHas('files', function ($q) use ($search) {
                        $q->where('file_name', 'like', '%' . $search . '%');
                    });
            });
        }

        $enquetes = $enquetes->orderBy('nom')->paginate(8, ['*'], 'enquetes_page');

    
        $fichiers = null;  
        $userDownload = Download::where('user_id', $user->id)->first(); 
    
        return view('frontOffice.enquetes', compact('enquetes', 'fichiers', 'userDownload', 'search'));
    }
    

    public function showFichiers($enqueteId = null)
{
    $user = Auth::user();
    $enquetes = Enquete::paginate(8);

    $fichiers = collect(); 
    if ($enqueteId) {
        $enquete = Enquete::findOrFail($enqueteId);

        $fichiers = File::where('enquete_id', $enqueteId)
                        ->where('published', 1)
                        ->paginate(2, ['*'], 'fichiers_page');

        foreach ($fichiers as $fichier) {
            $demande = $fichier->demandes()->where('user_id', auth()->id())->latest()->first();
            $fichier->demande_statut = $demande ? $demande->statut : null;
        }
    }

    $userDownload = Download::where('user_id', $user->id)->first(); 

    return view('frontOffice.enquetes', compact('enquetes', 'fichiers', 'userDownload'));
}
public function showFichiersParTheme($themeId, Request $request)
{
    $user = Auth::user();
    $search = $request->input('search');

    $theme = Theme::findOrFail($themeId);

    $themesQuery = Theme::with(['files' => function($query) use ($themeId) {
        $query->where('theme_id', $themeId)->where('published', 1);
    }]);

    if ($search) {
        $themesQuery = $themesQuery->where(function ($query) use ($search) {
            $query->where('nom', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%')
                  ->orWhereHas('files', function ($q) use ($search) {
                      $q->where('file_name', 'like', '%' . $search . '%');
                  });
        });
    }
    $themes = $themesQuery->paginate(8);
    $fichiers = $theme->files()->where('published', 1)->paginate(5, ['*'], 'fichiers_page');;
    foreach ($fichiers as $fichier) {
        $demande = $fichier->demandes()->where('user_id', auth()->id())->latest()->first();
        $fichier->demande_statut = $demande ? $demande->statut : null;
    }
    $userDownload = Download::where('user_id', $user->id)->first(); 
    return view('front-office', compact('themes', 'fichiers', 'userDownload', 'search', 'themeId'));
}


public function showThemes()
    {
        $themes = Theme::all();
        $fichiers = null;
    }

public function afficherHistorique(){
    $userId = Auth::id(); 

    $historiques = Historique::where('historiques.user_id', $userId)
        ->join('files', 'historiques.file_id', '=', 'files.id') 
        ->select('historiques.*', 'files.file_name')
        ->orderBy('historiques.created_at', 'desc')
        ->get();

    return view('frontOffice.historique', compact('historiques'));
}

  
}
