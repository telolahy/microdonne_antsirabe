@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Modifier l'enquête : {{ $enquete->nom }}</h1>

    <form action="{{ route('enquete.update', $enquete->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" name="nom" id="nom" class="form-control" value="{{ old('nom', $enquete->nom) }}" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control" required>{{ old('description', $enquete->description) }}</textarea>
        </div>

        <div class="form-group">
            <label for="images">Image</label>
            <input type="file" name="images" id="images" class="form-control">
            @if ($enquete->images)
                <img src="{{ asset('storage/images/enquetes/' . $enquete->images) }}" alt="Image actuelle" class="img-thumbnail" style="max-width: 100px;">
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour l'enquête</button>
    </form>
</div>
@endsection
