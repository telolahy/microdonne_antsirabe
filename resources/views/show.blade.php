@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $theme->nom }}</h1>
    
    <img src="{{ asset('storage/images/themes/' . $theme->image) }}" alt="Image du thème" style="max-width: 300px;">

    <p>{{ $theme->description }}</p>

    <h3>Fichiers liés :</h3>

    @if($theme->files->isEmpty())
        <p>Aucun fichier disponible pour ce thème.</p>
    @else
        <ul>
            @foreach($theme->files as $file)
                <li>
                    <strong>{{ $file->file_name }}</strong>
                    - {{ $file->description ?? 'Aucune description' }}
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
