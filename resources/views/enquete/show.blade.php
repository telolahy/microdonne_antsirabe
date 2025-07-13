@extends('layouts.app')

@section('content')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Microdonnée - INSTAT</title>
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
            background-color: #f4f4f4; /* Orange Jaune */
            color: #333;
            text-align: center;
            padding: 0px;
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
            color:darkgoldenrod;
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
            background-color:darkgoldenrod; /* Orange Jaune style="color:darkgoldenrod" */ 
        }
        .action-form {
            display: inline-block;
            margin-left: 10px;
        }
        .status-waiting {
            background-color:darkgoldenrod;
            color: #fff;
            padding: 5px 10px;
            border-radius: 5px;
        }
        .badge {
            padding: 0.6em 1em; /* Augmentez le padding */
            border-radius: 0.25rem;
            font-size: 0.85em; /* Augmentez la taille de la police */
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
        .uper {
            margin-top: 40px;
        }

    </style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>


</head>
<body>
    <div class="container"> 
        <div class="d-flex justify-content-between align-items-center">
            <!-- Titre à gauche -->
            <h6>Tableau de bord de la {{ $direction->name }}</h6>

            <!-- Bouton en haut à droite -->
            @if(Auth::user()->direction_id == $direction->id)
                <button type="button" class="btn" data-toggle="modal" data-target="#uploadModal">
                    Upload un fichier
                </button>
            @endif
            </div>
            @if(Auth::user()->direction_id == $direction->id)
            <table class="file-table">
                <thead>
                    <tr>
                                <th>Noms des fichiers</th>
                                <th>Déscriptions</th>
                                <th>Demandes de téléchargement</th>
                                <th>Date d'upload</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if($files->isEmpty()) <!-- Vérifie si la collection est vide -->
                                    <p>Aucun fichier téléchargé pour cette enquete.</p>
                            @else
                            @foreach($files as $file)
                                <tr>
                                    <td>{{ $file->file_name }}</td>
                                    <td>{{ $file->description }}</td>
                                    <td>
                                        <a href="{{ route('files.downloads', $file->id) }}">Voir les téléchargements</a>
                                       
                                     
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-bell" style="font-size: 30px;"></i> 
                                            <!-- Notification Badge -->
                                            <span id="notification-count" class="badge badge-danger" style="border-radius: 50%; padding: 5px 10px; font-size: 14px;">
                                                0
                                            </span>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" id="notification-list">
                                            <!-- Les notifications seront ajoutées ici -->
                                        </div>
     
                                    </td>
                                    <td>{{ $file->created_at->format('d/m/Y') }}</td>
                                    <td style="display: flex;gap:5px"> 
                                        <div>
                                        <form action="{{ route('files.destroy', $file->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce fichier ?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Supprimer</button>
                                        </form>
                                        </div>
                                        <div>
                                        <form action="" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-danger">Publier</button>
                                        </form>
                                        </div>
                                     </td>
                                </tr>
                            @endforeach
                            @endif
                        </tbody>
                </table>
            @else
                <p>Vous n'avez pas l'autorisation d'accéder à cette direction.</p>
            @endif
            
        </div>
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
                        <label for="file">Choisir un fichier</label>
                        <input type="file" name="file" id="file" class="form-control" required>
                    </div>
                    <div class="form-group mb-2">
                            <label for="description">Description</label>
                            <textarea id="summernote" name="description" class="form-control" rows="4" required>{{ old('description') }} </textarea>
                    </div>
                    <select name="enquete_id" id="enquete_id" class="form-control" required>
                        @foreach($enquetes as $enquete)
                         @if($enquete)
                        <option value="{{ $enquete->id }}">{{ $enquete->nom }}</option>
                         @endif
                        @endforeach
                    </select>

                    <button type="submit" class="btn">Ajouter</button>
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
            $('#uploadModal').on('shown.bs.modal', function () {
                $('#file').trigger('focus')
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                placeholder: 'Entrez la description...',
                tabsize: 2,
                height: 200
            });
        });
    </script>
@endsection
