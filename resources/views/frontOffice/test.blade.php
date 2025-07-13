@extends('layouts.app')

@section('content')
<style>
    .page-title {
        font-size: 32px;
        font-weight: 700;
        color: #2c3e50;
        text-align: left;
        margin-bottom: 10px;
        letter-spacing: 1px;
    }
    .container{
        margin-left: 400px; 
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

    .enquetes-container {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: flex-start;
        overflow-x: auto;
        margin-left: 0px; 
    }

    .enquete-card {
        flex: 1 1 calc(25% - 20px); 
        max-width: calc(25% - 20px);
        padding: 15px;
        background-color: rgb(223, 223, 220);
        box-sizing: border-box;
    }

    .enquete-image {
        width: 100%;
        height: auto;
        max-height: 150px;
        object-fit: cover;
        margin-bottom: 15px;
    }
    .enquete-link {
        color: rgb(199, 176, 24);
        text-decoration: none;
        font-size: 18px;
        font-weight: 600;
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
        margin-top: 30px;
        width: 100%;
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
        background-color:rgb(154, 129, 54);
    }

    .btn {
        display: inline-block;
        padding: 12px 20px;
        margin-top: 15px;
        text-align: center;
        font-size: 16px;
        border-radius: 6px;
        text-decoration: none;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.3s ease;
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
    }

    .pagination a,
    .pagination span {
        border: 1px solid;
        padding: 10px;
        margin: 2px;
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
    
    .second-row {
        margin-top: 30px;
        width: 100%;
    }
    
    .enquete-card.selected {
        border: 2px solid #2c3e50;
        box-shadow: 0 0 10px rgba(44, 62, 80, 0.5);
    }

</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<div class="enquetes-section">
    <div class="header-section">
        <h1 class="page-title">Enquetes</h1>
        <div class="search-container">
            <form method="GET" action="{{ route('showEnquetes') }}">
                <input type="text" name="search" class="search-input" placeholder="Rechercher..." value="{{ request('search') }}">
                <button type="submit" class="search-btn"><i class="fas fa-search"></i></button>
            </form>
        </div>
    </div>
    
    <div class="underline"></div>


    <div class="enquetes-container">
        @foreach($enquetes->take(4) as $enquete)
            @php
                $isNew = $enquete->fichiers->where('created_at', '>=', now()->subMonth())->isNotEmpty();
            @endphp

            <div class="enquete-card {{ request('enqueteId') == $enquete->id ? 'selected' : '' }}" id="enquete-{{ $enquete->id }}">
                @if($isNew)
                    <div class="badge-container">
                        <span class="badge badge-danger">Nouveau</span>
                    </div>
                @endif
                <a href="{{ route('frontOffice.showFichiers', ['enqueteId' => $enquete->id]) }}" class="enquete-link">
                    <img src="{{ asset('storage/images/enquetes/' . $enquete->images) }}" alt="Image de l'enquête" class="enquete-image">
                </a>
                <div class="enquete-info">
                    <a href="{{ route('frontOffice.showFichiers', ['enqueteId' => $enquete->id]) }}" class="enquete-link">
                        <h3>{{ $enquete->nom }}</h3>
                    </a>
                    <p class='left-align'>{{ Str::limit($enquete->description, 70) }}</p>
                    <p>Total de téléchargements: {{ $enquete->fichiers->sum('nombre') }} <i class="fas fa-download"></i></p>
                    <a href="{{ route('enquetes.show.enquetes', $enquete->id) }}" class="no-underline-link left-align">
                        <i class="bi bi-arrow-right-circle arrow-icon"></i> Plus de détails
                    </a>
                </div>
            </div>
        @endforeach
    </div>

    @if(isset($fichiers) && $fichiers->isNotEmpty())
        <div class="file-card-container">
            <div class="file-card">
                <button class="close-btn" onclick="closeCard()">&times;</button>
                @if($fichiers->first()->enquete)
                    <p>{{ $fichiers->first()->enquete->description }}</p>
                @else
                    <p>Description non disponible</p>
                @endif

                <div class="file-card-content">
                    <div class="file-card-table">
                        <form method="GET" action="" style="display: flex; float: right; max-width: 300px; width: 100%;">
                            <input type="text" name="search" class="search-input" placeholder="Rechercher..." value="{{ request('search') }}" style="padding: 8px 12px; border: 1px solid #ddd; border-radius: 4px 0 0 4px; flex-grow: 1; outline: none;">
                            <button type="submit" class="search-btn" style="padding: 8px 12px; background: #007bff; color: white; border: none; border-radius: 0 4px 4px 0; cursor: pointer;">
                                <i class="fas fa-search"></i>
                            </button>
                        </form><br><br>
                        <table>
                            <thead>
                                <tr>
                                    <th>Nom du fichier</th>
                                    <th>Description</th>
                                    <th>Nombre <i class="fas fa-download"></i></th>
                                    <th>Statut</th>
                                    <th>Action</th>
                                    <th>Rapport d'analyses</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($fichiers as $fichier)
                                    @php
                                        $demande = $fichier->demandes()->where('user_id', auth()->id())->latest()->first();
                                    @endphp
                                    <tr>
                                        <td>{{ $fichier->file_name }}</td>
                                        <td>{{ $fichier->description ?? 'Inconnue' }}</td>
                                        <td><i class="fas fa-download"></i> {{ $fichier->nombre }}</td>
                                        <td>
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
                                                    <span class="badge badge-secondary">vous devez faire une demande</span>
                                                @endif
                                            @endif
                                        </td>
                                        <td>
                                            @if(!$demande)
                                                @if($fichier->type === 'sans_validation')
                                                    <a href="{{ route('file.request', $fichier) }}" class="btn btn-success">Télécharger</a>
                                                @elseif($fichier->type === 'avec_validation')
                                                    <a href="#" class="btn btn-secondary" onclick="openModal({{ $fichier->id }})">Faire Demande</a>
                                                @endif
                                            @else
                                                @if($demande->status === 'valide')
                                                    <a href="{{ route('file.request', $fichier) }}" class="btn btn-success">Télécharger</a>
                                                @elseif($demande->status === 'rejete')
                                                    <span>Vous ne pouvez pas télécharger ce fichier</span>
                                                @else
                                                    <span class="btn btn-warning" style="cursor: not-allowed;">Demande en attente</span>
                                                @endif
                                            @endif
                                        </td>
                                        <td>
                                            @if($demande && $demande->status !== 'rejete' && $demande->status !== 'en_attente' && $fichier->type !== 'sans_validation')
                                                <a href="#" class="btn btn-primary" onclick="openReportModal({{ $fichier->id }})">Envoyer rapport</a>
                                            @else
                                                <button class="btn btn-primary" disabled>Envoyer rapport</button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div style="display: flex; justify-content: flex-end; margin-top: 20px;">
                            {{ $fichiers->appends(request()->query())->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @elseif(isset($fichiers))
        <p class="no-files-message">Aucun fichier associé à cette enquête.</p>
    @endif

    @if($enquetes->count() > 4)
        <div class="second-row">
            <div class="enquetes-container">
                @foreach($enquetes->slice(4, 4) as $enquete)
                    @php
                        $isNew = $enquete->fichiers->where('created_at', '>=', now()->subMonth())->isNotEmpty();
                    @endphp

                    <div class="enquete-card {{ request('enqueteId') == $enquete->id ? 'selected' : '' }}" id="enquete-{{ $enquete->id }}">
                        @if($isNew)
                            <div class="badge-container">
                                <span class="badge badge-danger">Nouveau</span>
                            </div>
                        @endif
                        <a href="{{ route('frontOffice.showFichiers', ['enqueteId' => $enquete->id]) }}" class="enquete-link">
                            <img src="{{ asset('storage/images/enquetes/' . $enquete->images) }}" alt="Image de l'enquête" class="enquete-image">
                        </a>
                        <div class="enquete-info">
                            <a href="{{ route('frontOffice.showFichiers', ['enqueteId' => $enquete->id]) }}" class="enquete-link">
                                <h3>{{ $enquete->nom }}</h3>
                            </a>
                            <p class='left-align'>{{ Str::limit($enquete->description, 70) }}</p>
                            <p>Total de téléchargements: {{ $enquete->fichiers->sum('nombre') }} <i class="fas fa-download"></i></p>
                            <a href="{{ route('enquetes.show.enquetes', $enquete->id) }}" class="no-underline-link left-align">
                                <i class="bi bi-arrow-right-circle arrow-icon"></i> Plus de détails
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <div class="pagination-wrapper">
        {{ $enquetes->appends(request()->query())->links() }}
    </div>
    <!-- Modal: Demande -->
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

    <!-- Modal: Rapport -->
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
    function openReportModal(fileId) {
        const modal = document.getElementById('reportModal');
        document.getElementById('download_id').value = fileId;
        modal.style.display = 'block';
    }

    function closeReportModal() {
        document.getElementById('reportModal').style.display = 'none';
    }
    
    function closeCard() {
        document.querySelector('.file-card-container').style.display = 'none';
        document.querySelectorAll('.enquete-card').forEach(card => {
            card.classList.remove('selected');
        });
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

    document.addEventListener('DOMContentLoaded', function() {
        const cards = document.querySelectorAll('.enquete-card');
        cards.forEach(card => {
            card.addEventListener('click', function() {
                cards.forEach(c => c.classList.remove('selected'));
                this.classList.add('selected');
            });
        });
    });
    </script>
@endsection