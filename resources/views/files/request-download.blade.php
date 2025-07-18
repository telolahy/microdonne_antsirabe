@extends('layouts.app')

@section('content')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Microdonnées INSTAT Madagascar</title>
    <style>
        :root {
            --instat-primary: #2c3e50;
            --instat-secondary: #e67e22;
            --instat-accent: #3498db;
            --instat-light: #ecf0f1;
            --instat-dark: #34495e;
            --instat-success: #27ae60;
            --instat-danger: #e74c3c;
        }
        
        /* Base styles */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            color: #495057;
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }
        
        .container {
            max-width: 1140px;
            margin: 200px auto 30px;
            padding: 0 15px;
        }
        
        /* Typography */
        h1, h2, h3, h4, h5, h6 { color: var(--instat-primary); font-weight: 600; }
        h5 { 
            font-size: 1.25rem; 
            margin-bottom: 1rem; 
            color: var(--instat-dark); 
            border-bottom: 2px solid var(--instat-secondary); 
            padding-bottom: 0.5rem; 
        }
        
        /* Card styles */
        .card {
            border: none;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
        }
        .card-body { padding: 2rem; }
        
        /* Layout */
        .row { display: flex; flex-wrap: wrap; margin: 0 -15px; }
        .col-left, .col-right { flex: 0 0 50%; max-width: 50%; padding: 0 15px; margin-bottom: 20px; }
        
        /* Form elements */
        .form-group { margin-bottom: 1.5rem; }
        .form-control {
            display: block;
            width: 100%;
            padding: 0.75rem 1rem;
            font-size: 1rem;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            border: 1px solid #ced4da;
            border-radius: 4px;
            transition: border-color 0.15s ease, box-shadow 0.15s ease;
        }
        .form-control:focus {
            border-color: var(--instat-secondary);
            outline: 0;
            box-shadow: 0 0 0 0.2rem rgba(230, 126, 34, 0.25);
        }
        
        /* Alerts */
        .alert {
            position: relative;
            padding: 0.75rem 1.25rem;
            margin-bottom: 1rem;
            border: 1px solid transparent;
            border-radius: 4px;
            font-size: 0.9rem;
        }
        .alert-danger { color: #721c24; background-color: #f8d7da; border-color: #f5c6cb; }
        .alert-success { color: #155724; background-color: #d4edda; border-color: #c3e6cb; }
        
        /* List styles */
        .list-unstyled { padding-left: 0; list-style: none; }
        .list-unstyled li { margin-bottom: 0.75rem; display: flex; }
        .list-unstyled strong { min-width: 120px; color: var(--instat-primary); }
        
        /* Buttons */
        .btn {
            display: inline-block;
            font-weight: 600;
            text-align: center;
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
            border-radius: 4px;
            transition: all 0.3s ease;
            cursor: pointer;
            text-transform: uppercase;
        }
        .btn-primary {
            color: #fff;
            background-color: var(--instat-primary);
            border: 1px solid var(--instat-primary);
        }
        .btn-primary:hover { background-color: #1a252f; transform: translateY(-2px); }
        .btn-secondary {
            color: #fff;
            background-color: var(--instat-dark);
            border: 1px solid var(--instat-dark);
        }
        .btn-secondary:hover { background-color: #2c3e50; transform: translateY(-2px); }
        
        /* Badge */
        .badge {
            display: inline-block;
            padding: 0.35em 0.65em;
            font-size: 0.75em;
            font-weight: 700;
            border-radius: 0.25rem;
        }
        .badge-info { 
            color: #fff; 
            background-color: var(--instat-accent);
            animation: pulse 2s infinite;
        }
        
        /* Modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1050;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.4);
        }
        .modal-content {
            background-color: #fefefe;
            margin: 10% auto;
            padding: 20px;
            width: 80%;
            max-width: 700px;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        }
        .modal-header, .modal-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
        }
        .modal-header { border-bottom: 1px solid #eee; }
        .modal-footer { border-top: 1px solid #eee; text-align: right; }
        .modal-body { max-height: 60vh; overflow-y: auto; padding: 10px 0; }
        .close { color: #aaa; font-size: 28px; cursor: pointer; }
        .close:hover { color: var(--instat-danger); }
        
        /* Terms checkbox */
        .terms-checkbox { margin: 1rem 0; }
        .terms-checkbox label { display: flex; align-items: center; cursor: pointer; }
        .terms-checkbox input { margin-right: 10px; }
        .terms-link { 
            color: var(--instat-accent); 
            text-decoration: underline; 
            cursor: pointer; 
        }
        .terms-link:hover { color: var(--instat-secondary); }
        
        /* Animations */
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .container { margin-top: 80px; }
            .col-left, .col-right { flex: 0 0 100%; max-width: 100%; }
            .btn { padding: 0.5rem 1rem; font-size: 0.9rem; }
        }
        
        /* Navbar */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: #333; 
            z-index: 1000; 
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); 
        }
        
        /* Icons */
        .download-icon { margin-left: 0.5rem; color: var(--instat-secondary); }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>
<div class="container">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-left">
                <h5><i class="fas fa-info-circle mr-2"></i>Informations du Microdonnée</h5>
                    <ul class="list-unstyled">
                        <li><strong>Nom :</strong> <span>{{ $file->file_name }}</span></li>
                        <li><strong>Description :</strong> <span>{{ Str::limit($file->description, 100) }}</span></li>
                        <li><strong>Créé le :</strong> <span>{{ $file->created_at->format('d M Y') }}</span></li>
                        <li><strong>Téléchargements :</strong> <span>{{ $file->nombre }} <i class="fas fa-download download-icon"></i></span></li>
                    </ul>
                    
                    @if($isNew)
                        <div class="mt-3">
                            <span class="badge badge-info">
                                <i class="fas fa-certificate mr-1"></i>Nouveau
                            </span>
                        </div>
                    @endif
                    
                    <div class="btn-container">
                        <button onclick="history.back()" class="btn btn-secondary">
                            <i class="fas fa-arrow-left mr-2"></i>Retour
                        </button>
                    </div>
                </div>
                <div class="col-right">
                <h5><i class="fas fa-link mr-2"></i>Obtenir le lien de téléchargement</h5>
                    <p class="text-muted mb-4">Veuillez saisir votre adresse e-mail pour recevoir le lien de téléchargement.</p>

                    @if ($errors->has('email'))
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-circle mr-2"></i>{{ $errors->first('email') }}
                        </div>
                    @endif

                    @if(session('success'))
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('file.send', $file->id) }}" method="POST" id="downloadForm">
                        @csrf
                        <div class="form-group">
                            <label for="email" class="font-weight-bold">Adresse e-mail</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="exemple@gmail.com" required>
                        </div>
                        
                        <div class="terms-checkbox">
                            <label>
                                <input type="checkbox" name="terms" id="terms" required>
                                J'accepte les <span class="terms-link" onclick="openModal()">conditions générales</span>
                            </label>
                        </div>
                        
                        <button type="submit" class="btn btn-primary btn-block">
                            <i class="fas fa-paper-plane mr-2"></i>Envoyer
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="termsModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Conditions Générales d'Utilisation</h5>
            <span class="close" onclick="closeModal()">&times;</span>
        </div>
        <div class="modal-body">
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
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" onclick="closeModal()">J'ai compris</button>
        </div>
    </div>
</div>
<script>
    function openModal() {
        document.getElementById('termsModal').style.display = 'block';
    }

    function closeModal() {
        document.getElementById('termsModal').style.display = 'none';
    }

    window.onclick = function(event) {
        const modal = document.getElementById('termsModal');
        if (event.target == modal) {
            closeModal();
        }
    }
    document.getElementById('downloadForm').addEventListener('submit', function(e) {
        const checkbox = document.getElementById('terms');
        if (!checkbox.checked) {
            e.preventDefault();
            alert('Veuillez accepter les conditions générales avant de continuer.');
        }
    });
</script>
</body>
@endsection