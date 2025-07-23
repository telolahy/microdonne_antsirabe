<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Direction;
use App\Download;
use App\Enquete;
use App\Historique;
use App\User;
use App\Theme;
use App\DownloadToken;

class FileController extends Controller
{
    // Afficher le formulaire d'upload
    public function create(){
        $enquete = Enquete::all();
        return view('enquete.create', compact('enquete'));
}
public function store(Request $request)
{
    //dd('coucou');
    $request->validate([
        'file' => 'required|file',
        'description' => 'required|string|max:255',
       // 'theme_ids' => 'required|array', 
        'theme_ids' => 'required|array|min:1',
        'type' => 'required|in:sans_validation,avec_validation',  
        'enquete_id' => 'required|exists:enquetes,id' 
    ]);
    $originalName = $request->file('file')->getClientOriginalName();

    $filePath = $request->file('file')->storeAs('uploads', $originalName);

    $file = File::create([
        'file_name' => $originalName,
        'file_path' => $filePath,
        'status' => 'en_attente',
        'description' => $request->description,
        'user_id' => Auth::id(),
        'direction_id' => Auth::user()->direction_id,
        'type' => $request->type,  
        'enquete_id' => $request->enquete_id 
    ]);

    // Associer les thèmes
    $file->themes()->attach($request->theme_ids);
    
    // Mettre à jour chaque thème concerné
    foreach ($request->theme_ids as $themeId) {
        $theme = Theme::findOrFail($themeId);
        $theme->nouvelle_donnee = true;
        $theme->save();
    }

    $enquete = Enquete::findOrFail($request->enquete_id);
    $enquete->has_new_data = true;  
    $enquete->save();

    return back()->with('success', 'Fichier téléchargé avec succès!');
}
public function search(Request $request)
    {
        // Récupère la valeur de la recherche
        $search = $request->input('search');
        
        // Récupère les fichiers en fonction de la recherche
        // Supposons que tu as une table fichiers avec une colonne 'nom' ou 'description' où tu peux faire la recherche
        $fichiers = Fichier::where('nom', 'like', '%' . $search . '%')
                           ->orWhere('description', 'like', '%' . $search . '%')
                           ->get();

        // Passe les fichiers à la vue
        return view('front-office', compact('fichiers', 'search'));
    }


public function update(Request $request, $id)
{
    $request->validate([
        'file' => 'nullable|file|max:10240', 
        'description' => 'required',
        'type' => 'required|in:sans_validation,avec_validation', 
    ]);

    $fileRecord = File::findOrFail($id);

    if ($request->hasFile('file')) {
        Storage::delete($fileRecord->file_path);
        $file = $request->file('file');
        $fileName = $file->getClientOriginalName();
        $filePath = $file->storeAs('uploads', $fileName);

        $fileRecord->update([
            'file_name' => $fileName,
            'file_path' => $filePath,
        ]);
    }

    $fileRecord->update([
        'description' => $request->input('description'),
        'type' => $request->input('type'), 
    ]);
    $enqueteId = $fileRecord->enquete_id ?? null; 

    if (!$enqueteId) {
        return redirect()->route('files.index')->with('error', 'Impossible de rediriger : enquête introuvable.');
    }

    return redirect()->route('direction.show', [
        'directionId' => Auth::user()->direction_id,
        'enqueteId' => $enqueteId,
    ])->with('success', 'Fichier mis à jour avec succès.');
}


public function edit($id)
{
    $file = File::findOrFail($id);
    $direction = Auth::user()->direction; 
    return view('files.edit', compact('file', 'direction'));
}

    public function index()
    {
        $files = File::all();
        return view('files.index', compact('files'));
    }

    public function requestDownload(Request $request, File $file)
    {
       // dd($request->motif);
        /* $user = Auth::user();
        $direction = $user->direction ?? null;
        $isNew = $file->created_at > now()->subDays(7);
        return view('files.request-download', compact('file', 'direction', 'isNew')); */

        // Validation du formulaire
        $user = Auth::user();
        $validated = $request->validate([
            'motif' => 'required|string|min:5',
            'terms' => 'accepted',
        ]);
        
        $download = Download::create([
            'motif' => $request->motif,
            'file_id' => $file->id,
            'user_id' => $user->id,
            'status' => "valide",
        ]);

        // Enregistrement du téléchargement (ex: incrémenter un compteur)
        $file->increment('nombre');
        
        // Vérifie si le fichier existe
        $filePath = $file->file_path; // Ex: 'files/document.pdf'
        if (!Storage::exists($filePath)) {
            abort(404, 'Fichier introuvable.');
        }
        
        // Téléchargement immédiat
        return Storage::download($filePath, $file->file_name);

    }

    public function sendDownloadLink(Request $request, $fileId)
    {
        $request->validate([
            'email' => 'required|email' // Vérifie si l'email existe dans la table users
        ]);
        
        $file = File::findOrFail($fileId); // Vérifie que le fichier existe

        /* $user = User::where('email', $request->email)->first(); // Récupérer l'utilisateur
        if (!$user) {
            return back()->withErrors(['email' => 'L\'adresse e-mail n\'existe pas dans notre système. 
            Si l\'adresse e-mail est correcte, il se peut que vous deviez vous inscrire avec cette adresse e-mail.']);
        } */

        // Récupère l'utilisateur connecté
        $user = Auth::user();

        // Vérifie si l'email fourni correspond à celui de l'utilisateur connecté
        if ($request->email !== $user->email) {
            return back()->withErrors(['email' => 'L\'adresse fournie ne correspond pas à celle utilisée lors de votre inscription.']);
        }

        // Générer un token aléatoire
        $token = Str::random(40);

        // Enregistrer le token en base de données
        DownloadToken::create([
            'email' => $user->email,       
            'file_id' => $file->id,        
            'token' => $token,             
            'user_id' => $user->id,       
            'expires_at' => now()->addMinutes(30),
        ]);

        // Générer le lien de téléchargement
        $downloadLink = route('file.download', ['token' => $token]);

        // Envoyer l'email avec le lien
        Mail::send('emails.download-link', ['link' => $downloadLink], function ($message) use ($user) {
            $message->to($user->email)
                    ->subject('Votre lien de téléchargement');
        });

        return back()->with('success', 'Un lien de téléchargement a été envoyé à votre adresse e-mail.');
    }
    public function download($token)
    {
        $downloadToken = DownloadToken::where('token', $token)->first();
        
        // Vérification de la validité du token
        if (!$downloadToken || now()->greaterThan($downloadToken->expires_at)) {
            return redirect()->route('file.request', ['file' => $downloadToken->file_id]) 
                ->with('error', 'Le lien a expiré ou est invalide.');
        }
    
        // Récupérer le fichier correspondant au token
        $file = File::findOrFail($downloadToken->file_id);

        $file->increment('nombre');
    
        $historique = new Historique();
        $historique->user_id = auth()->id();
        $historique->file_id = $file->id;
        $historique->save();
    
        $filePath = storage_path("app/{$file->file_path}");
    
        // Optionnel : Supprimer le token après le téléchargement pour éviter les téléchargements multiples
        // $downloadToken->delete();
        return response()->download($filePath);
    }
    
    
    /* public function show(File $file)
    {
        $userId = Auth::check() ? Auth::id() : null;

        return response()->download(storage_path("app/{$file->file_path}"));
    } */
    

    public function telecharger($id)
    {
        $user = Auth::user();
        $file = File::findOrFail($id);
        $file->isdownload = 1; 
        $file->save(); 
        $path = storage_path('app/' . $file->file_path);
        
        $historique = Historique::create([
            'file_id' => $file->id,   
            'user_id' => $user->id,
        ]);
        if (!file_exists($path)) {
            return back()->with('error', 'Fichier introuvable.');
        }
        return response()->download($path, $file->file_name);
    }

    public function showfiledownload($fileId)
    { 
        //dd('coucou');
        $user = Auth::user();
        $direction = Direction::findOrFail($user->direction_id);  
        $file = File::findOrFail($fileId);
        $downloads = $file->downloads()->with('user', 'rapport')->orderBy('created_at', 'desc')->paginate(10);
        $countWaiting = $file->downloads()->where('status', 'en_attente')->count();
        $countRejected = $file->downloads()->where('status', 'rejete')->count();
        $countValidated = $file->downloads()->where('status', 'valide')->count();
        $totalDownloads = $countWaiting + $countRejected + $countValidated;
        return view('direction.listedownload', compact('downloads', 'file', 'direction', 'countWaiting', 'countRejected', 'countValidated', 'totalDownloads'));
    }
    public function publish($id)
{
        $file = File::findOrFail($id);
        $file->published = true; 
        $file->save();

    return redirect()->back()->with('success', 'Fichier publié avec succès !');
}
    public function unpublish($id) {
        $file = File::findOrFail($id);
        $file->published = 0; 
        $file->save();

    return redirect()->back()->with('alerte', 'Le fichier a été retiré.');
    }




    // Valider ou rejeter un fichier (pour l'admin)
    public function updateStatus(File $file, $status)
    {
        $file->update(['status' => $status]);

        return redirect()->route('files.index')->with('success', 'Le statut du fichier a été mis à jour.');
    }
    
    public function destroy($id)
    {
        // Trouver le fichier par son ID
        $file = File::findOrFail($id);

        // Vérifier si le fichier appartient à la direction de l'utilisateur connecté
        if ($file->direction_id != Auth::user()->direction_id) {
            return redirect()->back()->with('error', 'Vous n\'avez pas la permission de supprimer ce fichier.');
        }

        // Supprimer le fichier du serveur
        Storage::delete($file->file_path);

        // Supprimer le fichier de la base de données
        $file->delete();

        // Retourner à la page précédente avec un message de succès
        return redirect()->back()->with('success', 'Fichier supprimé avec succès.');
    }
}
