@extends('layouts.app')

@section('content')
<div class="container">

    <h2 class="text-center my-4">Modifier l'utilisateur</h2>

    {{-- Message de succès --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Alerte générale d'erreur --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Veuillez compléter tous les champs obligatoires.</strong>
        </div>
    @endif

    {{-- Style pour les erreurs --}}
    <style>
        .is-invalid {
    border: 1px solid red !important;
    box-shadow: 0 0 5px red;
    background-color: #ffe6e6; /* optionnel, fond légèrement rouge */
    }
        .invalid-feedback {
            color: red;
            font-size: 0.875em;
            margin-top: 5px;
    }

    </style>

    <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data" style="max-width: 600px; margin: 0 auto;">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="profile">Image de profil</label>
            <input type="file" id="profile" name="profile" class="form-control">
        </div>

        <div class="form-group">
            <label for="name">Nom</label>
            <input type="text" name="name" id="name"
                   class="form-control @error('name') is-invalid @enderror"
                   value="{{ old('name', $user->name) }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="prenom">Prénom</label>
            <input type="text" name="prenom" id="prenom"
                   class="form-control @error('prenom') is-invalid @enderror"
                   value="{{ old('prenom', $user->prenom) }}" required>
            @error('prenom')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email"
                   class="form-control @error('email') is-invalid @enderror"
                   value="{{ old('email', $user->email) }}" required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="adresse">Adresse</label>
            <input type="text" name="adresse" id="adresse"
                   class="form-control @error('adresse') is-invalid @enderror"
                   value="{{ old('adresse', $user->adresse) }}">
            @error('adresse')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="telephone">Téléphone</label>
            <input type="text" name="telephone" id="telephone"
                   class="form-control @error('telephone') is-invalid @enderror"
                   value="{{ old('telephone', $user->telephone) }}">
            @error('telephone')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="profession">Profession</label>
            <input type="text" name="profession" id="profession"
                   class="form-control @error('profession') is-invalid @enderror"
                   value="{{ old('profession', $user->profession) }}">
            @error('profession')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Select Direction --}}
        <div class="form-group">
            <label for="direction_id">Direction</label>
            <select name="direction_id" id="direction_id"
                    class="form-control @error('direction_id') is-invalid @enderror">
                <option value="">-- Choisir une direction --</option>
                @foreach($directions as $id => $name)
                    <option value="{{ $id }}" {{ (old('direction_id', $user->direction_id) == $id) ? 'selected' : '' }}>
                        {{ $name }}
                    </option>
                @endforeach
            </select>
            @error('direction_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex justify-content-start  ">
            <button type="submit" class="btn btn-primary mr-2">Mettre à jour</button>
            <a href="{{ url()->previous() }}" class="btn btn-secondary">Retour</a>
        </div>
    </form>
</div>
@endsection
