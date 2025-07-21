<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Historique;
use App\File;
use App\Download;
class HistoriqueController extends Controller
{

    public function show(Request $request)
    {
        // Récupération des historiques
        $query = Historique::with('user', 'file')->whereNotNull('file_id');
    
        // Recherche dans les historiques
        if ($request->has('search') && $request->search != '') {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->whereHas('user', function ($query) use ($searchTerm) {
                    $query->where('name', 'like', '%' . $searchTerm . '%');
                })
                ->orWhereHas('file', function ($query) use ($searchTerm) {
                    $query->where('file_name', 'like', '%' . $searchTerm . '%');
                });
            });
        }
    
        // Recherche par date pour les historiques
        if ($request->filled('date_debut') && $request->filled('date_fin')) {
            $query->whereBetween('created_at', [$request->date_debut, $request->date_fin]);
        }
    
        $historiques = $query->orderBy('created_at', 'desc')->paginate(5, ['*'], 'historiques_page');
    
        // Récupération des downloads
        $downloadsQuery = Download::with(['file', 'demandeur', 'validateur'])
            ->whereIn('status', ['valide', 'rejete'])
            ->orderBy('updated_at', 'desc');
    
        // Recherche dans les downloads
        if ($request->has('search') && $request->search != '') {
            $downloadsQuery->where(function ($q) use ($searchTerm) {
                $q->whereHas('file', function ($query) use ($searchTerm) {
                    $query->where('file_name', 'like', '%' . $searchTerm . '%');
                })
                ->orWhereHas('demandeur', function ($query) use ($searchTerm) {
                    $query->where('name', 'like', '%' . $searchTerm . '%');
                })
                ->orWhereHas('validateur', function ($query) use ($searchTerm) {
                    $query->where('name', 'like', '%' . $searchTerm . '%');
                });
            });
        }
    
        // Recherche par date pour les downloads
        if ($request->filled('date_debut') && $request->filled('date_fin')) {
            $downloadsQuery->whereBetween('updated_at', [$request->date_debut, $request->date_fin]);
        }
    
        
        $downloads = $downloadsQuery->paginate(5, ['*'], 'downloads_page');
    
        return view('historique.index', compact('historiques', 'downloads'));
    }

    public function notif(Request $request)
    {
        $downloadsQuery = Download::with(['demandeur', 'file'])
            ->where('status', 'en_attente')
            ->whereHas('file', function ($query) use ($request) {
                // Restrict downloads to those where the file's direction_id matches the authenticated user's direction_id
                $query->where('direction_id', auth()->user()->direction_id);
            })
            ->orderBy('updated_at', 'desc');

        if ($request->has('user_id') && $request->user_id != '') {
            $downloadsQuery->where('user_id', $request->user_id);
        }

        if ($request->has('file_id') && $request->file_id != '') {
            $downloadsQuery->where('file_id', $request->file_id);
        }

        $downloads = $downloadsQuery->paginate(5);


       // dd($downloads->find(157)->file());
    
        return view('notification.index', compact('downloads'));
    }
     
}
