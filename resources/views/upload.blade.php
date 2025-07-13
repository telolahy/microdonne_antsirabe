<form action="{{ route('fichier.upload') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label for="fichier">Choisissez un fichier :</label>
    <input type="file" name="fichier" required>
    <button type="submit">Uploader</button>
</form>