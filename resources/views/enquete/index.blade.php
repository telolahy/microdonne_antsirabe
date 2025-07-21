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
            margin-top: 150px;
        }

        .file-table td:nth-child(5), .file-table th:nth-child(5) {
            width: 130px;
            max-width: 130px;
            white-space: nowrap;
        }

        .file-table td:nth-child(6), .file-table th:nth-child(6) {
            width: 220px;
            max-width: 220px;
            white-space: nowrap;
        }

        .file-table td:nth-child(4), .file-table th:nth-child(4) {
            width: 100px;
            max-width: 100px;
        }

        .file-table td:nth-child(1), .file-table th:nth-child(1) {
            width: 100px;
            max-width: 100px;
            white-space: nowrap;
        }

        .file-table td:nth-child(2), .file-table th:nth-child(2) {
            width: 100px;
            max-width: 100px;
            white-space: nowrap;
        }
        .file-table td:nth-child(3), .file-table th:nth-child(3) {
            min-width: 220px;
            max-width: 220px;
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
            width: 100%;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* td.description {
            max-width: 300px;
        } */

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

        .close-search {
            position: absolute;
            font-size: 25px;
            margin-top: 5px;
            margin-right: 140px;
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

        .search-input {
            width: 300px;
            margin: 0 10px 0 0 !important;
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
            .responsive-table thead {
                display: none;
            }

            .file-table tbody td:nth-child(3) {
                width: 100%!important;
                flex-direction: column;
                align-items: flex-start;
            }
            
            .responsive-table tbody tr {
                display: block;
                margin-bottom: 1rem;
                border: 1px solid #ddd;
                border-radius: 10px;
                padding: 1rem;
                background-color: #fff;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            }

            .responsive-table tbody td {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 8px 0;
                border: none;
                border-bottom: 1px solid #f1f1f1;
                text-align: right; /* Ajout pour aligner la valeur à droite */
            }

            .responsive-table tbody td:last-child {
                border-bottom: none;
            }

            .responsive-table tbody td::before {
                content: attr(data-label);
                font-weight: bold;
                flex-basis: 50%;
                text-align: left;
            }

            .responsive-table .img-thumbnail {
                width: 100px;
                height: auto;
            }

            .file-table td:nth-child(5), .file-table th:nth-child(5) {
                width: 100%;
                max-width: 100%;
                white-space: nowrap;
            }

            .file-table td:nth-child(6), .file-table th:nth-child(6) {
                width: 100%;
                max-width: 100%;
                white-space: nowrap;
            }
            .file-table td:nth-child(1), .file-table th:nth-child(1) {
                width: 100%;
                max-width: 100%;
                white-space: nowrap;
            }
            .file-table td:nth-child(2), .file-table th:nth-child(2) {
                width: 100%;
                max-width: 100%;
                white-space: nowrap;
            }
            .file-table td:nth-child(3), .file-table th:nth-child(3) {
                width: 100%;
                max-width: 100%;
                white-space: nowrap;
            }
            .file-table td:nth-child(4), .file-table th:nth-child(4) {
                width: 100%;
                max-width: 100%;
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <div class="containerEnquete"> 
        <div class="container-fluid title-container">
            <div class="row">
                <div class="col-9">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2><b>Tableau de bord de la {{ $direction->name }}</b></h2>
                    </div>
                </div>
                <div class="col">
                    <div class="d-flex justify-content-end align-items-center">
                        @if(Auth::user()->direction_id == $direction->id)
                            <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#upload" style="color: white">
                                Créer enquête
                            </button>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col">
                    <form method="GET" action="{{ route('enquete.index') }}" class="d-flex justify-content-end">
                        <input type="text" name="search" placeholder="Rechercher..." class="form-control mr-2 search-input" value="{{ request()->get('search') }}">

                        @if (isset($_GET['search']) && $_GET['search'] !== '')
                            <a href="{{ route('enquete.index') }}" class="close-search"><i class="bi bi-x"></i></a>
                        @endif
                        
                        <button type="submit" class="btn btn-dark">Rechercher</button>
                    </form>
                </div>
            </div>
        </div>

        @if(Auth::user()->direction_id == $direction->id)
            @if($enquetes->isEmpty()) 
                <p>Aucune enquête pour cette direction.</p>
            @else
                <div class="file-table-container">
                    <table class="file-table responsive-table">

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
                                    <td data-label="Image">
                                        @if($enquete->images)
                                            <img src="{{ asset('storage/images/enquetes/' . $enquete->images) }}" alt="Image" class="img-thumbnail">
                                        @else
                                            <span>Aucune image</span>
                                        @endif
                                    </td>
                                    <td data-label="Nom">{{ $enquete->nom }}</td>
                                    <td data-label="Description" class="description">{{ Str::limit($enquete->description, 50, '...') }}</td>
                                    <td data-label="Direction">{{ $enquete->direction->name }}</td>
                                    <td data-label="Date de création">{{ $enquete->created_at->format('d/m/Y') }}</td>
                                    <td data-label="Actions">
                                        <div class="d-flex align-items-center gap-2">
                                            <form action="{{ route('enquete.destroy', $enquete->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce fichier ?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger"><i class="fas fa-trash"></i></button>
                                            </form>
                                            <a href="{{ route('enquete.edit', $enquete->id) }}" class="btn btn-outline-primary"><i class="fas fa-edit"></i></a>
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
