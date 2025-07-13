@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Tableau de bord Superadmin</h1>
        <p>Bienvenue, vous avez un accès complet à toutes les sections de l'application.</p>
        
        <h2>Liste des utilisateurs</h2>
        <ul>
            @foreach(App\User::all() as $user)
                <li>{{ $user->name }} ({{ $user->role }})</li>
            @endforeach
        </ul>

        <h2>Gestion des directions</h2>
        <ul>
            <li><a href="{{ route('direction', ['directionId' => 1]) }}">Direction D1</a></li>
            <li><a href="{{ route('direction', ['directionId' => 2]) }}">Direction D2</a></li>
            <!-- Ajoutez des liens vers d'autres directions si nécessaire -->
        </ul>
    </div>
@endsection
