@extends('layouts.app')

@section('content')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Microdonnées INSTAT Madagascar</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            font-size: 12px;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            background-color: #f4f4f4;
            color: #333;
            text-align: center;
            padding: 0px;
            margin-left: 10px; 
            min-height: 100vh; 
        }
        h1 {
            font-size: 2.5em;
            margin: 0;
        }
        p {
            font-size: 1.2em;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 2px solid #ddd;
        }
        th {
            background-color: #333;
            color: white;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        a {
            color: darkgoldenrod;
            text-decoration: none;
            font-weight: bold;
        }
        a:hover {
            text-decoration: underline;
        }
        .btn {
            padding: 8px 15px;
            font-size: 12px;
            background-color: #333;
            color: white;
            border: none;
            cursor: pointer;
            font-weight: bold;
        }
        .btn:hover {
            background-color:darkgoldenrod;
        }
        .badge {
            padding: 0.6em 1em;
            border-radius: 0.25rem;
            font-size: 0.85em;
        }
        .btn-success {
            background-color: #28a745;
            color: white;
        }
        .badge-info {
            background-color: #17a2b8;
            color: white;
        }
        .btn-danger {
            background-color: #dc3545;
            color: white;
        }
        .badge-secondary {
            background-color: #6c757d;
            color: white;
        }
        html, body {
            overflow: hidden;
        }
    </style>
</head>
<body>
<div class="container">
    <div style="display: flex; align-items: center; justify-content: space-between;">
        <h6>Utilisateurs ayant téléchargé le fichier :</h6>
        <div style="display: flex; gap: 10px;">
            <div style="background-color:white; color: black; padding: 10px; border-radius: 5px;">
                <p style="margin: 0;">En attente : {{ $countWaiting }}</p>
            </div>
            <div style="background-color: white; color: black; padding: 10px; border-radius: 5px;">
                <p style="margin: 0;">Validés : {{ $countValidated }}</p>
            </div>
            <div style="background-color: white; color: black; padding: 10px; border-radius: 5px;">
                <p style="margin: 0;">Rejetés : {{ $countRejected }}</p>
            </div>
            <div style="background-color: white; color: black; padding: 10px; border-radius: 5px;">
                <p style="margin: 0;">Total : {{ $totalDownloads }}</p>
            </div>
        </div>
        @if(isset($file))
            <form action="{{ route('downloads.search', ['file' => $file->id]) }}" method="GET">
                <input type="text" name="query" placeholder="Rechercher..." style="padding: 8px; border-radius: 5px; border: 1px solid #ccc;">
                <button type="submit" class="btn" style="margin-left: 10px;">Chercher</button>
            </form>
        @endif
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom(s)</th>
                <th>Téléphone</th>
                <th>Email</th>
                <th>Profession</th>
                <th>Entité</th>
                <th>Motifs de la demande</th>
                <th>Date du téléchargement</th>
                <th>Status</th>
                <th>Action</th>
                <th>Rapport</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($downloads as $download)
                <tr>
                    <td>{{ $download->user->name ?? 'Utilisateur inconnu' }}</td>
                    <td>{{ $download->user->prenom ?? 'Utilisateur inconnu' }}</td>
                    <td>{{ $download->user->telephone ?? 'Utilisateur inconnu' }}</td>
                    <td>{{ $download->user->email ?? 'Email inconnu' }}</td>
                    <td>{{ $download->user->profession ?? 'Utilisateur inconnu' }}</td>
                    <td>{{ $download->user->entite ?? 'Utilisateur inconnu' }}</td>
                    <td>{{ $download->motif ?? 'Aucun motif' }}</td>
                    <td>{{ $download->created_at->format('d/m/Y H:i') }}</td>

                    <td>
                        <span class="badge 
                            @if($download->status === 'en_attente') badge-secondary 
                            @elseif($download->status === 'rejete') btn-danger 
                            @elseif($download->status === 'valide') btn-success 
                            @endif">
                            {{ ucfirst($download->status) }}
                        </span>
                    </td>

                    <td> 
                        <div class="btn-group" role="group">
                            <form action="{{ route('downloads.valider', $download->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-success" style="margin-right: 10px;">Valider</button>
                            </form>

                            <form action="{{ route('downloads.rejeter', $download->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-danger">Rejeter</button>
                            </form>
                        </div>
                    </td>
                    <td>
                        @if (!empty($download->rapport) && isset(json_decode($download->rapport, true)['path']))
                            <a href="{{ route('rapports.download', json_decode($download->rapport, true)['id']) }}" class="btn btn-primary">
                                Télécharger le rapport
                            </a>
                        @else
                            <span class="text-muted">Aucun rapport disponible</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-end mt-4">
        {{ $downloads->links() }}
    </div>
</div>
</body>
@endsection
