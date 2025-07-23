@extends('layouts.app')

@section('content')

    <div id="reportModal" class="modal">
        <div class="modal-content">
            <h3>Envoyer un rapport d'analyse</h3>
            <form action="{{ route('downloads.uploadRapport') }}" method="POST" id="reportForm" enctype="multipart/form-data">
                @csrf
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <input type="hidden" id="download_id" value="">

                <div class="form-group">
                    <label for="report_file">Sélectionner un fichier</label>
                    <input type="file" id="report_file" name="file" required class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Envoyer</button>
            </form>
        </div>
    </div>
@endsection