@extends('layouts.app')

@section('content')
<style>
    .form-group label {
        font-weight: bold;
    }
    .form-group input, .form-group textarea, .form-group select {
        margin-top: 5px;
    }
    .btn {
        margin-top: 15px;
    }
    .container {
        max-width: 600px;
        margin-top: 50px;
    }
    .btn-container {
        display: flex;
        justify-content: space-between;
    }
</style>
<div class="container">
    <h2>Modifier le fichier</h2>

    <form action="{{ route('files.update', $file->id) }}" method="POST" enctype="multipart/form-data" class="border p-4 rounded shadow-sm">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="file">Fichier</label>
            <input type="file" name="file" class="form-control" id="file">
            @if($file->file_path)
                <p class="text-muted">Fichier actuel : {{ $file->file_name }}</p>
            @endif
            @error('file')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control" id="description" rows="4">{{ old('description', $file->description) }}</textarea>
            @error('description')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <!-- Champ pour le type -->
        <div class="form-group">
            <label for="type">Type de validation</label>
            <select name="type" id="type" class="form-control">
                <option value="avec_validation" {{ $file->type == 'avec_validation' ? 'selected' : '' }}>Avec validation</option>
                <option value="sans_validation" {{ $file->type == 'sans_validation' ? 'selected' : '' }}>Sans validation</option>
            </select>
            @error('type')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="btn-container">
            <a href="{{ url()->previous() }}" class="btn btn-secondary">Annuler</a>
            <button type="submit" class="btn btn-success">Mettre à jour</button>   
        </div>
    </form>
</div>

@endsection
