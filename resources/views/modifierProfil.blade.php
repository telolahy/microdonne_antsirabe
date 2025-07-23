@extends('layouts.app')

@section('content')

<style>
    .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: #333;
            z-index: 1000;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

    .containerModif{
        padding-top: 4rem;
    }
</style>

<div class="containerModif">


   
    <h2 class="text-center my-4">Modifier l'utilisateur</h2>

    {{-- Message de succès --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data" style="max-width: 600px; margin: 0 auto;">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="profile">Image de profil</label>
            <input type="file" id="profile" name="profile" class="form-control">
        </div>

        <div class="form-group">
            <label for="name">Nom</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" required>
            @error('name') <div class="alert alert-danger">{{ $message }}</div> @enderror
        </div>
        <div class="form-group">
            <label for="prenom">Prénom</label>
            <input type="text" name="prenom" id="prenom" class="form-control" value="{{ old('prenom', $user->prenom) }}" required>
            @error('prenom') <div class="alert alert-danger">{{ $message }}</div> @enderror
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" required>
            @error('email') <div class="alert alert-danger">{{ $message }}</div> @enderror
        </div>
        <div class="form-group">
            <label for="adresse">Adresse</label>
            <input type="text" name="adresse" id="adresse" class="form-control" value="{{ old('adresse', $user->adresse) }}">
            @error('adresse') <div class="alert alert-danger">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="telephone">Téléphone</label>
            <input type="text" name="telephone" id="telephone" class="form-control" value="{{ old('telephone', $user->telephone) }}">
            @error('telephone') <div class="alert alert-danger">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label for="profession">Profession</label>
            <input type="text" name="profession" id="profession" class="form-control" value="{{ old('profession', $user->profession) }}">
            @error('profession') <div class="alert alert-danger">{{ $message }}</div> @enderror
        </div>

        {{-- Select Direction --}}

        @can('DSIC')
            <div class="form-group">
                <label for="direction_id">Direction</label>
                <select name="direction_id" id="direction_id" class="form-control">
                    <option value="">-- Choisir une direction --</option>
                    @foreach($directions as $id => $name)
                        <option value="{{ $id }}" {{ (old('direction_id', $user->direction_id) == $id) ? 'selected' : '' }}>
                            {{ $name }}
                        </option>
                    @endforeach
                </select>
                @error('direction_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        @endcan
       

        <div class="d-flex justify-content-start">
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
            <a href="{{ route('users.index') }}" class="btn btn-secondary">Retour</a>
        </div>
    </form>
</div>
@endsection
