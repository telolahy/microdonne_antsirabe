<!-- resources/views/files/create.blade.php -->

@extends('layouts.app')

@section('content')
    <form action="{{ route('files.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div>
            <label for="file">Choisir un fichier</label>
            <input type="file" name="file" id="file" required>
        </div>

        <div>
            <label for="description">Description</label>
            <textarea name="description" id="description" rows="4" required></textarea>
        </div>

        <button type="submit">Télécharger</button>
    </form>
@endsection
