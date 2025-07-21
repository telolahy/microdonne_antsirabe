@extends('layouts.app')

@section('content')

<style>
    .containerModification {
        padding: 20px;
        background-color: #f8f9fa;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        padding-top: 40px;
        padding-left: 40px
    }
</style>

<div class="containerModification">
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
