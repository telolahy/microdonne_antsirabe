<?php

namespace App\Http\Controllers;

use App\File;
use App\Download;
use App\Historique;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EnregistrementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($file_id)
    {
        $file = File::findOrFail($file_id);
        return view('download.download',compact('file_id', 'file'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
           // Validation du formulaire
        $id = $request->file_id;
        $user = Auth::user();
        $file = File::findOrFail($id);
        $validated = $request->validate([
            'motif' => 'required|string|min:5',
            'terms' => 'accepted',
            'file_id' => 'required',
        ]);
        
        $download = Download::create([
            'motif' => $request->motif,
            'file_id' => $request->file_id,   
            'user_id' => $user->id,
            'status' => "valide",
        ]);

        $historique = Historique::create([
            'file_id' => $request->file_id,   
            'user_id' => $user->id,
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
