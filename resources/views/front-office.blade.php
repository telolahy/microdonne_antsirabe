@extends('layouts.app')

@section('content')
<style>

    .enquetes-section th:nth-child(3), .enquetes-section td:nth-child(3) {
                width: 5% !important;
        }

    .enquetes-section th:nth-child(1), .enquetes-section td:nth-child(1) {
                width: 10% !important;
        }

    .page-title {
        font-size: 32px;
        font-weight: 700;
        color: #2c3e50;
        text-align: left;
        margin-bottom: 10px;
        letter-spacing: 1px;
    }

    .page-title i {
        margin-right: 10px;
        color: #2c3e50;
        font-size: 20px;
    }

    /* .container{
        margin-left: 300px;  
    } */
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
        background-color: white;
        box-sizing: border-box;
        margin-bottom: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
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
        margin-top: 35px;
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

    th {
        background-color: rgb(154, 129, 54);
        color: white;
    }
    td:nth-child(1), th:nth-child(1) { 
    width: 15%; /* Reduced from 25% */
}

    td:nth-child(2), th:nth-child(2) { 
        width: 25%;
    }

    td:nth-child(3), th:nth-child(3) { 
        width: 14%;
        text-align: center;
    }

    td:nth-child(4), th:nth-child(4) { 
    width: 10%; /* Reduced from 15% */
}

    td:nth-child(5), th:nth-child(5) { 
        width: 17%;
    }

    td:nth-child(6), th:nth-child(6) {
        width: 12%;
    }
    td:nth-child(7), th:nth-child(7) { 
    width: 17%; /* Increased from 15% */
    word-wrap: break-word;
    white-space: normal;
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

    @media (max-width: 600px) {
        td:nth-child(1), th:nth-child(1) { width: 10%; }
        td:nth-child(4), th:nth-child(4) { width: 8%; }
        td:nth-child(7), th:nth-child(7) { width: 30%; }
        
        td:nth-of-type(7):before {
            content: "Rapport d'analyses";
            white-space: normal;
        }

        .enquetes-section td {
            padding-left: 10px;
            width: 100% !important;
            text-align: left;
        }
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
    .header-section {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .search-container {
        width: 250px;
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

    .search-container {
        display: flex;
        align-items: center;
        width: auto;
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
    .file-search {
    margin-bottom: 15px;
    width: 100%;
    padding: 8px 12px;
    border: 1px solid #ddd;
    border-radius: 4px;
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

    .file-card-table .search-container {
        display: flex;
        width: auto;
        justify-content: flex-end;
    }

    .file-card-table .search-container i {
        position: absolute;
        color: #888;
        font-size: 16px;
        margin-top: -15px;
        margin-right: 22px !important;
    }

    .file-card-table .search-container .delete-button i  {
        font-size: 25px;
        cursor: pointer;
    }

    .file-card-table .search-container .delete-button {
        margin-top: -22px;
        margin-right: 75px;
        display: none;
    }

    .file-card-table .file-search {
        width: 40%;
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

    @media (max-width: 1200px) {
        .enquete-card {
            flex: 1 1 calc(33.333% - 20px);
            max-width: calc(33.333% - 20px);
        }
    }

    @media (max-width: 900px) {
        .enquete-card {
            flex: 1 1 calc(50% - 20px);
            max-width: calc(50% - 20px);
        }
    }

    @media (max-width: 1050px) {
        .enquetes-section th:nth-child(5), .enquetes-section td:nth-child(5) {
                width: 15% !important;
        }

        .enquetes-section th:nth-child(4), .enquetes-section td:nth-child(4) {
                width: 15% !important;
        }
    }

    @media (max-width: 876px) {
        .header-section {
            flex-direction: column;
            align-items: flex-start;
            margin-bottom: 15px;
        }

        .search-container>form {
            display: flex;
            width: 100%;
            margin-top: 10px;
        }
    }

    @media (max-width: 850px) {

        .enquetes-section th:nth-child(1), .enquetes-section td:nth-child(1) {
                width: 100% !important;
        }

        .enquetes-section th:nth-child(5), .enquetes-section td:nth-child(5) {
                width: 15% !important;
        }

        .enquetes-section th:nth-child(4), .enquetes-section td:nth-child(4) {
                width: 15% !important;
        }
        .enquete-card {
            flex: 1 1 100%;
            max-width: 100%;
        }
        
        .header-section {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .search-container {
            width: 100%;
            margin-top: 10px;
            white-space: nowrap;
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

        .enquetes-section td {
            padding-left: 10px;
            width: 100% !important;
            text-align: left;
        }

        .enquetes-section th:nth-child(4), .enquetes-section td:nth-child(4), .enquetes-section th:nth-child(5), .enquetes-section td:nth-child(5) {
            width: 100% !important;
        }
        .enquetes-section td:nth-child(5)>button {
            width: 100%;
            padding: 10px;
            font-size: 13px;
        }

        .file-card-table .file-search {
            width: 100%;
        }
    }

        /* Modifier ces styles pour ajuster les largeurs des colonnes */
td:nth-child(1), th:nth-child(1) { width: 15%; }
td:nth-child(2), th:nth-child(2) { width: 20%; }
td:nth-child(3), th:nth-child(3) { width: 15%; }
td:nth-child(4), th:nth-child(4) { width: 10%; text-align: center; }
td:nth-child(5), th:nth-child(5) { width: 10%; }
td:nth-child(6), th:nth-child(6) { width: 15%; }
td:nth-child(7), th:nth-child(7) { width: 15%; text-align: center; } /* Augmenté de 10% à 15% */

/* S'assurer que le texte ne s'enveloppe pas verticalement dans la colonne du rapport */
td:nth-child(7), th:nth-child(7) {
    white-space: normal;
    word-break: break-word;
}

/* Correction pour les mobiles */
@media (max-width: 600px) {
    td:nth-of-type(7):before { content: "Rapport"; }
    
    td {
        padding-left: 50%;
        width: 100%;
        text-align: left;
    }
    
    td:before {
        width: 40%;
        padding-right: 10px;
    }
    
    /* Ajouter le 7ème élément */
    td:nth-of-type(7):before {
        content: "Rapport d'analyses";
    }
}


    @keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.slide-down {
    animation: slideDown 0.3s ease-out forwards;
}
    /* Your existing CSS remains unchanged */
    /* This is critical CSS that ensures the files section appears properly */
    .file-card-container {
        width: 100%;
        margin-top: 20px;
        margin-bottom: 30px;
        display: none; /* Initially hidden */
    }

    .file-card {
        background-color: #ffffff;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        text-align: center;
        position: relative;
    }
    


    @media (max-width: 975px) {

            .enquetes-section th:nth-child(3), .enquetes-section td:nth-child(3) {
                display: none;
            }

            .nombreTelechargement {
            display: none;
            }

            .bouttonTheme{
                width: 100%;
                padding: 10px;
                font-size: 13px;
            }
    }
    /* Add this to fix the animation */
    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .slide-down {
        animation: slideDown 0.3s ease-out forwards;
    }

    .enqueteAssocie {
        font-weight: bold;
        color: #2c3e50;
    }

    .chaqueEnquete {
        color: #3318be;
        text-decoration: none;
    }

    .bouttonTheme:hover {
        background-color: #2c3e50;
        transform: scale(1.05);
        color: white;
    }

</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">


<div class="enquetes-section">
    <div class="header-section">
        <h1 class="page-title"><i class="bi bi-bookmarks"></i>Thèmes</h1>
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        <div class="search-container">
            <form action="{{ route('front-office')}}" method="GET">
                <input type="text" name="search" class="search-input" placeholder="Rechercher un thème..." value="{{ request('search') }}" onkeyup="filterFiles1(this)">
                    <a class="delete-button1" onclick="clearSearch(this)"><i class="bi bi-x"></i></a>
                @if(isset($_GET["search"]) && $_GET["search"] !== "")
                    <a class="delete-button" href="{{ route('front-office')}}"><i class="bi bi-x"></i></a>
                @endif
                <button type="submit" class="search-btn">
                    <i class="bi bi-search"></i>
                </button>
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
    {{-- @foreach($themes->chunk(4) as $chunk) --}}
    @foreach($themes->filter(fn($theme) => $theme->files->isNotEmpty())->chunk(8) as $chunk)

        <div class="enquete-row-wrapper">
            <div class="enquete-row-content">
                @foreach($chunk as $theme)
                    @php
                        $isNew = $theme->files->where('created_at', '>=', now()->subMonth())->isNotEmpty();
                    @endphp

                    <div class="enquete-card " id="card-{{ $theme->id }}" data-aos="fade-up" data-aos-delay="{{ $delay }}" onclick="toggleFiles({{ $theme->id }})">
                        @if($isNew)
                            <div class="badge-container">
                                <span class="badge badge-danger">Nouveau</span>
                            </div>
                        @endif
                        <!-- <a href="javascript:void(0)" onclick="toggleFiles({{ $theme->id }})" class="enquete-link"> -->
                            <img src="{{ asset('storage/images/themes/' . $theme->image) }}" alt="Image de l'enquête" class="enquete-image">
                        <!-- </a> -->
                        <div class="enquete-info">
                            <!-- <a href="javascript:void(0)" onclick="toggleFiles({{ $theme->id }})" class="enquete-link"> -->
                                <h3 class="enquete-link">{{ $theme->nom }}</h3>
                            <!-- </a> -->
                            {{-- <p class='left-align'>{{ Str::limit($theme->description, 70) }}</p>
                            <p> <i class='far fa-clock me-2'></i> {{$theme->created_at->format('d M Y')}}</p> --}}
                        </div>
                    </div>
                    @php $delay += 100; @endphp
                @endforeach
            </div>

            <div class="pagination-wrapper">
                {{ $themes->links() }}
            </div>
            
        </div>
        @foreach($chunk as $theme)
            <div id="files-{{ $theme->id }}" class="file-card-container">
                <div class="file-card">
                    <button class="close-btn" onclick="closeFiles({{ $theme->id }})">&times;</button>
                    @if($theme->files->isNotEmpty())
                        
                        <div class="file-card-content">
                            <div class="file-card-table">
                                <div class="search-container">
                                    <input type="text" class="search-input file-search" placeholder="Rechercher un fichier..." onkeyup="filterFiles(this)">
                                    <a class="delete-button" onclick="clearSearch(this)"><i class="bi bi-x"></i></a>
                                    <i class="fas fa-search"></i>
                                </div>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Nom du fichier</th>
                                            <th>Description</th>
                                            {{-- <th>Enquête associée</th> --}}
                                            <th><i class="fas fa-download"></i></th>
                                            {{-- <th>Statut</th> --}}
                                            <th>Action</th>
                                            <th>Rapport d'analyse</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($theme->files as $fichier)
                                            @php
                                                $demande = $fichier->demandes()->where('user_id', auth()->id())->latest()->first();
                                                $enquete = $fichier->enquete;
                                            @endphp
                                            @if ($fichier->published)
                                                <tr>
                                                    <td>{{ $fichier->file_name }}</td>
                                                    <td>
                                                        @if($enquete)
                                                            <span class="enqueteAssocie">Enquête associée :</span>
                                                            <a href="{{ route('frontOffice.showFichiers', ['enqueteId' => $enquete->id]) }}" 
                                                            class="chaqueEnquete">
                                                                {{ $enquete->nom }}. <br>
                                                            </a>

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


                                                        @else
                                                            <span class="text-gray-400 italic">Aucune enquête</span>
                                                        @endif

                                                        <br><br>
                                                        {{ $fichier->description ?? 'Inconnue' }}
                                                    </td>
                                                
                                                    <td style="text-align: center;" class="nombreTelechargement">{{ $fichier->nombre }}</td>
                                                    <td class="text-center placeBoutton">
                                                        @if($fichier->type === 'sans_validation')
                                                            <a href="{{ route('sauvegarder.create', ['file_id' => $fichier->id]) }}" class="btn btn-success">Télécharger</a>
                                                        @else
                                                            @if(!$demande)
                                                                {{-- <a href="#" class="btn btn-secondary bouttonTheme" onclick="openModal({{ $fichier->id }})">Faire une demande</a> --}}
                                                                <a href="{{ route('demande.create', ['file_id' => $fichier->id]) }}" class="btn btn-secondary bouttonTheme">Faire une demande</a>
                                                            @else
                                                                @if($demande->status === 'valide')                                                        
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
                                <div id="paginationControls-{{ $theme->id }}" class="paginationControls">
                                    <div aria-label="Page navigation">
                                        <ul class="pagination">
                                            <li class="disabled page-link" id="prevPage-{{ $theme->id }}" onclick="prevPage({{ $theme->id }})">Précédent</li>
                                            <div id="pageNumbers-{{ $theme->id }}" class="d-flex"></div>
                                            <li class="page-link" id="nextPage-{{ $theme->id }}" onclick="nextPage({{ $theme->id }})">Suivant</li>
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
    @endforeach
    </div>

    @if($themes->isEmpty() && isset($_GET["search"]) && $_GET["search"] !== "")
        <div class="no-result">
            <p>Aucun thème trouvé.</p>
        </div>
    @endif
</div>


<div id="requestModal" class="modal">
    <div class="modal-content">
        <span class="close-btn" onclick="closeModal()">&times;</span>
        <h3>Faire une Demande</h3> 
        <form action="{{ route('downloads.demandeThemes', ['file' => 'ID']) }}" method="POST" id="requestForm">
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
            <input type="hidden" id="download_id" value="">

            <div class="form-group">
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
        <p>Conformément à la Loi n°2018-04 du 12 mars 2018 relative à l’organisation et à la règlementation des activités statistiques, 
        les données statistiques mises à disposition respectent les principes suivants :</p>
        <p><strong>- Confidentialité :</strong> les données diffusées sont anonymisées et ne permettent pas d’identifier directement ou indirectement une personne physique ou morale.</p>
        <p><strong>- Protection des données :</strong> Toute collecte, traitement et diffusion des données statistiques sont réalisés dans le respect des normes éthiques en vigueur, garantissant leur intégrité et leur sécurité.</p>
        <p><strong>- Utilisation légale :</strong> les données statistiques ne peuvent être exploitées qu’à des fins d’analyse, de recherche, ou d’évaluation dans cadre légal.</p>
        <p><h5>2. <u>Droits et responsabilités de l’utilisateur</u> :</h5></p>
        <p>Tout utilisateur des données s’engage à :</p>
        <p>- Respecter les principes de confidentialité et de protection des données définis par la Loi ;</p>
        <p>- Ne pas utiliser les données à des fins commerciales sans autorisation expresse de l’INSTAT ;</p>
        <p>- Ne pas altérer, falsifier ou modifier les données mises à disposition ;</p>
        <p><h5>3. <u>Limitation de responsabilité</u> :</h5></p>
        <p>- Toute analyse ou conclusion découlant de l’utilisation des données par 
        l’utilisateur ne peut engager la responsabilité de l’INSTAT.</p>
        <p>- L’INSTAT décline toute responsabilité quant aux conséquences découlant d’une 
            utilisation inappropriée, erronée ou frauduleuse des données mises en ligne.</p>
        <p>- L’INSTAT ne pourra être tenu responsable des erreurs, omissions ou délais dans la mise à jour des données.</p>

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

    // Updated JavaScript functions
    function toggleFiles(themeId) {

        if (themeId === original.id) {
            // If the same theme is clicked, restore the table
            restoreTable(original.id);
            original = {
                id: null,
                data: null,
                pageNumber: 1,
                pageSize: pageSize,
                currentPage: 1,
            }
        } else if (original.id !== null) {
            // If a different theme is clicked, initialize the pagination table
            restoreTable(original.id);
            original = {
                id: null,
                data: null,
                pageNumber: 1,
                pageSize: pageSize,
                currentPage: 1,
            }
            initPaginationTable(themeId);
        } else {
            // If no theme is clicked, initialize the pagination table
            initPaginationTable(themeId);
        }

        console.log("Toggling files for theme ID:", themeId); // Debug line
        const fileCard = document.getElementById(`files-${themeId}`);
        const card = document.getElementById(`card-${themeId}`);
        
        if (!fileCard || !card) {
            console.error("Could not find elements for theme ID:", themeId);
            return;
        }
        
        const isVisible = window.getComputedStyle(fileCard).display !== 'none';
        
        // Close all other open file cards
        document.querySelectorAll('.file-card-container').forEach(container => {
            if (container.id !== `files-${themeId}`) {
                container.style.display = 'none';
                container.classList.remove('slide-down');
            }
        });
        
        // Remove selection from all cards
        document.querySelectorAll('.enquete-card').forEach(c => {
            if (c.id !== `card-${themeId}`) {
                c.classList.remove('selected');
            }
        });
        
        if (isVisible) {
            fileCard.style.display = 'none';
            fileCard.classList.remove('slide-down');
            card.classList.remove('selected');
        } else {
            fileCard.style.display = 'block';
            card.classList.add('selected');
            
            // Add animation
            setTimeout(() => {
                fileCard.classList.add('slide-down');
                
                // Scroll to file container
                fileCard.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }, 10);
        }
    }

    function restoreTable(themeId) {
        console.log(original.data); // Debug line
        if (original.data) {
            $(`#files-${themeId} table`).empty();
            $(`#files-${themeId} table`).append(original.data.clone());
        }
    }

    function initPaginationTable(themeId) {
        original = {
            id: null,
            data: null,
            pageNumber: 1,
            pageSize: pageSize,
            currentPage: 1,
        }

        //// Pagination dynamic

        const rowsArray = $(`#files-${themeId} table tr`).clone();

        original.id = themeId
        original.data = rowsArray.clone()
        
        
        const head = original.data.slice(0,1).clone()
        const tempData = original.data.slice(1,original.pageSize + 1).clone()
        
        $(`#files-${themeId} table`).empty()
        $(`#files-${themeId} table`).prepend($('<thead>').append(head));
        $(`#files-${themeId} table`).append($('<tbody>').append(tempData));

        original.pageNumber = Math.ceil((original.data.length - 1) / original.pageSize);

        const pageNumbersContainer = document.getElementById(`pageNumbers-${themeId}`);
        
        if (original.pageNumber <= 1) {
            document.getElementById(`paginationControls-${themeId}`).style.display = "none";
        } else {
            document.getElementById(`paginationControls-${themeId}`).style.display = "flex";
        }

        pageNumbersContainer.innerHTML = '';
        
        for (let i = 0; i < original.pageNumber; i++) {
            const pageNumber = document.createElement('span');
            pageNumber.textContent = i + 1;
            pageNumber.className = 'page-number';
            pageNumber.dataset.page = i + 1;
            pageNumber.onclick = function() {
                changePage(themeId, i + 1);
            };
            pageNumbersContainer.appendChild(pageNumber);
        }

        $(`#pageNumbers-${themeId} .page-number:first-child`).addClass("active")

        //// End Pagination dynamic
    }

    // Change page function
    function changePage(themeId, pageNumber) {

        $(`#pageNumbers-${themeId} .page-number:nth-child(${original.currentPage})`).removeClass("active")
        $(`#pageNumbers-${themeId} .page-number:nth-child(${pageNumber})`).addClass("active")

        const begin = (pageNumber - 1) * original.pageSize + 1;

        const end = begin + original.pageSize;
        const head = original.data.slice(0,1).clone()
        const tempData = original.data.slice(begin, end).clone()
        
        $(`#files-${themeId} table`).empty()
        $(`#files-${themeId} table`).prepend($('<thead>').append(head));
        $(`#files-${themeId} table`).append($('<tbody>').append(tempData));

        
        original.currentPage = pageNumber;
        console.log("Changing page to:", pageNumber, "for theme ID:", themeId); // Debug line

        if (pageNumber === original.pageNumber) {
            $(`#nextPage-${themeId}`).addClass('disabled');
        } else {
            $(`#nextPage-${themeId}`).removeClass('disabled');
        }
        if (pageNumber === 1) {
            $(`#prevPage-${themeId}`).addClass('disabled');
        } else {
            $(`#prevPage-${themeId}`).removeClass('disabled');
        }
    }

    function nextPage(themeId) {
        const nextPage = original.currentPage + 1;
        if (nextPage <= original.pageNumber) {
            changePage(themeId, nextPage);
        }
    }

    function prevPage(themeId) {
        const prevPage = original.currentPage - 1;
        if (prevPage >= 1) {
            changePage(themeId, prevPage);
        }
    }

    function closeFiles(themeId) {
        const fileCard = document.getElementById(`files-${themeId}`);
        const card = document.getElementById(`card-${themeId}`);
        
        restoreTable(themeId)
        original = {
            id: null,
            data: null,
            pageNumber: 1,
            pageSize: pageSize,
            currentPage: 1,
        }
        
        if (fileCard && card) {
            fileCard.style.display = 'none';
            fileCard.classList.remove('slide-down');
            card.classList.remove('selected');
        }
    }
    function filterFiles(input) {

        const tableTemp = input.closest('div').nextElementSibling
        const paginationDiv = tableTemp.nextElementSibling
        const themeId = paginationDiv.id.split('-')[1]
        paginationDiv.style.display = "none"

        $(tableTemp).empty();
        $(tableTemp).append(original.data.clone());

        const value = input.value.trim();
        if (value === '') {

            initPaginationTable(themeId)

            $(".search-container .delete-button").hide();
            $(".search-container .delete-button1").hide();
        } else {
            
            // return
            
            $(".search-container .delete-button").show();
            $(".search-container .delete-button1").show();
        }

        const searchTerm = input.value.toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, '');
        const table = input.closest('div').nextElementSibling;
        const rows = table.querySelectorAll('tr');

        rows.forEach(row => {
            const nameCell = row.querySelector('td:nth-child(1)');
            const descriptionCell = row.querySelector('td:nth-child(2)');
            const enqueteCell = row.querySelector('td:nth-child(3)');
            const statusCell = row.querySelector('td:nth-child(4)');
            const nameText = nameCell ? nameCell.textContent.toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, '') : '';
            const descriptionText = descriptionCell ? descriptionCell.textContent.toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, '') : '';
            const enqueteText = enqueteCell ? enqueteCell.textContent.toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, '') : '';
            const statusText = statusCell ? statusCell.textContent.toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, '') : '';
            const match = nameText.includes(searchTerm) || descriptionText.includes(searchTerm) || statusText.includes(searchTerm) || enqueteText.includes(searchTerm);
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
        form.action = form.action.replace('ID', fileId);
        
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
    document.addEventListener('DOMContentLoaded', function() {
        console.log("Page loaded, checking for theme cards");
        const cards = document.querySelectorAll('.enquete-card');
        console.log(`Found ${cards.length} theme cards`);
    });
</script>
@endsection