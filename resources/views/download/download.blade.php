@extends('layouts.app')

@section('content')

<style>
    .conditionUtilisation{
        font-weight: bold;
    }

    .obligatoire{
        color: red;
        font-size: 1.2rem;
    }

    .champObli{
        font-size: 0.8rem;
        color: #666;
    }
    
    #submitBtn {
        width: 100%;
        max-width: 300px; /* Limite la largeur maximale */
        padding: 12px 20px; /* Padding proportionnel */
        font-size: 1rem; /* Taille de police par défaut */
        display: block;
        margin: 0 auto; /* Centrer le bouton */
        transition: all 0.3s ease; /* Transition fluide pour les changements */
        white-space: nowrap; /* Empêche le texte de se couper ou de passer à la ligne */
        overflow: hidden; /* Cache tout débordement */
    }

    /* Media query pour écrans moyens */
    @media (max-width: 768px) {
        #submitBtn {
            max-width: 260px; /* Légèrement plus petit pour écrans moyens */
            font-size: 0.9rem;
        }
    }

    /* Media query pour petits écrans */
    @media (max-width: 576px) {
        #submitBtn.btn.btn-primary {
            max-width: 220px; /* Réduit la largeur sur mobile */
            padding: 10px 15px; /* Réduit le padding */
            font-size: 0.85rem !important; /* Force la taille de police */
            display: flex; /* Utilise flex pour aligner icône et texte */
            align-items: center; /* Centre verticalement */
            justify-content: center; /* Centre horizontalement */
        }

        #submitBtn i {
            font-size: 0.85rem; /* Réduit la taille de l'icône */
            margin-right: 8px; /* Espace entre l'icône et le texte */
        }

        .card-body {
            padding: 15px; /* Réduit le padding de la carte sur mobile */
        }

        h2.text-primary {
            font-size: 1.4rem; /* Réduit la taille du titre sur mobile */
        }
    }

    /* Media query pour très petits écrans */
    @media (max-width: 360px) {
        #submitBtn.btn.btn-primary {
            max-width: 200px; /* Réduit davantage la largeur */
            padding: 8px 10px; /* Réduit le padding */
            font-size: 0.65rem !important; /* Taille de police ajustée pour lisibilité */
            display: flex; /* Utilise flex pour aligner icône et texte */
            align-items: center; /* Centre verticalement */
            justify-content: center; /* Centre horizontalement */
        }

        #submitBtn i {
            font-size: 0.65rem; /* Réduit la taille de l'icône */
            margin-right: 5px; /* Réduit l'espace entre l'icône et le texte */
        }
    }
</style>

<div class="container py-5">
    <div class="card shadow-lg border-0">
        <div class="card-body p-5">
            <h2 class="mb-4 text-center text-primary">Téléchargement de {{$file->file_name}}</h2>
            @if ($errors->any())
            <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('sauvegarder.store') }}" id="downloadForm">
                @csrf
                <input type="hidden" name="file_id" value="{{$file_id }}">
                <!-- Motif de la demande -->
                <div class="mb-4" id="motif-section">
                    <label for="motif" class="form-label fw-bold">Motifs du téléchargement:<span class="obligatoire">*</span></label>
                    <textarea name="motif" id="motif" class="form-control" rows="4" required placeholder="Expliquez pourquoi vous souhaitez accéder à ce fichier..."></textarea>
                </div>

                <!-- Conditions -->
                <div class="mb-4">
                    <h4 class="text-secondary mb-3">Conditions générales d'utilisation</h4>

                    <div class="mb-3">
                        <h6 class="fw-bold"><u>1. Principe de confidentialité et protection des données :</u></h6>
                        <ul>
                            <li><strong>Confidentialité :</strong> les données diffusées sont anonymisées.</li>
                            <li><strong>Protection :</strong> traitement conforme aux normes éthiques.</li>
                            <li><strong>Usage légal :</strong> à des fins d’analyse ou de recherche uniquement.</li>
                        </ul>
                    </div>

                    <div class="mb-3">
                        <h6 class="fw-bold"><u>2. Droits et responsabilités de l’utilisateur :</u></h6>
                        <ul>
                            <li>Respect des principes de confidentialité.</li>
                            <li>Interdiction d’usage commercial sans autorisation.</li>
                            <li>Interdiction de falsification des données.</li>
                        </ul>
                    </div>

                    <div class="mb-3">
                        <h6 class="fw-bold"><u>3. Limitation de responsabilité :</u></h6>
                        <ul>
                            <li>L’INSTAT décline toute responsabilité en cas de mauvaise utilisation.</li>
                            <li>Aucune garantie sur l’exactitude ou la mise à jour des données.</li>
                        </ul>
                    </div>
                </div>

                <!-- Acceptation des CGU -->
                <div class="form-check mb-4">
                    <input type="checkbox" class="form-check-input" id="cgu" name="terms">
                    <label class="form-check-label" for="cgu">
                        J'accepte les <span class="conditionUtilisation">conditions générales d'utilisation</span>.
                    </label>
                </div>
                <!-- Submit -->
                <div class="text-center">
                    <button type="submit" class="btn btn-primary" id="submitBtn" disabled>
                        <i class="bi bi-download me-2"></i> Télécharger maintenant
                    </button>
                </div>
                <p class="champObli"><span class="obligatoire">* </span>Champ obligatoire</p>
            </form>
        </div>
    </div>
</div>

<!-- Script -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const checkbox = document.getElementById('cgu');
        const submitBtn = document.getElementById('submitBtn');
        const form = document.getElementById('downloadForm');
        const motifSection = document.getElementById('motif-section');

        // Enable/disable submit button based on checkbox
        checkbox.addEventListener('change', function () {
            submitBtn.disabled = !this.checked;
        });

        // Hide motif section on form submission
        form.addEventListener('submit', function (event) {
            // Hide the motif section just before submission
            motifSection.style.display = 'none';
            // Do not prevent default; allow form to submit
        });
    });

    function accepted() {
        document.getElementById('cgu').checked = true;
        document.getElementById('submitBtn').disabled = false;
    }
</script>

@endsection