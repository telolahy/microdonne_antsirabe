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

        .containerEnquete {
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

        .file-table-container {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            table-layout: fixed;
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 2px solid #ddd;
            word-wrap: break-word;
        }

        th {
            background-color: #333;
            color: white;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        td {
            max-width: 200px;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        td.description {
            max-width: 300px;
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

        .form-group label {
            font-weight: bold;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        .form-control-file {
            border: 1px solid #ddd;
            padding: 10px;
            margin: 5px 0;
        }

        .img-thumbnail {
            max-width: 100px;
            max-height: 100px;
            object-fit: cover;
            border-radius: 5px;
        }

        html, body {
            overflow-x: hidden;
        }

        @media screen and (max-width: 768px) {
            .file-table-container {
                overflow-x: auto;
            }

            html, body {
                overflow-x: auto;
            }
        } 
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <div class="containerEnquete"> 
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h6>Tableau de bord de la {{ $direction->name }}</h6>

            @if(Auth::user()->direction_id == $direction->id)
                <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#upload">
                    Créer enquête
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
            <form method="GET" action="{{ route('enquete.index', $direction->id) }}" class="d-flex mb-4">
                <input type="text" name="search" placeholder="nom d'utilisateur ou fichier" class="form-control mr-2" value="{{ request()->get('search') }}">
                <button type="submit" class="btn btn-dark">Rechercher</button>
            </form>
        </div>

        @if(Auth::user()->direction_id == $direction->id)
            @if($enquetes->isEmpty()) 
                <p>Aucune enquête pour cette direction.</p>
            @else
                <div class="file-table-container">
                    <table class="file-table">
                        <thead>
                            <tr>
                                <th>Images</th>
                                <th>Nom</th>
                                <th>Description</th>
                                <th>Direction</th>
                                <th>Date de création</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($enquetes as $enquete)
                                <tr>
                                    <td>
                                        @if($enquete->images)
                                            <img src="{{ asset('storage/images/enquetes/' . $enquete->images) }}" alt="Image" class="img-thumbnail">
                                        @else
                                            <span>Aucune image</span>
                                        @endif
                                    </td>
                                    <td>{{$enquete->nom}}</td>
                                    <td class="description">{{ Str::limit($enquete->description, 50, '...') }}</td>
                                    <td>{{$enquete->direction->name}}</td>
                                    <td>{{ $enquete->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        <div  class="d-flex align-items-center gap-2">
                                            <form action="{{ route('enquete.destroy', $enquete->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce fichier ?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger"><i class="fas fa-trash"></i></button>
                                            </form>
                                            &nbsp;
                                            &nbsp;
                                        
                                    
                                            <a href="{{ route('enquete.edit', $enquete->id) }}" class="btn btn-outline-primary"><i class="fas fa-edit"></i></a>
                                            &nbsp;
                                            &nbsp;
                                            <a href="{{ route('direction.show', ['directionId' => $direction->id, 'enqueteId' => $enquete->id]) }}" class="btn btn-outline-success"><i class="fas fa-plus"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-end mt-4">
                    {{ $enquetes->links() }}
                </div>
            @endif
        @else
            <p>Vous n'avez pas l'autorisation d'accéder à cette direction.</p>
        @endif
    </div>

    <!-- La fenêtre modale -->
    <div class="modal fade" id="upload" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadModalLabel">Créer une enquête</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('enquete.store') }}" method="POST" enctype="multipart/form-data">
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
                            <label for="images">Image</label>
                            <input type="file" name="images" id="images" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-dark">Ajouter</button>
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
