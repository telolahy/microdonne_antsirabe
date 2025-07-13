<!-- resources/views/files/index.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Fichiers</h1>

    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <table>
        <thead>
            <tr>
                <th>Nom du fichier</th>
                <th>Description</th>
                <th>Statut</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($files as $file)
                <tr>
                    <td>{{ $file->file_name }}</td>
                    <td>{{ $file->description }}</td>
                    <td>{{ $file->status }}</td>
                    <td>
                        @if($file->status === 'en_attente')
                            <a href="{{ route('files.show', $file) }}">Télécharger</a>
                        @endif

                        @can('Superadmin')
                            <form action="{{ route('files.updateStatus', [$file, 'validé']) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit">Valider</button>
                            </form>
                            <form action="{{ route('files.updateStatus', [$file, 'rejeté']) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit">Rejeter</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
