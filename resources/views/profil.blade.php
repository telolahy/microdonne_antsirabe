@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center my-4">Mon Profil</h1>

        <div class="row">
            <div class="col-md-4 d-flex justify-content-center">
                <img src="{{ asset('images/profiles/' . $user->profile) }}" class="img-fluid rounded-circle" alt="Profile" style="max-width: 250px; max-height: 250px; object-fit: cover;">
            </div>
            <div class="col-md-8">
                <table class="table table-striped table-hover" style="border-collapse: collapse; width: 100%; margin-top: 20px;">
                    <tbody>
                        <tr>
                            <th scope="row">Nom</th>
                            <td>{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Prénom</th>
                            <td>{{ $user->prenom }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Email</th>
                            <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Téléphone</th>
                            <td>{{ $user->telephone }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Adresse</th>
                            <td>{{ $user->adresse }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Date d'inscription</th>
                            <td><p>Date de création : {{ $user->created_at ? $user->created_at->format('d/m/Y') : 'Non défini' }}</p>
</td>
                        </tr>
                    </tbody>
                </table>

                <div class="d-flex justify-content-start">
                    <a href="{{ route('users.edit',$user->id) }}" class="btn btn-primary mr-2" style="padding: 10px 20px;">Modifier mon profil</a>
                    <a href="{{ url()->previous() }}" class="btn btn-secondary" style="padding: 10px 20px;">Retour</a>
                </div>
            </div>
        </div>
    </div>
@endsection
