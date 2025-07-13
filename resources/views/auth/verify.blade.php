@extends('layouts.app')

@section('content')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Microdonnée - INSTAT</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            font-size: 15px;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            background-color: #f4f4f4; /* Orange Jaune */
            color: #333;
            text-align: center;
            padding: 0px;
        }
        h1 {
            font-size: 2.5em;
            margin: 0;
        }
        p {
            font-size: 1.2em;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 40px;
        }
        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 2px solid #ddd;
        }
        th {
            background-color: #333;
            color: white;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        a {
            color: darkgoldenrod;
            text-decoration: none;
            font-weight: bold;
        }
        a:hover {
            text-decoration: underline;
        }
        .btn {
            padding: 8px 15px;
            font-size: 12px;
            background-color: #333;
            color: white;
            border: none;
            cursor: pointer;
            font-weight: bold;
        }
        .btn:hover {
            background-color:darkgoldenrod; /* Orange Jaune style="color:darkgoldenrod" */ 
        }
        .action-form {
            display: inline-block;
            margin-left: 10px;
        }
        .status-waiting {
            background-color:darkgoldenrod;
            color: #fff;
            padding: 5px 10px;
            border-radius: 5px;
        }
        .badge {
            padding: 0.6em 1em; /* Augmentez le padding */
            border-radius: 0.25rem;
            font-size: 0.85em; /* Augmentez la taille de la police */
        }

        .badge-success {
            background-color: #28a745;
            color: white;
        }

        .badge-info {
            background-color: darkgoldenrod;
            color: white;
        }

        .badge-danger {
            background-color: #dc3545;
            color: white;
        }

        .badge-secondary {
            background-color: #6c757d;
            color: white;
        }

    </style> 
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</head>
<body> 
    <div class="container">
        <div class="alert alert-info">
            <strong>Merci de vérifier votre adresse e-mail.</strong>  
            Nous avons envoyé un lien de vérification à votre adresse e-mail. Si vous n'avez pas reçu l'email,
            <form action="{{ route('verification.resend') }}" method="POST" style="display:inline;">
                @csrf
                 <button type="submit" class="btn btn-link p-0 m-0 align-baseline">cliquez ici pour le renvoyer</button>
            </form>
        </div>
    </div>
</body>
@endsection

