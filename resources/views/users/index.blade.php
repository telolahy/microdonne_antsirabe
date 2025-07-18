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
            min-height: 100vh;
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
    </style>
</head>

<body>
    <div class="containerUser">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h6>Gestion des utilisateurs</h6>
        </div>

        <div class="d-flex justify-content-between align-items-center">
            <form method="GET" action="{{ route('users.index') }}" class="d-flex mb-4">
                <input type="text" name="search" placeholder="Rechercher..." class="form-control mr-2" value="{{ request()->get('search') }}">
                <button type="submit" class="btn btn-dark">Rechercher</button>
            </form>
        </div>

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
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        {{ $directions[$user->direction_id] ?? 'Non défini' }}
                    </td>
                    <td>{{ $user->created_at->format('d/m/Y') }}</td>
                    <td> 
                        <form id="changeRoleForm-{{ $user->id }}" method="POST" action="{{ route('users.changerRole', $user->id) }}">
                            @csrf
                            <select name="direction_id"
                                    class="form-select form-select-sm role-dropdown"
                                    onchange="confirmDropdownChange(this, '{{ $user->id }}', '{{ $user->name }}')"
                                    data-old-value="{{ $user->direction_id }}">
                                @foreach($directions as $id => $name)
                                    <option value="{{ $id }}" {{ $user->direction_id == $id ? 'selected' : '' }}>{{ $name }}</option>
                                @endforeach
                            </select>
                        </form>                                            
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
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


