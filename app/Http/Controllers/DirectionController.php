<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Direction;
use App\File;
use App\Theme;
use App\Enquete;
use App\Download;
class DirectionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');  // Assurez-vous que l'utilisateur est authentifié
    }

    public function index()
    {
        $user = Auth::user();
        if ($user->isDirection()) {
            return redirect()->route('direction.show', ['directionId' => $user->direction_id]);
        }
        return redirect()->route('front-office');
    }

    public function show($directionId, $enqueteId)
    {
        $user = Auth::user();
        if ($user->direction_id == $directionId) {
            $direction = Direction::findOrFail($directionId);
            $enquete = Enquete::where('id', $enqueteId)->where('direction_id', $directionId)->first();
            $files = $direction->files()->where('enquete_id', $enqueteId)->paginate(5); 

            $themes = Theme::all();
            
            $downloadsEnAttente = Download::where('status', 'en_attente')->with('user')->get();
            $downloadsEnAttenteByFile = [];

            foreach ($downloadsEnAttente as $download) {
                if (!isset($downloadsEnAttenteByFile[$download->file_id])) {
                    $downloadsEnAttenteByFile[$download->file_id] = [];
                }
                $downloadsEnAttenteByFile[$download->file_id][] = $download;
            }
    
            return view('direction.dashboard', compact('direction', 'files', 'themes', 'enquete', 'downloadsEnAttenteByFile'));
        }
    
        return redirect()->route('home')->with('error', 'Vous n\'avez pas l\'autorisation d\'accéder à cette direction.');
    }
    
    
    public function getDownloadsEnAttente(){
        $downloadsEnAttente = Download::where('status', 'en attente')->get();
        $downloadsEnAttenteByFile = [];
        foreach ($downloadsEnAttente as $download) {
            if (!isset($downloadsEnAttenteByFile[$download->file_id])) {
                $downloadsEnAttenteByFile[$download->file_id] = 0;
            }
            $downloadsEnAttenteByFile[$download->file_id]++;
        }
        return response()->json(['downloadsEnAttenteByFile' => $downloadsEnAttenteByFile]);
    }


    public function showUploadForm($directionId)
    { 
        $files = File::all();  
        $direction = Direction::find($directionId); 
        return view('direction.upload', compact('direction', 'files'));
    }

    public function uploadFile(Request $request)
    {
        $file = $request->file('file');
        $fileName = time() . '.' . $file->getClientOriginalExtension();

        // Spécifier le chemin du dossier où le fichier sera stocké
        $destinationPath = public_path('uploads'); 

        // Vérifier si le dossier existe, sinon le créer
        if (!File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0777, true);  // Créer le dossier si nécessaire
        }

        // Déplacer le fichier vers le répertoire spécifié
        $file->move($destinationPath, $fileName);

        return back()->with('success', 'Fichier téléchargé avec succès !');
    }
}
