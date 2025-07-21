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
            overflow-x: hidden;
        }
        .underline {
            width: 100%;
            height: 4px;
            background-color: rgb(22, 18, 4);
            margin-bottom: 30px;
        }
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: #333;
            z-index: 1000;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .margin-head:first-of-type {
            margin-top: 18vh; /* Adjust based on your navbar height */
        }
        .margin-head {
            margin-top: 5vh;
        }
        .containerListeDownload {
            background-color: #f4f4f4;
            color: #333;
            text-align: center;
            padding: 0px;
            margin-left: 10px; 
            min-height: 45vh; 
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
        @media (max-width: 1350px) {
            table thead {
                display: none;
            }

            table, table tbody, table tr, table td {
                display: block;
                width: 100%;
            }

            table tr {
                margin-bottom: 1rem;
                border: 1px solid #dee2e6;
                border-radius: 10px;
                padding: 10px;
                background-color: #f8f9fa;
            }

            table td {
                display: flex;
                justify-content: space-between;
                border: none;
                box-sizing: border-box;
            }

            table td::before {
                font-weight: bold;
                content: attr(data-label);
            }
        }
    </style>
</head>
<body>
<div class="containerListeDownload">
    <div class="margin-head"></div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-8">
                <h1>Utilisateurs ayant téléchargé le fichier:</h1>
            </div>
            <div class="col-12 col-lg-4">
                 @if(isset($file))
                    <form action="{{ route('downloads.search', ['file' => $file->id]) }}" method="GET" class="d-flex justify-content-end">
                        <input type="text" name="search" placeholder="Rechercher..." style="padding: 8px; border-radius: 5px; border: 1px solid #ccc;">
                        <button type="submit" class="btn" style="margin-left: 10px;">Chercher</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
    <div class="underline mt-3 mb-3"></div>

    @if (isset($_GET['search']) && $_GET['search'] !== '')
        <div class="alert">
            <h5>Résultats de la recherche pour : <strong>{{ $_GET['search'] }}</strong></h5>
        </div>
    @endif

    <div class="margin-head"></div>

    <div class="d-flex justify-content-center">
        <div style="gap: 10px;" class="d-flex flex-wrap justify-content-center">
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
                    <td data-label="Nom">{{ $download->user->name ?? 'Utilisateur inconnu' }}</td>
                    <td data-label="Prénom(s)">{{ $download->user->prenom ?? 'Utilisateur inconnu' }}</td>
                    <td data-label="Téléphone">{{ $download->user->telephone ?? 'Utilisateur inconnu' }}</td>
                    <td data-label="Email">{{ $download->user->email ?? 'Email inconnu' }}</td>
                    <td data-label="Profession">{{ $download->user->profession ?? 'Utilisateur inconnu' }}</td>
                    <td data-label="Entité">{{ $download->user->entite ?? 'Utilisateur inconnu' }}</td>
                    <td data-label="Motifs de la demande">{{ $download->motif ?? 'Aucun motif' }}</td>
                    <td data-label="Date du téléchargement">{{ $download->created_at->format('d/m/Y H:i') }}</td>
                    <td data-label="Status">
                        <span class="badge 
                            @if($download->status === 'en_attente') badge-secondary 
                            @elseif($download->status === 'rejete') btn-danger 
                            @elseif($download->status === 'valide') btn-success 
                            @endif">
                            {{ ucfirst($download->status) }}
                        </span>
                    </td>
                    <td data-label="Action"> 
                        <div class="btn-group" role="group">
                            <form action="{{ route('downloads.valider', $download->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-success me-1">Valider</button>
                            </form>
                            <form action="{{ route('downloads.rejeter', $download->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-danger">Rejeter</button>
                            </form>
                        </div>
                    </td>
                    <td data-label="Rapport">
                        @if (!empty($download->rapport) && isset(json_decode($download->rapport, true)['path']))
                            <a href="{{ route('rapports.download', json_decode($download->rapport, true)['id']) }}" class="btn btn-primary">
                                Télécharger
                            </a>
                        @else
                            <span class="text-muted">Aucun rapport disponible</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- <table class="table">
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
    </table> --}}
    <div class="d-flex justify-content-end mt-4">
        {{ $downloads->links() }}
    </div>
</div>
</body>
@endsection
