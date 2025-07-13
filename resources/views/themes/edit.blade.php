@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Modifier le Thème</h2>
        
        <form action="{{ route('themes.update', $theme->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nom">Nom</label>
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
