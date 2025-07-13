<?php

namespace App\Http\Controllers;

use App\Download;
use App\Rapports;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RapportController extends Controller
{
    public function store(Request $request)
    {
        
        $user = Auth::user();
        $userDownload = Download::where('user_id', $user->id)->first();
        //dd($userDownload->id);

        $request->validate([
            'download_id' => 'nullable|exists:downloads,id',
            'file' => 'required|file',
        ]);
        //dd($request->all());
        $file = $request->file('file');
        $fileName = $file->getClientOriginalName(); 
        $filePath = $file->storeAs('rapports', $fileName, 'public'); 
        
        $rapport = Rapports::create([
            'path' => $filePath,
            'download_id' => $userDownload->id, 
        ]);
    
        return back()->with('success', 'Rapport ajouté avec succès.');
    }
    

    public function download(Rapports $rapport)
    {
        
        if (!Storage::disk('public')->exists($rapport->path)) {
            return redirect()->back()->with('error', 'Le rapport n\'existe pas.');
        }
        $filePath = storage_path("app/public/{$rapport->path}");
        $fileName = basename($filePath);  
    
        return response()->download($filePath, $fileName);
    }
    
    public function destroy($downloadId)
    {
        // Récupérer le rapport en base de données
        $download = Download::findOrFail($downloadId);

        // Vérifier que l'utilisateur authentifié est bien celui qui a ajouté le rapport
        if ($download->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Vous n\'avez pas l\'autorisation de supprimer ce rapport.');
        }

        // Décoder le JSON stocké en base de données pour récupérer le chemin du fichier
        $rapportData = json_decode($download->rapport, true);

        if ($rapportData && isset($rapportData['path'])) {
            $filePath = "public/" . $rapportData['path']; // Laravel utilise 'public/' pour Storage::disk('public')

            // Vérifier si le fichier existe dans le stockage et le supprimer
            if (Storage::disk('public')->exists($rapportData['path'])) {
                Storage::disk('public')->delete($rapportData['path']);
            }
        }

        // Supprimer l'entrée en base de données
        $download->delete();

        return redirect()->back()->with('success', 'Le rapport a été supprimé avec succès.');
    }


}
