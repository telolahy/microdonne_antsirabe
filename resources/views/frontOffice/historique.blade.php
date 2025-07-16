@extends('layouts.app')

@section('content')
    <div class="historique-container flex-grow-1">
        <h1 class="page-title"><i class="bi bi-clock-history"></i>  Mon historique</h1>
        <div class="underline"></div>

        <!-- Barre de recherche -->
        <div class="search-container">
            <input type="text" id="search-bar" placeholder="Rechercher un fichier..." class="search-input">
            <input type="date" id="date-filter" class="date-input">
        </div>

        @if($historiques->isEmpty())
            <p class="no-history-message">Aucun historique de téléchargement trouvé.</p>
        @else
            <table class="historique-table">
                <thead>
                    <tr>
                        <th>Nom du fichier</th>
                        <th>Date de téléchargement</th>
                    </tr>
                </thead>
                <tbody id="historique-tbody">
                    @foreach($historiques as $historique)
                        <tr>
                            <td class="file-name">{{ $historique->file_name }}</td>
                            <td class="file-date">{{ $historique->created_at->format('Y-m-d') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <p id="no-results-message" class="no-results-message" style="display: none;">Aucun résultat correspondant.</p>
        @endif
    </div>

    <style>
    body {
        min-height: 100vh;
        margin-top:150px;
    }
    .navbar {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    background-color: #333; 
    z-index: 1000; 
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

    .page-title {
        font-size: 32px;
        font-weight: 700;
        color: #2c3e50;
        text-align: left; 
        margin-bottom: 10px;
        letter-spacing: 1px;
    }
    .page-title i {
        margin-right: 10px;
        color: #2c3e50;
        font-size: 20px;
    }

    .underline {
        width: 100%;
        height: 4px;
        background-color: rgb(22, 18, 4);
        margin-bottom: 30px;
    }

    .historique-container {
        padding: 20px;
        margin-left:0px
    }

    .search-container {
        display: flex;
        gap: 10px;
        margin-bottom: 20px;
    }

    .search-input, .date-input {
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 14px;
    }

    .search-input {
        width: 60%;
    }

    .date-input {
        width: 40%;
    }

    .historique-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .historique-table th, .historique-table td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: left;
    }

    .historique-table th {
        background-color: rgb(73, 69, 50);
        color: white;
        font-weight: bold;
    }
  
    .no-history-message, .no-results-message {
        font-size: 18px;
        color: #777;
        text-align: center;
        margin-top: 20px;
        margin: 15vh 0;
    }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let searchInput = document.getElementById('search-bar');
            let dateFilter = document.getElementById('date-filter');
            let rows = document.querySelectorAll('#historique-tbody tr');
            let noResultsMessage = document.getElementById('no-results-message');

            function filterTable() {
                let searchText = searchInput.value.toLowerCase();
                let selectedDate = dateFilter.value;
                let resultFound = false;

                rows.forEach(row => {
                    let fileName = row.querySelector('.file-name').textContent.toLowerCase();
                    let fileDate = row.querySelector('.file-date').textContent;

                    let matchesText = fileName.includes(searchText);
                    let matchesDate = selectedDate === "" || fileDate === selectedDate;

                    if (matchesText && matchesDate) {
                        row.style.display = '';
                        resultFound = true;
                    } else {
                        row.style.display = 'none';
                    }
                });

                noResultsMessage.style.display = resultFound ? 'none' : 'block';
            }

            searchInput.addEventListener('keyup', filterTable);
            dateFilter.addEventListener('change', filterTable);
        });
    </script>
@endsection
