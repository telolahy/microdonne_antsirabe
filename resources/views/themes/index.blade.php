@extends('layouts.app')

@section('content')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Microdonnées INSTAT Madagascar</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            font-size: 12px;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .containerTheme {
            background-color: #f4f4f4;
            color: #333;
            text-align: center;
            padding: 0px;
            margin-left: 0px; 
            margin-top: 0px;
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
        html, body {
            overflow-y: auto;
            overflow-x: hidden;
        }

        .no-results {
            text-align: center;
            padding: 20px;
            background-color: #f8d7da;
            color: #721c24;
            font-weight: bold;
            border-radius: 5px;
        }
        .img-thumbnail {
            max-width: 100px;
            max-height: 100px;
            object-fit: contain;
        }
        body {
            margin-top: 150px;
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
    </style>
</head>

<body>
    <div class="containerTheme">
        <div class="d-flex justify-content-between align-items-center">
            <h6>Tableau de bord de la {{ $direction->name }}</h6>
            @if(Auth::user()->direction_id == $direction->id)
                <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#upload" style="color: white">
                    Créer
                </button>
            @endif
        </div>
        @if ($errors->any())
            <div class="alert alert-danger mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="d-flex justify-content-between align-items-center">
            <form method="GET" action="{{ route('themes.index') }}" class="d-flex mb-4">
                <input type="text" name="search" placeholder="Rechercher..." class="form-control mr-2" value="{{ request()->get('search') }}">
                <button type="submit" class="btn btn-dark">Rechercher</button>
            </form>
        </div>
        @if(Auth::user()->direction_id == $direction->id)
            @if($themes->isEmpty())
                <div class="no-results">
                    Aucun résultat correspondant à votre recherche.
                </div>
            @else
                <table class="file-table">
                    <thead>
                        <tr>
                            <th>Images</th>
                            <th>Nom</th>
                            <th>Déscriptions</th>
                            <th>Direction</th>
                            <th>Date de création</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($themes as $theme)
                            <tr>
                                <td>
                                    @if($theme->image)
                                        <img src="{{ asset('storage/images/themes/' . $theme->image) }}" alt="Image" class="img-thumbnail" style="width:">
                                    @else
                                        <span>Aucune image</span>
                                    @endif
                                </td>
                                <td>{{ $theme->nom }}</td>
                                <td>{{ $theme->description }}</td>
                                <td>{{ $theme->direction->name }}</td>
                                <td>{{ $theme->created_at->format('d/m/Y') }}</td>
                                <td>
                                <div class="d-flex align-items-center gap-2">
                                    <form action="{{ route('themes.destroy', $theme->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce fichier ?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                    &nbsp;
                                    &nbsp;

                                        <a href="{{ route('themes.edit', $theme->id) }}" class="btn btn-outline-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </div>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-end mt-4">
                    {{ $themes->links() }}
                </div>
            @endif
        @else
            <p>Vous n'avez pas l'autorisation d'accéder à cette direction.</p>
        @endif
    </div>

    <div class="modal fade" id="upload" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadModalLabel">Thèmes</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('themes.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="nom">Nom</label>
                            <input name="nom" id="nom" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" class="form-control" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" name="image" id="image" class="form-control" accept="image/*">
                        </div>
                        <button type="submit" class="btn btn-success">Ajouter</button>
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
@endsection
