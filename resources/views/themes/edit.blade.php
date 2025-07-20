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
        <h2>Modifier le Thème</h2>
        
        <form action="{{ route('themes.update', $theme->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nom" class="mt-3">Nom</label>
                <input type="text" name="nom" id="nom" class="form-control" value="{{ old('nom', $theme->nom) }}" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" required>{{ old('description', $theme->description) }}</textarea>
            </div>

            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" name="image" id="image" class="form-control" accept="image/*">
                @if ($theme->image)
                    <img src="{{ asset('storage/images/themes/' . $theme->image) }}" alt="Image" class="img-thumbnail mt-2" style="max-width: 100px;">
                @endif
            </div>

            <button type="submit" class="btn btn-success">Mettre à jour</button>
        </form>
    </div>
@endsection
