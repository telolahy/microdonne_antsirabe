@extends('layouts.app')

@section('content')
<div class="container">
    <div class="notification-header d-flex justify-content-between align-items-center mb-4">
        <h1 class="mb-0">Notifications</h1>
        <div class="badge bg-primary">{{ $downloads->count() }} demande(s)</div>
    </div>

    @if($downloads->isEmpty())
        <div class="alert alert-info">
            <i class="fas fa-info-circle me-2"></i>Aucun téléchargement trouvé.
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle"> 
                <thead class="table-dark">
                    <tr style="background-color:#333;">
                        <th scope="col" class="ps-4">Demandeur</th>
                        <th scope="col">Fichier</th>
                        <th scope="col">Enquêtes</th>
                        <th scope="col" class="text-end pe-4">Date de mise à jour</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($downloads as $download)
                        <tr>
                            <td class="ps-4 fw-medium">{{ $download->demandeur->name ?? 'Inconnu' }}</td>
                            <td>
                                <a href="{{ route('files.downloads', $download->file_id) }}" class="btn btn-succes d-flex align-items-center">
                                    <i class="fas fa-file-alt me-2 text-primary"></i>
                                    <span>{{ $download->file->file_name ?? 'Fichier non trouvé' }}</span>
                                </a>
                            </td>
                            <td>
                                    {{ $download->file->enquete->nom ?? 'N/A' }}
                            </td>
                            <td class="text-end pe-4 text-muted">
                                <i class="far fa-clock me-2"></i>{{ $download->updated_at->format('d/m/Y H:i') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            

        </div>
        <div class="d-flex justify-content-center mt-4">
                {{ $downloads->links() }}
            </div>
    @endif
</div>

<style>
    body {
        background-color: #f8f9fa;
    }
    
    .container {
        max-width: 1200px;
        padding-top: 2rem;
        padding-bottom: 2rem;
    }
    
    .notification-header {
        padding-bottom: 1rem;
        border-bottom: 1px solid #e0e0e0;
    }
    
    h1 {
        color: #2c3e50;
        font-weight: 600;
        font-size: 1.8rem;
    }
    
    .table-responsive {
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }
    
    .table {
        margin-bottom: 0;
        font-size: 0.925rem;
    }
    
    .table-dark {
        background-color: #2c3e50;
    }
    
    .table-dark th {
        border-bottom: none;
        font-weight: 500;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 0.5px;
    }
    
    .table-striped tbody tr:nth-of-type(odd) {
        background-color: rgba(240, 240, 240, 0.5);
    }
    
    .table-hover tbody tr:hover {
        background-color: rgba(44, 62, 80, 0.05) !important;
    }
    
    .badge {
        font-weight: 500;
        padding: 0.35em 0.65em;
        font-size: 0.75em;
        color: #fff;
    }
    
    .alert-info {
        background-color: #e8f4f8;
        border-color: #d1ecf1;
        color: #0c5460;
        border-radius: 6px;
    }
    
    .text-muted {
        color: #6c757d !important;
    }
    
    .fa-file-alt, .fa-clock {
        font-size: 0.9rem;
    }
    
    @media (max-width: 768px) {
        .container {
            padding: 1rem;
        }
        
        h1 {
            font-size: 1.5rem;
        }
        
        .table-responsive {
            border-radius: 0;
        }
    }
</style>

<!-- Inclure Font Awesome pour les icônes -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
@endsection