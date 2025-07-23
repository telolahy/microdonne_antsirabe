{{-- Stagiaire --}}
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
            overflow-x: hidden;
            padding-top: 100px;
        }
        .containerUser {
            background-color: #f4f4f4;
            color: #333;
            text-align: center;
            padding: 0px;
            margin-left: 0px; 
            margin-top: 0px;
            min-height: 50vh;
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
        .role-form {
            margin: 0;
            padding: 0;
        }

        .custom-role-select {
            padding: 5px 10px;
            font-size: 13px;
            border-radius: 6px;
            background-color: #f8f9fa;
            border: 1px solid #ced4da;
            transition: 0.3s;
            max-width: 150px;
            min-width: 120px;
        }

        .custom-role-select:hover {
            background-color: #e2e6ea;
            border-color: #adb5bd;
            cursor: pointer;
        }

        .custom-role-select:focus {
            border-color: #495057;
            box-shadow: 0 0 0 0.1rem rgba(0,0,0,.1);
        }

        html, body {
            overflow-y: auto;
            overflow-x: hidden;
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
        .title-container {
            margin-top: 35px;
        }
        .file-table {
            margin-bottom: 40px;
        }
        .no-result {
            text-align: center;
            font-size: 28px;
            color: #888;
            margin-top: 15vh;
            padding-bottom: 15vh;
        }
        .close-search {
            position: absolute;
            font-size: 25px;
            margin-right: 140px;
        }
        .underline {
            width: 100%;
            height: 4px;
            background-color: rgb(22, 18, 4);
            margin-bottom: 30px;
        }
        @media (max-width: 768px) {
            .file-table th, .file-table td {
                padding: 10px;
                font-size: 12px;
            }
            .custom-role-select {
                max-width: 100px;
                min-width: 80px;
            }
            .search-container, .search-container form {
                width: 100%;
            }
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
                background-color: #f9f9f9;
            }

            .file-table tbody td {
                display: flex;
                justify-content: space-between;
                padding: 0.5rem 0;
                border: none;
            }

            .file-table tbody td::before {
                content: attr(data-label);
                font-weight: bold;
                flex-basis: 45%;
                text-align: left;
                color: #333;
            }

            .file-table tbody td:last-child {
                flex-direction: column;
                gap: 0.5rem;
            }

            .actionGestionnaire {
                flex-direction: row!important;
            }

        }
    </style>
</head>

<body>
    <div class="containerUser">
        <div class="d-flex justify-content-between title-container flex-column flex-md-row">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h1><b>Gestion des utilisateurs</b></h1>
            </div>
    
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif

                @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <div class="d-flex justify-content-between align-items-center search-container">
                <form method="GET" action="{{ route('users.index') }}" class="d-flex justify-content-end mb-4">
                    <input type="text" name="search" placeholder="Rechercher..." class="form-control mr-2" value="{{ request()->get('search') }}">
                    @if (isset($_GET['search']) && $_GET['search'] !== '')
                        <a href="{{ route('users.index') }}" class="close-search"><i class="bi bi-x"></i></a>
                    @endif
                    <button type="submit" class="btn btn-dark">Rechercher</button>
                </form>
            </div>
        </div>

        <div class="underline"></div>

        @if (isset($_GET['search']) && $_GET['search'] !== '')
            <div class="alert">
                <h5>Résultats de la recherche pour : <strong>{{ $_GET['search'] }}</strong></h5>
            </div>
        @endif

        @if (!$users->isEmpty())
            <table class="file-table">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Rôle</th>
                        <th>Date de création</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                   <tr>
    <td data-label="Nom">{{ $user->name }}</td>
    <td data-label="Email">{{ $user->email }}</td>
    <td data-label="Rôle">
        {{ $directions[$user->direction_id] ?? 'Non défini' }}
    </td>
    <td data-label="Date de création">{{ $user->created_at->format('d/m/Y') }}</td>

    <td data-label="Actions" style="display: flex; align-items: center; gap: 8px;" class="actionGestionnaire">


        <div class="d-flex" style="gap: 8px;">
            {{-- Changer le rôle --}}
            {{-- Voir profil --}}
            <a href="{{ route('users.show', $user->id) }}" title="Voir Profil" class="btn btn-outline-secondary btn-sm" style="padding: 4px 8px;">
                <i class="fas fa-eye"></i>
            </a>

            {{-- Modifier (EDIT) --}}
            <a href="{{ route('users.edit', $user->id) }}" title="Éditer" class="btn btn-outline-primary btn-sm" style="padding: 4px 8px;">
                <i class="fas fa-edit"></i>
            </a>

            {{-- Supprimer --}}
            <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="margin: 0;" onsubmit="return confirm('Supprimer cet utilisateur ?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger btn-sm" title="Supprimer" style="padding: 4px 8px;">
                    <i class="fas fa-trash-alt"></i>
                </button>
            </form>
        </div>

    </td>
</tr>







                    @endforeach
                </tbody>
            </table>
        @endif

        @if($users->isEmpty() && isset($_GET["search"]) && $_GET["search"] !== "")
            <div class="no-result">
                <p>Aucun résultat trouvé.</p>
            </div>
        @endif
        
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const directions = @json($directions); // Exporte les noms côté JS (clé = id)
    
        function confirmDropdownChange(selectElement, userId, userName) {
            const selectedDirectionId = selectElement.value;
            const oldDirectionId = selectElement.dataset.oldValue;
    
            const selectedDirectionName = directions[selectedDirectionId];
    
            Swal.fire({
                title: 'Confirmation',
                text: `Changer le rôle de ${userName} en "${selectedDirectionName}" ?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Oui',
                cancelButtonText: 'Non',
                animation: false
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('changeRoleForm-' + userId).submit();
                } else {
                    selectElement.value = oldDirectionId;
                }
            });
        }
    </script>
</body>
@endsection


