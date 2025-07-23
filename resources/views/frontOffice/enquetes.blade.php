@extends('layouts.app')

@section('content')
<style>

     .enquetes-section th:nth-child(3), .enquetes-section td:nth-child(3) {
                width: 5% !important;
        }

    .enquetes-section th:nth-child(1), .enquetes-section td:nth-child(1) {
                width: 10% !important;
        }

    .enquetes-section th:nth-child(4), .enquetes-section td:nth-child(4) {
                width: 10% !important;
        }

    .enquetes-section th:nth-child(5), .enquetes-section td:nth-child(5) {
                width: 10% !important;
        }
        
    .page-title {
        font-size: 32px;
        font-weight: 700;
        color: #2c3e50;
        text-align: left;
        margin-bottom: 10px;
        letter-spacing: 1px;
        margin-left:0px;
    }

    .page-title i {
        margin-right: 10px;
        color: #2c3e50;
        font-size: 20px;
    }

    body{
        margin-top:150px;
    }
    .underline {
        width: 100%;
        height: 4px;
        background-color: rgb(22, 18, 4);
        margin-bottom: 30px;
    }

    .enquete-card {
        flex: 1 1 calc(25% - 20px); 
        max-width: calc(25% - 20px);
        padding: 15px;
        background-color: whitesmoke;
        box-sizing: border-box;
        margin-bottom: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(33, 32, 32, 0.1);
        transition: all 0.3s ease;
        margin: 10px;
        border: 2px solid transparent;
        /* Micky d*/
        cursor: pointer; /* Indique que la carte est cliquable */
        /* Micky f*/
    }

    .enquete-card:hover {
        transform: scale(1.07)!important;
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }

    .enquete-card.selected {
        border: 2px solid #2c3e50;
        box-shadow: 0 0 10px rgba(44, 62, 80, 0.5);
    }

    .enquetes-container {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: flex-start;
        margin-left: 0px;
        margin-right: 20px;
        padding: 10px;
    }

    .enquete-image {
        width: 100%;
        height: auto;
        max-height: 150px;
        object-fit: cover;
        margin-bottom: 15px;
        /* Micky d */
        pointer-events: none; /* Empêche l'image de capturer les clics */
        /* Micky f */
    }
    .enquete-link {
        color: rgb(199, 176, 24);
        text-decoration: none;
        font-size: 18px;
        font-weight: 600;
        /* Micky d */
        pointer-events: none; /* Empêche l'image de capturer les clics */
        /* Micky f */
    }

    .new-badge {
        background-color: #e74c3c;
        color: white;
        font-size: 12px;
        padding: 5px 10px;
        border-radius: 50px;
        margin-left: 10px;
        font-weight: bold;
        position: absolute;
        top: 10px;
        right: 10px;
    }

    .file-card-container {
        width: 100%;
        margin-top: 20px;
        margin-bottom: 30px;
    }

    .file-card {
        background-color: #ffffff;
        padding: 20px;
        /* padding-right: 50px; */
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        text-align: center;
        position: relative;
    }

    .close-btn {
        position: absolute;
        top: 10px;
        right: 10px;
        background: transparent;
        border: none;
        font-size: 20px;
        color: red;
        cursor: pointer;
    }

    .close-btn:hover {
        color: darkred;
    }
    .file-card-table {
        width: 100%;
        overflow-x: auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        table-layout: fixed;
    }

    th, td {
        padding: 10px;
        border: 1px solid #ddd;
        text-align: left;
        word-wrap: break-word;
    }
    .file-search {
    margin-bottom: 15px;
    width: 100%;
    padding: 8px 12px;
    border: 1px solid #ddd;
    border-radius: 4px;
}
    

    th {
        background-color: rgb(154, 129, 54);
        color: white;
    }

    td:nth-child(1), th:nth-child(1) { 
        width: 25%;
    }

    td:nth-child(2), th:nth-child(2) { 
        width: 25%;
    }

    td:nth-child(3), th:nth-child(3) { 
        width: 10%;
        text-align: center;
    }

    td:nth-child(4), th:nth-child(4) { 
        width: 15%;
    }

    td:nth-child(5), th:nth-child(5) { 
        width: 15%;
    }

    td:nth-child(6), th:nth-child(6) {
        width: 10%;
    }

    .badge {
        display: inline-block;
        padding: 3px 7px;
        font-size: 12px;
        font-weight: 700;
        line-height: 1;
        text-align: center;
        white-space: nowrap;
        vertical-align: baseline;
        border-radius: 10px;
    }

    .badge-success {
        background-color: #28a745;
        color: white;
    }

    .badge-danger {
        background-color: #dc3545;
        color: white;
    }

    .badge-warning {
        background-color: #ffc107;
        color: #212529;
    }

    .badge-primary {
        background-color: #007bff;
        color: white;
    }

    .badge-secondary {
        background-color: #6c757d;
        color: white;
        font-size: 12px;
        white-space: normal;
        word-break: break-word;
    }

    .btn {
        display: inline-block;
        padding: 8px 12px;
        margin: 5px 0;
        text-align: center;
        font-size: 14px;
        border-radius: 4px;
        text-decoration: none;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-success {
        background-color: #28a745;
        color: white;
        border: none;
    }

    .btn-secondary {
        background-color: #6c757d;
        color: white;
        border: none;
    }

    .btn-warning {
        background-color: #ffc107;
        color: #212529;
        border: none;
    }

    .btn-primary {
        background-color: #007bff;
        color: white;
        border: none;
    }

    .no-files-message {
        font-size: 22px;
        font-weight: bold;
        color: rgb(22, 22, 21);
        text-align: center;
        margin-top: 30px;
        padding: 20px;
    }

    .space-between {
        margin: 30px 0;
    }
    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.5);
        padding-top: 50px;
    }

    .modal-content {
        background-color: #fff;
        margin: 5% auto;
        padding: 20px;
        border-radius: 8px;
        width: 50%;
        position: relative;
    }

    .close-btn {
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 25px;
        cursor: pointer;
    }

    textarea.form-control {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        resize: vertical;
    }

    .left-align {
        display: block;  
        text-align: left; 
    }

    .enquete-link h3 {
        color: #000000;
        font-size: 20px;
        font-weight: 700;
    }
    .no-underline-link {
        text-decoration: none;
    }

    .no-underline-link:hover {
        text-decoration: none; 
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

    .header-section {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .search-input {
        width: 100%;
        padding: 8px;
        font-size: 14px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }
    .header-section {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .file-card-table .search-container {
        display: flex;
        width: auto;
        justify-content: flex-end;
    }

    .file-card-table .search-container i {
        position: absolute;
        color: #888;
        font-size: 16px;
        margin-top: 10px;
        margin-right: 22px !important;
    }

    .file-card-table .search-container .delete-button i  {
        font-size: 25px;
        cursor: pointer;
    }

    .file-card-table .search-container .delete-button {
        margin-top: -11px;
        margin-right: 75px;
        display: none;
    }

    .search-input {
        padding: 8px;
        font-size: 14px;
        border: 1px solid #ccc;
        border-radius: 4px;
        margin-right: 10px; 
        width: 300px;
    }

    .search-btn {
        padding: 8px 16px;
        background-color:#2c3e50;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .search-btn:hover {
        background-color: #8c9ba5;
    }
    
    .enquete-row {
        display: flex;
        flex-wrap: wrap;
        width: 100%;
        margin-bottom: 20px;
    }
    
    .enquete-row-wrapper {
        width: 100%;
    }
    
    .enquete-row-content {
        display: flex;
        flex-wrap: wrap;
        width: 100%;
    }

    .pagination-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 5px;
        margin: 20px 0;
    }
    .pagination a,
    .pagination span {
        border: 1px solid #ddd;
        padding: 8px 12px;
        margin: 0 2px;
        text-decoration: none;
        color: #2c3e50;
    }

    .pagination a:hover {
        background-color: #f1f1f1;
    }

    .pagination .active span {
        background-color: #2c3e50;
        color: white;
        border-color: #2c3e50;
    }

    .page-number.active {
        background-color: #009688;
        color: white;
    }
    .paginationControls {
        display: flex;
        justify-content: center;
        margin-top: 2vh;
    }
    .paginationControls .page-number {
        cursor: pointer;
    }
    .paginationControls .page-link.disabled:hover {
            color: #747b8c;
            background-color: #ffffff;
    }

    .file-card p {
        margin: 25px 0;
    }

    .search-container>form {
        display: flex;
        justify-content: flex-end;
    }

    .delete-button {
        position: absolute;
        color: #888;
        font-size: 25px;
        cursor: pointer;
        transition: color 0.3s;
        margin-right: 64px;
        margin-top: 2px;
    }

    .delete-button:hover {
        color: #2c3e50;
        /* transform: scale(1.2); */
    }

    .delete-button1 {
        position: absolute;
        color: #888;
        font-size: 25px;
        cursor: pointer;
        transition: color 0.3s;
        margin-right: 64px;
        margin-top: 2px;
        display: none; /* Initially hidden */
    }

    .delete-button1:hover {
        color: #2c3e50;
        /* transform: scale(1.2); */
    }

    .no-result {
        text-align: center;
        font-size: 18px;
        color: #888;
        margin-top: 30px;
        padding-bottom: 100px;
    }
    .search-results {
        text-align: center;
        font-size: 18px;
        color: #2c3e50;
        margin-top: 20px;
        padding-bottom: 20px;
    }

    @media (max-width: 1200px) {
        .enquete-card {
            flex: 1 1 calc(33.333% - 20px);
            max-width: calc(33.333% - 20px);
        }
    }
/* 
    @media (max-width: 1008px) {

        .enquetes-section th:nth-child(1), .enquetes-section td:nth-child(1) {
                width: 15% !important;
        }

        .enquete-card {
            flex: 1 1 calc(50% - 20px);
            max-width: calc(50% - 20px);
        }

        .enquetes-section th:nth-child(3), .enquetes-section td:nth-child(3) {
                display: none !important;
        }
    } */

    @media (max-width: 1165px) {
        .enquetes-section th:nth-child(3), .enquetes-section td:nth-child(3) {
                display: none !important;
        }

        .enquete-card {
            flex: 1 1 calc(33.333% - 20px);
            max-width: calc(33.333% - 20px);
        }

        .enquetes-section th:nth-child(1), .enquetes-section td:nth-child(1) {
                width: 13% !important;
        }

        .enquetes-section th:nth-child(4), .enquetes-section td:nth-child(4) {
                width: 15% !important;
        }

        .enquetes-section th:nth-child(5), .enquetes-section td:nth-child(5) {
                width: 15% !important;
        }
    }
    
    @media (max-width: 926px) {

        .enquetes-section th:nth-child(1), .enquetes-section td:nth-child(1) {
                width: 100% !important;
        }

        .enquetes-section td {
            padding-left: 10px;
            width: 100% !important;
            text-align: left;
        }

        .enquete-card {
            flex: 1 1 100%;
            max-width: 100%;
        }
        
        .header-section {
            flex-direction: column;
            align-items: flex-start;
        }

        .page-title {
        font-size: 22px;    
        }

        .page-title i {
            margin-right: 7px;
            font-size: 12px;
        }
        
        .search-container {
            width: 100%;
            margin-top: 10px;
        }
        
        .search-input {
            width: 100%;
        }
        
        table, thead, tbody, th, td, tr {
            display: block;
        }
        
        thead tr {
            position: absolute;
            top: -9999px;
            left: -9999px;
        }
        
        tr {
            border: 1px solid #ccc;
            margin-bottom: 10px;
        }
        
        td {
            border: none;
            border-bottom: 1px solid #eee;
            position: relative;
            padding-left: 50%;
            width: 100%;
        }
        
        td:before {
            position: absolute;
            top: 6px;
            left: 6px;
            width: 45%;
            padding-right: 10px;
            white-space: nowrap;
            font-weight: bold;
        }
        
        /* td:nth-of-type(1):before { content: "Nom du fichier"; }
        td:nth-of-type(2):before { content: "Description"; }
        td:nth-of-type(3):before { content: "Téléchargements"; }
        td:nth-of-type(4):before { content: "Statut"; }
        td:nth-of-type(5):before { content: "Action"; }
        td:nth-of-type(6):before { content: "Rapport"; } */

        .enquetes-section th:nth-child(4), .enquetes-section td:nth-child(4), .enquetes-section td:nth-child(4) > a {
            width: 100% !important;
        }

        .enquetes-section th:nth-child(5), .enquetes-section td:nth-child(5), .enquetes-section td:nth-child(5) > button {
            width: 100% !important;
        }


        .titreTableauEnquete {
            display: none !important;
        }

    }

    @media (max-width: 441px) {
        /* .search-input {
            width: 60%;
        } */

        .iconSearch {
            right: 10px;
            font-size: 18px;
            color: #888;
        }
    }

    .bouttonTheme:hover {
        background-color: #2c3e50;
        transform: scale(1.05);
        color: white;
    }

    .enqueteAssocie {
        font-weight: bold;
        color: #2c3e50;
    }

</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">


<div class="enquetes-section" style="margin-top: 0px;">
    <div class="header-section">
        <h1 class="page-title"><i class="bi bi-bar-chart-line"></i>Recensement et enquêtes</h1>
        <div class="search-container">
            <form method="GET" action="{{ route('showEnquetes') }}">
                <input type="text" name="search" class="search-input" placeholder="Rechercher une enquête..." value="{{ request('search') }}" onkeyup="filterFiles1(this)">
                <a class="delete-button1" onclick="clearSearch(this)"><i class="bi bi-x"></i></a>
                @if(isset($_GET["search"]) && $_GET["search"] !== "")
                    <a class="delete-button" href="{{ route('showEnquetes')}}"><i class="bi bi-x"></i></a>
                @endif
                <button type="submit" class="search-btn"><i class="fas fa-search"></i></button>
            </form>
        </div>
    </div>
    
    <div class="underline"></div>

    @if(isset($_GET["search"]) && $_GET["search"] !== "")
        <div class="search-results">
            <p>
                Résultats de la recherche pour : <strong>{{ $_GET["search"] }}</strong>
            </p>
        </div>
    @endif
    
    <div class="enquetes-container">
        @php $delay = 0; @endphp
        {{-- @foreach($enquetes->chunk(8) as $chunk) --}}
        @foreach($enquetes->filter(fn($e) => $e->fichiers->isNotEmpty())->chunk(8) as $chunk)
            <div class="enquete-row-wrapper">
                <div class="enquete-row-content">
                    @foreach($chunk as $enquete)
                        @php
                            $isNew = $enquete->fichiers->where('created_at', '>=', now()->subMonth())->isNotEmpty();
                        @endphp

                        <div class="enquete-card" id="card-{{ $enquete->id }}"  data-aos="fade-in" data-aos-delay="{{ $delay }}" onclick="toggleFiles({{ $enquete->id }})">
                            @if($isNew)
                                <div class="badge-container">
                                    <span class="badge badge-danger">Nouveau</span>
                                </div>
                            @endif
                            <!-- Micky d -->
                            <!-- <a href="javascript:void(0)" onclick="toggleFiles({{ $enquete->id }})" class="enquete-link"> -->
                                <img src="{{ asset('storage/images/enquetes/' . $enquete->images) }}" alt="Image de l'enquête" class="enquete-image">
                            <!-- </a> -->
                            <div class="enquete-info">
                                <!-- <a href="javascript:void(0)" onclick="toggleFiles({{ $enquete->id }})" class="enquete-link"> -->
                                    <h3 class="enquete-link">{{ $enquete->nom }}</h3>
                                <!-- </a> -->
                            <!-- Micky f -->
                                <p class='left-align'>{{ Str::limit($enquete->description, 70) }}</p>
                                <p><i class="far fa-clock me-2"></i> {{$enquete->created_at->format('d M Y') }}</p>
                                <p>Total de téléchargements: {{ $enquete->fichiers->sum('nombre') }} <i class="fas fa-download"></i></p>
                                <a href="javascript:void(0)" onclick="toggleFiles({{ $enquete->id }})" class="enquete-link">
                                    <i class="bi bi-arrow-right-circle arrow-icon"></i> Plus de details
                                </a>
                            </div>
                        </div>
                        @php $delay += 100; @endphp {{-- Ajoute 100ms de délai à chaque carte --}}
                    @endforeach
                </div>
                <div class="pagination-wrapper">
        {{ $enquetes->appends(request()->query())->links() }}
    </div>
                
                @foreach($chunk as $enquete)
                    <div id="files-{{ $enquete->id }}" class="file-card-container" style="display: none;">
                        <div class="file-card">
                            <button class="close-btn" onclick="closeFiles({{ $enquete->id }})">&times;</button>
                            @if($enquete->fichiers->isNotEmpty())
                                @if($enquete->fichiers->first()->enquete)
                                    <p>{{ $enquete->fichiers->first()->enquete->description }}</p>
                                @else
                                    <p>Description non disponible</p>
                                @endif

                                <div class="file-card-content">
                                    <div class="file-card-table">
                                    <div class="search-container">
                                        <input type="text" class="search-input file-search" placeholder="Rechercher un fichier..." onkeyup="filterFiles(this)">
                                        <a class="delete-button" onclick="clearSearch(this)"><i class="bi bi-x"></i></a>
                                        <i class="fas fa-search iconSearch"></i>
                                    </div>

                                        <table>
                                            <thead> 
                                                <tr>
                                                    <th class="titreTableauEnquete">Nom du fichier</th>
                                                    <th class="titreTableauEnquete">Description</th>
                                                    <th class="titreTableauEnquete"><i class="fas fa-download"></i></th>
                                                    {{-- <th>Statut</th> --}}
                                                    <th class="titreTableauEnquete">Action</th>
                                                    <th>Rapport d'analyses</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($enquete->fichiers as $fichier)
                                                    @if ($fichier->published)
                                                        @php
                                                            $demande = $fichier->demandes()->where('user_id', auth()->id())->latest()->first();
                                                        @endphp
                                                        <tr>
                                                            <td>{{ $fichier->file_name }}</td>
                                                            <td>
                                                                <span class="enqueteAssocie">Statut:</span>

                                                                @php
                                                                    $demande = \App\Download::where('user_id', auth()->id())
                                                                                ->where('file_id', $fichier->id)
                                                                                ->latest()
                                                                                ->first();
                                                                @endphp
                                                                @if($fichier->type === 'sans_validation')
                                                                    <span class="badge badge-primary">Demande non requise</span>
                                                                @else
                                                                    @if($demande)
                                                                        @if($demande->status === 'valide')
                                                                            <span class="badge badge-success">Validé</span>
                                                                        @elseif($demande->status === 'rejete')
                                                                            <span class="badge badge-danger">Refusé</span>
                                                                        @else
                                                                            <span class="badge badge-warning">En attente</span>
                                                                        @endif
                                                                    @else
                                                                        <span class="badge badge-secondary">Demande requise</span>
                                                                    @endif
                                                                @endif
                                                                <br><br>

                                                                {{ $fichier->description ?? 'Inconnue' }}

                                                            </td>
                                                            <td style="text-align: center;">{{ $fichier->nombre }}</td>
                                                            {{-- <td>
                                                                @php
                                                                    $demande = \App\Download::where('user_id', auth()->id())
                                                                                ->where('file_id', $fichier->id)
                                                                                ->latest()
                                                                                ->first();
                                                                @endphp
                                                                @if($demande)
                                                                    @if($demande->status === 'valide')
                                                                        <span class="badge badge-success">Validé</span>
                                                                    @elseif($demande->status === 'rejete')
                                                                        <span class="badge badge-danger">Refusé</span>
                                                                    @else
                                                                        <span class="badge badge-warning">En attente</span>
                                                                    @endif
                                                                @else
                                                                    @if($fichier->type === 'sans_validation')
                                                                        <span class="badge badge-primary">Fichier téléchargeable</span>
                                                                    @else
                                                                        <span class="badge badge-secondary">Demande requise</span>
                                                                    @endif
                                                                @endif
                                                            </td> --}}
                                                            {{-- <td class="text-center">
                                                                @if(!$demande)
                                                                    @if($fichier->type === 'sans_validation')
                                                                <button class="btn btn-success" onclick="openDownloadModal({{ $fichier->id }}, '{{ $fichier->file_name }}')">Télécharger</button>
                                                                    @elseif($fichier->type === 'avec_validation')
                                                                        <a href="#" class="btn btn-secondary bouttonTheme" onclick="openModal({{ $fichier->id }})">Faire une demande</a>
                                                                    @endif
                                                                @else
                                                                    @if($demande->status === 'valide')
                                                                <button class="btn btn-success" onclick="openDownloadModal({{ $fichier->id }}, '{{ $fichier->file_name }}')">Télécharger</button>
                                                                    @elseif($demande->status === 'rejete')
                                                                        <span class="text-danger">Téléchargement refusé</span>
                                                                    @else
                                                                        <span class="btn btn-warning" style="cursor: not-allowed;">Demande en attente</span>
                                                                    @endif
                                                                @endif
                                                            </td> --}}
                                                            <td class="text-center placeBoutton">
                                                                @if($fichier->type === 'sans_validation')
                                                                    <a href="{{ route('sauvegarder.create', ['file_id' => $fichier->id]) }}" class="btn btn-success">Télécharger</a>
                                                                @else
                                                                    @if(!$demande)
                                                                        {{-- <a href="#" class="btn btn-secondary bouttonTheme" onclick="openModal({{ $fichier->id }})">Faire une demande</a> --}}
                                                                        <a href="{{ route('demande.create', ['file_id' => $fichier->id]) }}" class="btn btn-secondary bouttonTheme">Faire une demande</a>
                                                                    @else
                                                                        @if($demande->status === 'valide')                                                        
                                                                            {{-- <a href="{{ route('sauvegarder.create', ['file_id' => $fichier->id]) }}" class="btn btn-success">Télécharger 1</a> --}}
                                                                            <a href="{{ route('files.keke', ['id' => $fichier->id]) }}" class="btn btn-success">Télécharger</a>
                                                                        @elseif($demande->status === 'rejete')
                                                                            <span class="text-danger">Téléchargement refusé</span>
                                                                        @else
                                                                            <span class="btn btn-warning" style="cursor: not-allowed;">Demande en attente</span>
                                                                        @endif
                                                                    @endif
                                                                @endif
                                                            </td>
                                                            <td class="text-center">
                                                                @if($fichier->isdownload === 1) 
                                                                    <a href="#" class="btn btn-primary" onclick="openReportModal({{ $fichier->id }})">Envoyer rapport</a>
                                                                @else
                                                                    <button class="btn btn-primary" disabled>Ajouter un rapport</button>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <div id="paginationControls-{{ $enquete->id }}" class="paginationControls">
                                            <div aria-label="Page navigation">
                                                <ul class="pagination">
                                                    <li class="disabled page-link" id="prevPage-{{ $enquete->id }}" onclick="prevPage({{ $enquete->id }})">Précédent</li>
                                                    <div id="pageNumbers-{{ $enquete->id }}" class="d-flex"></div>
                                                    <li class="page-link" id="nextPage-{{ $enquete->id }}" onclick="nextPage({{ $enquete->id }})">Suivant</li>
                                                </ul>
                                            </div>
                                        </div>
                                 </div>
                                </div>
                            @else
                                <p class="no-files-message">Aucun fichier associé à cette enquête.</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
    @if($enquetes->isEmpty() && isset($_GET["search"]) && $_GET["search"] !== "")
        <div class="no-result">
            <p>Aucun résultat trouvé.</p>
        </div>
    @endif
</div>


<!-- Modal de téléchargement direct -->
<div id="downloadModal" class="modal" style="display:none; position: fixed; top: 0; left: 0; width:100%; height:100%; background-color: rgba(0,0,0,0.6); z-index: 1050;">
    <div class="modal-content" style="background: #fff; border-radius: 8px; max-width: 500px; margin: 100px auto; padding: 20px; position: relative;">
        <h5 class="modal-title mb-3">Téléchargement du fichier</h5>
        <form id="downloadForm" method="POST" action="{{ route('file.request', ['file' => 'ID']) }}">
            @csrf
            <div class="form-group">
                <label for="motif">Motifs de la demande</label>
                <textarea name="motif" id="motif" class="form-control" rows="4" required></textarea>
            </div>
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="cgu" name="terms" required>
                <label class="form-check-label" for="cgu">
                    J'accepte les <a href="#" onclick="openCGUModal()">conditions générales d'utilisation</a>.
                </label>
            </div>
            <input type="hidden" name="file_id" id="modal_file_id">
            <button type="submit" class="btn btn-primary">Télécharger maintenant</button>
            <button type="button" class="btn btn-secondary" onclick="closeDownloadModal()">Annuler</button>
        </form>
    </div>
</div>

<div id="requestModal" class="modal">
    <div class="modal-content">
        <span class="close-btn" onclick="closeModal()">&times;</span>
        <h3>Faire une Demande</h3>
        <form action="{{ route('downloads.demandeEnquetes', ['file' => '__ID__']) }}" method="POST" id="requestForm">
            @csrf
            <input type="hidden" id="file_id" name="file_id">
            <div class="form-group">
                <label for="motif">Motif de la demande</label>
                <textarea id="motif" name="motif" rows="4" required class="form-control"></textarea>
                <div class="form-group">
                    <input type="checkbox" id="accept_conditions" onchange="toggleSubmitButton()">
                    <label for="accept_conditions">
                        J'accepte les <a href="javascript:void(0)" onclick="openConditionsModal()">conditions générales</a>
                    </label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary" id="submitRequestBtn" disabled>Envoyer la Demande</button>
        </form>
    </div>
</div>
<div id="reportModal" class="modal">
    <div class="modal-content">
        <span class="close-btn" onclick="closeReportModal()">&times;</span>
        <h3>Envoyer un rapport d'analyse</h3>
        <form action="{{ route('downloads.uploadRapport') }}" method="POST" id="reportForm" enctype="multipart/form-data">
            @csrf
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="form-group">
                <input type="hidden" id="download_id" value="{{ $userDownload ? $userDownload->id : '' }}">
                <label for="report_file">Sélectionner un fichier</label>
                <input type="file" id="report_file" name="file" required class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </form>
    </div>
</div>
<div id="conditionsModal" class="modal">
    <div class="modal-content">
        <span class="close-btn" onclick="closeConditionsModal()">&times;</span>
        <h3 id="condition">Conditions générales d'utilisation</h3>
        <p><h5>1. <u>Principe de confidentialité et protection des données</u> :</h5></p>
        <p>Conformément à la Loi n°2018-04 du 12 mars 2018 relative à l'organisation et à la règlementation des activités statistiques, 
            les données statistiques mises à disposition respectent les principes suivants :</p>
        <p><strong>- Confidentialité :</strong> les données diffusées sont anonymisées et ne permettent pas d'identifier 
        directement ou indirectement une personne physique ou morale.</p>
        <p><strong>- Protection des données :</strong> Toute collecte, traitement et diffusion des données statistiques sont 
        réalisés dans le respect des normes éthiques en vigueur, garantissant leur intégrité et leur sécurité.</p>
        <p><strong>- Utilisation légale :</strong> les données statistiques ne peuvent être exploitées qu'à des fins 
        d'analyse, de recherche, ou d'évaluation dans cadre légal.</p>
        <p><h5>2. <u>Droits et responsabilités de l'utilisateur</u> :</h5></p>
        <p>Tout utilisateur des données s'engage à :</p>
        <p>- Respecter les principes de confidentialité et de protection des données définis par la Loi ;</p>
        <p>- Ne pas utiliser les données à des fins commerciales sans autorisation expresse de l'INSTAT ;</p>
        <p>- Ne pas altérer, falsifier ou modifier les données mises à disposition ;</p>
        <p><h5>3. <u>Limitation de responsabilité</u> :</h5></p>
        <p>- Toute analyse ou conclusion découlant de l'utilisation des données par 
        l'utilisateur ne peut engager la responsabilité de l'INSTAT.</p>
        <p>- L'INSTAT décline toute responsabilité quant aux conséquences découlant d'une 
            utilisation inappropriée, erronée ou frauduleuse des données mises en ligne.</p>
        <p>- L'INSTAT ne pourra être tenu responsable des erreurs, omissions ou délais dans la mise à jour des données.</p>
        <button class="btn btn-primary" onclick="closeConditionsModal()">Ok</button>
    </div>
</div>

<script>
    function openDownloadModal(fileId, fileName) {
        const modal = document.getElementById('downloadModal');
        const form = document.getElementById('downloadForm');
        const fileIdInput = document.getElementById('modal_file_id');

        // Définir l'action du formulaire (vers la route de téléchargement)
        form.action = '/file/request/' + fileId; // Ajuste selon ta route (ou utilise `{{ route('file.request', ':id') }}` si tu veux générer dynamiquement via JS)

        fileIdInput.value = fileId;

        modal.style.display = 'block';
    }

    function closeDownloadModal() {
        const modal = document.getElementById('downloadModal');
        modal.style.display = 'none';
    }

    // Ferme le modal si on clique en dehors
    window.onclick = function(event) {
        const modal = document.getElementById('downloadModal');
        if (event.target === modal) {
            closeDownloadModal();
        }
    }
</script>

<script>

    // Nombre de Fichier par page
    const pageSize = 5

    var original = {
        id: null,
        data: null,
        pageNumber: 1,
        pageSize: pageSize,
        currentPage: 1,
    }

function toggleFiles(enqueteId) {
    if (enqueteId === original.id) {
            // If the same enquete is clicked, restore the table
            restoreTable(original.id);
            original = {
                id: null,
                data: null,
                pageNumber: 1,
                pageSize: pageSize,
                currentPage: 1,
            }
        } else if (original.id !== null) {
            // If a different enquete is clicked, initialize the pagination table
            restoreTable(original.id);
            original = {
                id: null,
                data: null,
                pageNumber: 1,
                pageSize: pageSize,
                currentPage: 1,
            }
            initPaginationTable(enqueteId);
        } else {
            // If no enquete is clicked, initialize the pagination table
            initPaginationTable(enqueteId);
        }

    document.querySelectorAll('.file-card-container').forEach(container => {
        if (container.id !== `files-${enqueteId}`) {
            container.style.display = 'none';
        }
    });
    const filesContainer = document.getElementById(`files-${enqueteId}`);
    const card = document.getElementById(`card-${enqueteId}`);
    
    document.querySelectorAll('.enquete-card').forEach(c => {
        if (c.id !== `card-${enqueteId}`) {
            c.classList.remove('selected');
        }
    });
    
    if (filesContainer.style.display === 'none' || filesContainer.style.display === '') {
        filesContainer.style.display = 'block';
        card.classList.add('selected');
        filesContainer.scrollIntoView({ behavior: 'smooth' });
    } else {
        filesContainer.style.display = 'none';
        card.classList.remove('selected');
    }
}

function restoreTable(enqueteId) {
        console.log(original.data); // Debug line
        if (original.data) {
            $(`#files-${enqueteId} table`).empty();
            $(`#files-${enqueteId} table`).append(original.data.clone());
        }
    }

    function initPaginationTable(enqueteId) {
        original = {
            id: null,
            data: null,
            pageNumber: 1,
            pageSize: pageSize,
            currentPage: 1,
        }

        //// Pagination dynamic

        const rowsArray = $(`#files-${enqueteId} table tr`).clone();

        original.id = enqueteId
        original.data = rowsArray.clone()
        
        
        const head = original.data.slice(0,1).clone()
        const tempData = original.data.slice(1,original.pageSize + 1).clone()
        
        $(`#files-${enqueteId} table`).empty()
        $(`#files-${enqueteId} table`).prepend($('<thead>').append(head));
        $(`#files-${enqueteId} table`).append($('<tbody>').append(tempData));

        original.pageNumber = Math.ceil((original.data.length - 1) / original.pageSize);

        const pageNumbersContainer = document.getElementById(`pageNumbers-${enqueteId}`);
        
        if (original.pageNumber <= 1) {
            document.getElementById(`paginationControls-${enqueteId}`).style.display = "none";
        } else {
            document.getElementById(`paginationControls-${enqueteId}`).style.display = "flex";
        }

        pageNumbersContainer.innerHTML = '';
        
        for (let i = 0; i < original.pageNumber; i++) {
            const pageNumber = document.createElement('span');
            pageNumber.textContent = i + 1;
            pageNumber.className = 'page-number';
            pageNumber.dataset.page = i + 1;
            pageNumber.onclick = function() {
                changePage(enqueteId, i + 1);
            };
            pageNumbersContainer.appendChild(pageNumber);
        }

        $(`#pageNumbers-${enqueteId} .page-number:first-child`).addClass("active")

        //// End Pagination dynamic
    }

    // Change page function
    function changePage(enqueteId, pageNumber) {

        $(`#pageNumbers-${enqueteId} .page-number:nth-child(${original.currentPage})`).removeClass("active")
        $(`#pageNumbers-${enqueteId} .page-number:nth-child(${pageNumber})`).addClass("active")

        const begin = (pageNumber - 1) * original.pageSize + 1;

        const end = begin + original.pageSize;
        const head = original.data.slice(0,1).clone()
        const tempData = original.data.slice(begin, end).clone()
        
        $(`#files-${enqueteId} table`).empty()
        $(`#files-${enqueteId} table`).prepend($('<thead>').append(head));
        $(`#files-${enqueteId} table`).append($('<tbody>').append(tempData));

        
        original.currentPage = pageNumber;
        console.log("Changing page to:", pageNumber, "for theme ID:", enqueteId); // Debug line

        if (pageNumber === original.pageNumber) {
            $(`#nextPage-${enqueteId}`).addClass('disabled');
        } else {
            $(`#nextPage-${enqueteId}`).removeClass('disabled');
        }
        if (pageNumber === 1) {
            $(`#prevPage-${enqueteId}`).addClass('disabled');
        } else {
            $(`#prevPage-${enqueteId}`).removeClass('disabled');
        }
    }

    function nextPage(enqueteId) {
        const nextPage = original.currentPage + 1;
        if (nextPage <= original.pageNumber) {
            changePage(enqueteId, nextPage);
        }
    }

    function prevPage(enqueteId) {
        const prevPage = original.currentPage - 1;
        if (prevPage >= 1) {
            changePage(enqueteId, prevPage);
        }
    }

function closeFiles(enqueteId) {
    document.getElementById(`files-${enqueteId}`).style.display = 'none';
    document.getElementById(`card-${enqueteId}`).classList.remove('selected');

    restoreTable(enqueteId)
        original = {
            id: null,
            data: null,
            pageNumber: 1,
            pageSize: pageSize,
            currentPage: 1,
        }
}

function openReportModal(fileId) {
    const modal = document.getElementById('reportModal');
    document.getElementById('download_id').value = fileId;
    modal.style.display = 'block';
}

function closeReportModal() {
    document.getElementById('reportModal').style.display = 'none';
}

function openModal(fileId) {
    const modal = document.getElementById('requestModal');
    document.getElementById('file_id').value = fileId;
    const form = document.getElementById('requestForm');
    form.action = form.action.replace('__ID__', fileId);

    modal.style.display = 'block';
}

function closeModal() {
    document.getElementById('requestModal').style.display = 'none';
}

function toggleSubmitButton() {
    const checkbox = document.getElementById('accept_conditions');
    const submitButton = document.getElementById('submitRequestBtn');

    submitButton.disabled = !checkbox.checked;
}

function openConditionsModal() {
    const modal = document.getElementById('conditionsModal');
    modal.style.display = 'block';
}

function closeConditionsModal() {
    document.getElementById('conditionsModal').style.display = 'none';
}
function filterFiles(input) {

    const tableTemp = input.closest('div').nextElementSibling
        const paginationDiv = tableTemp.nextElementSibling
        const enqueteId = paginationDiv.id.split('-')[1]
        paginationDiv.style.display = "none"

        $(tableTemp).empty();
        $(tableTemp).append(original.data.clone());

    const value = input.value.trim();
    if (value === '') {

        initPaginationTable(enqueteId)

        $(".search-container .delete-button").hide();
        $(".search-container .delete-button1").hide();
    } else {
        $(".search-container .delete-button").show();
        $(".search-container .delete-button1").show();
    }

    const searchTerm = input.value.toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, '');
    const table = input.closest('div').nextElementSibling;
    const rows = table.querySelectorAll('tr');

    rows.forEach(row => {
        const nameCell = row.querySelector('td:nth-child(1)');
        const descriptionCell = row.querySelector('td:nth-child(2)');
        const statusCell = row.querySelector('td:nth-child(4)');
        const nameText = nameCell ? nameCell.textContent.toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, '') : '';
        const descriptionText = descriptionCell ? descriptionCell.textContent.toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, '') : '';
        const statusText = statusCell ? statusCell.textContent.toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, '') : '';
        const match = nameText.includes(searchTerm) || descriptionText.includes(searchTerm) || statusText.includes(searchTerm);
        row.style.display = match ? '' : 'none';
    });
}
function filterFiles1(input) {
        const value = input.value.trim();
        if (value === '') {


            $(".search-container .delete-button").hide();
            $(".search-container .delete-button1").hide();
        } else {
            
            // return
            
            $(".search-container .delete-button").show();
            $(".search-container .delete-button1").show();
        }
    }

function clearSearch(element) {
    const searchInput = element.previousElementSibling;
    searchInput.value = '';
    filterFiles(searchInput);
}

</script>
@endsection