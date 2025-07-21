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
        .underline {
            width: 100%;
            height: 4px;
            background-color: rgb(22, 18, 4);
            margin-bottom: 30px;
        }
        .search-input {
            width: 300px;
            margin-right: 10px;
        }

        .close-search {
            position: absolute;
            font-size: 25px;
            margin-right: 140px;
        }

        .no-result {
            text-align: center;
            font-size: 28px;
            color: #888;
            margin-top: 15vh;
            padding-bottom: 15vh;
        }

        @media (max-width: 768px) {
            .search-input {
                width: 100%;
                margin-right: 0;
            }
            .file-table th, .file-table td {
                font-size: 0.9em;
            }
        }

        @media (max-width: 768px) {
            .file-table {
                border: 0;
                width: 100%;
            }

            .file-table thead {
                display: none;
            }

            .file-table tbody tr {
                display: block;
                margin-bottom: 1rem;
                border: 1px solid #ddd;
                border-radius: 10px;
                padding: 1rem;
                background-color: #fff;
                box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            }

            .file-table tbody td {
                display: flex;
                justify-content: space-between;
                padding: 0.5rem 0;
                border: none;
                border-bottom: 1px solid #eee;
            }

            .file-table tbody td:last-child {
                border-bottom: none;
            }

            .file-table tbody td::before {
                content: attr(data-label);
                font-weight: bold;
                color: #555;
                flex-basis: 40%;
            }

            .file-table tbody td:nth-child(3) {
                flex-direction: column;
            }

            .file-table img {
                max-width: 100px;
                height: auto;
                border-radius: 6px;
            }
        }

        @media (max-width: 600px) {
            .title-container .row:first-child {
                flex-direction: column;
                height: 80px;
            }
            .title-container .row:first-child > div {
                width: 100%;
                max-width: 100%;
                height: 50px !important;
                min-height: 10px !important;
            }
        }
    </style>
</head>

<body>
    <div class="containerTheme">

        <div class="container-fluid title-container">
            <div class="row">
                <div class="col-9">
                    <div class="d-flex justify-content-between align-items-center">
                        <h1><b>Tableau de bord de la {{ $direction->name }}</b></h1>
                    </div>
                </div>
                <div class="col">
                    <div class="d-flex justify-content-end align-items-center">
                        @if(Auth::user()->direction_id == $direction->id)
                            <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#upload" style="color: white">
                                Créer thème
                            </button>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col">
                    <form method="GET" action="{{ route('themes.index') }}" class="d-flex justify-content-end">
                        <input type="text" name="search" placeholder="Rechercher..." class="form-control mr-2 search-input" value="{{ request()->get('search') }}">

                        @if (isset($_GET['search']) && $_GET['search'] !== '')
                            <a href="{{ route('themes.index') }}" class="close-search"><i class="bi bi-x"></i></a>
                        @endif
                        
                        <button type="submit" class="btn btn-dark">Rechercher</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="underline mt-3 mb-3"></div>

        @if (isset($_GET['search']) && $_GET['search'] !== '')
            <div class="alert">
                <h5>Résultats de la recherche pour : <strong>{{ $_GET['search'] }}</strong></h5>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        @if(Auth::user()->direction_id == $direction->id)
            @if($themes->isEmpty())
                <div class="no-result">
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
                                <td data-label="Image">
                                    @if($theme->image)
                                        <img src="{{ asset('storage/images/themes/' . $theme->image) }}" alt="Image" class="img-thumbnail" style="max-width: 100px;">
                                    @else
                                        <span>Aucune image</span>
                                    @endif
                                </td>
                                <td data-label="Nom">{{ $theme->nom }}</td>
                                <td data-label="Descriptions">{{ $theme->description }}</td>
                                <td data-label="Direction">{{ $theme->direction->name }}</td>
                                <td data-label="Date de création">{{ $theme->created_at->format('d/m/Y') }}</td>
                                <td data-label="Actions">
                                    <div class="d-flex align-items-center gap-2 flex-wrap">
                                        <form action="{{ route('themes.destroy', $theme->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce fichier ?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                        <a href="{{ route('themes.edit', $theme->id) }}" class="btn btn-outline-primary btn-sm">
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
