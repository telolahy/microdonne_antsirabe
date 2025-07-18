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
            margin-left: 0px;
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
        .action-form {
            display: inline-block;
            margin-left: 10px;
        }
        .status-waiting {
            background-color: darkgoldenrod;
            color: #fff;
            padding: 5px 10px;
            border-radius: 5px;
        }
        .badge {
            padding: 0.6em 1em; 
            border-radius: 0.25rem;
            font-size: 0.85em; 
        }
        .badge-success {
            background-color: #28a745;
            color: white;
        }
        .badge-info {
            background-color: #17a2b8;
            color: white;
        }
        .badge-danger {
            background-color: #dc3545;
            color: white;
        }
        .badge-secondary {
            background-color: #6c757d;
            color: white;
        }
        .lien{
            color: black;
        }
        #bouton{
            display: flex;
            gap: 5px;
        }
        html, body {
            overflow: hidden;
        }

    </style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

</head>
<body>
    <div class="container"> 
        <div class="d-flex justify-content-between align-items-center">
            <h6>Tableau de bord de la {{ $direction->name }}</h6>

            @if(Auth::user()->direction_id == $direction->id)
            <div style="display: flex; gap:5px">
                <div>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#uploadModal">
                        Upload un fichier
                    </button>
                </div>
            </div>
            @endif
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if(Auth::user()->direction_id == $direction->id)
            @if($files->isEmpty()) 
                <p>Aucun fichier téléchargé pour cette direction.</p>
            @else
                <table class="file-table">
                    <thead>
                        <tr>
                            <th>Noms des fichiers</th>
                            <th>Déscriptions</th>
                            <th>Type de validation</th>
                            <th>Themes associés</th>
                            <th>Ajouté par</th>
                            <th>Demandes de téléchargement</th>
                            <th>Date d'upload</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($files as $file)
                            <tr>
                                <td>{{ $file->file_name }}</td>
                                <td>{{ $file->description }}</td>
                                <td>{{ $file->type}}</td>
                                <td>
                                    @foreach($file->themes as $theme)
                                        <span class="badge badge-info">{{ $theme->nom }}</span>
                                    @endforeach
                                </td>
                                <td>{{ optional($file->user)->name }} {{ optional($file->user)->prenom }} </td>

                                <td>
                                    <a href="{{ route('files.downloads', $file->id) }}">Voir les téléchargements</a>&nbsp
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

    <span class="fas fa-bell" style="font-size: 25px; position: relative;">
        <span class="notification-count" style="position: absolute; top: -5px; right: -10px; background-color: red; color: white; border-radius: 50%; padding: 3px 7px; font-size: 12px;">
         {{ count($downloadsEnAttenteByFile[$file->id] ?? []) }}
        </span>
    </span>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" id="notification-list">
                                        @foreach($downloadsEnAttenteByFile[$file->id] ?? [] as $download)
                                            <a class="dropdown-item" href="#">
                                                {{ $download->user->name }} ({{ $download->created_at->format('d/m/Y H:i') }})
                                            </a>
                                        @endforeach
                                    </div>
                                </td>
                                <td>{{ $file->created_at->format('d/m/Y') }}</td>
                                <td> 
                                <div  class="d-flex align-items-center gap-2">

            <form action="{{ route('files.destroy', $file->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce fichier ?');" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger" title="Supprimer">
                    <i class="fas fa-trash-alt"></i>
                </button>
            </form>                                            &nbsp;
            &nbsp;

        
        
            <a href="{{ route('files.edit', $file->id) }}" class="btn btn-outline-primary" title="Modifier">
                <i class="fas fa-edit"></i>
            </a>
            &nbsp;
            &nbsp;

        @if($file->published == 0)
            <form action="{{ route('files.publish', $file->id) }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="btn btn-outline-success" title="Publier">
                    Publier
                </button>
            </form>                                            &nbsp;
            &nbsp;

        @else
        
        <form action="{{ route('files.unpublish', $file->id) }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="btn btn-outline-warning" title="Retirer">
                    Retirer
                </button>
            </form>
        @endif
    </div>
</td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-end mt-4">
                    {{ $files->links() }}
                </div>
                

            @endif
        @else
            <p>Vous n'avez pas l'autorisation d'accéder à cette direction.</p>
        @endif
    </div>

    <!-- La fenêtre modale -->
    <div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadModalLabel">Uploader un fichier</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Formulaire de téléchargement -->
                    <form action="{{ route('files.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="theme_ids">Choisir un ou plusieurs thèmes</label>
                            <select name="theme_ids[]" class="form-control" multiple>
                                @foreach($themes as $theme)
                                    <option value="{{ $theme->id }}">{{ $theme->nom }}</option>
                                @endforeach
                            </select>
                             @error('theme_ids')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                           
                        <div class="form-group">
                        <label for="enquete_id">Choisir une enquete</label>
                        <select name="enquete_id" class="form-control">
                            <option value="{{ $enquete->id }}">{{ $enquete->nom }}</option>
                        </select>
                        </div>

                        <div class="form-group">
                            <label for="file">Choisir un fichier</label>
                            <input type="file" name="file" id="file" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" class="form-control" rows="4" required></textarea>
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                        </div>

                        <div class="form-group">
                            <label for="type">Type</label>
                            <select name="type" id="type" class="form-control" required>
                                <option value="sans_validation">Sans validation</option>
                                <option value="avec_validation">Avec validation</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Ajouter</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

</body>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $.get('/downloads-en-attente', function(data) {
            console.log(data);
            for (const [fileId, count] of Object.entries(data.downloadsEnAttenteByFile)) {
                $('#notification-count-' + fileId).text(count);
            }
        });

        // Rafraîchir les badges toutes les 10 secondes
        setInterval(function() {
            $.get('/downloads-en-attente', function(data) {
                for (const [fileId, count] of Object.entries(data.downloadsEnAttenteByFile)) {
                    $('#notification-count-' + fileId).text(count);
                }
            });
        }, 10000);
    });
</script>
@endsection
