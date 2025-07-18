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
            font-size: 14px;
            color: #333;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            padding-top: 100px;
        }

        .card-global {
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            padding: 25px;
            margin: 20px auto;
            max-width: 100%;
            width: 100%;
            margin-left: 0px;
        }

        h4 {
            font-size: 1.6em;
            margin-bottom: 20px;
            color: #333;
            font-weight: 600;
        }

        .form-small {
            max-width: 200px;
            font-size: 18px;
            height: 42px;
        }

        .form-control {
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ddd;
            width: 100%;
        }

        .form-control:focus {
            border-color: #007BFF;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
        }

        .btn {
            padding: 10px 15px;
            font-size: 14px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .btn-info {
            background-color: #17a2b8;
        }

        .btn-info:hover {
            background-color: #117a8b;
        }

        .table-wrapper {
            display: flex;
            gap: 30px;
            flex-wrap: wrap;
            margin-top: 20px;
        }

        .table-section {
            flex: 1 1 48%;
            min-width: 300px;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            padding: 12px 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            word-break: break-word;
        }

        th {
            background-color: #333;
            color: white;
        }

        .d-flex1 {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
        }

        

        @media (max-width: 768px) {
            .table-wrapper {
                flex-direction: column;
            }

            .d-flex {
                flex-direction: column;
                align-items: stretch;
            }
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
     <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="container-fluid card-global">
        <form method="GET" action="{{ route('historiques.index') }}" class="d-flex1 mb-4" style="gap: 10px; align-items: flex-end;">
            <input type="text" name="search" placeholder="Recherche..." class="form-control form-small" value="{{ request()->get('search') }}">
            <input type="date" name="date_debut" class="form-control form-small" value="{{ request()->get('date_debut') }}">
            <input type="date" name="date_fin" class="form-control form-small" value="{{ request()->get('date_fin') }}">
            <button type="submit" class="btn btn-info"><i class="fa fa-search"></i></button>
        </form>
        <div class="table-wrapper">
            <div class="table-section">
                <h4>Historique des Téléchargements</h4>
                <table>
                    <thead>
                        <tr>
                            <th>Nom de l'utilisateur</th>
                            <th>Nom du fichier</th>
                            <th>Date du téléchargement</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($historiques as $historique)
                            <tr>
                                <td>{{ $historique->user->name }}</td>
                                <td>{{ $historique->file->file_name?? 'N/A'  }}</td>
                                <td>{{ $historique->created_at->format('d/m/Y H:i') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex1">
                    {{ $historiques->appends(request()->query())->links() }}
                </div>
            </div>

            <div class="table-section">
                <h4>Historique des validations</h4>
                <table>
                    <thead>
                        <tr>
                            <th>Fichier</th>
                            <th>Demandé par</th>
                            <th>Status</th>
                            <th>Suivi par</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($downloads as $download)
                            <tr>
                                <td>{{ $download->file->file_name ?? 'N/A' }}</td>
                                <td>{{ $download->demandeur->name ?? 'N/A' }}</td>
                                <td>{{ ucfirst($download->status) ?? 'N/A' }}</td>
                                <td>{{ $download->validateur->name ?? 'Non validé' }} {{ $download->validateur->prenom }}</td>
                                <td>{{ $download->updated_at->format('d/m/Y H:i') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex1">
                    {{ $downloads->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>
</body>
@endsection
