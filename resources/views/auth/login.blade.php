<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Microdonne INSTAT</title>
    <link rel="shortcut icon" href="/logo/logo instat.ico" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
    
    body {
        font-family: 'Poppins', ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
        background-color: #f8f9fc;
        margin: 0;
        padding: 20px;
        height: 100vh;
        /* display: flex;
        justify-content: center;
        align-items: center; */
        background: linear-gradient(to right, #f9f9f9, #eeeeee, #dddddd);
        /* background: linear-gradient(to right, #ad6b2b, #edc659, #e1b739, #d4a821); */
        /* width: 100%; */
    }

   
    .header {
    text-align: center;
    margin-bottom: 60px;
    padding-top: 20px; /* Ajoute un espace en haut */
    width: 100%;
    position: relative; /* Pour le garder en haut */
    z-index: 1; /* Assure qu'il reste au-dessus du fond */
    }

    .header h1 {
        font-size: 2rem;
        color: #1a73e8;
        margin: 0; /* Supprime les marges par défaut */
        max-width: 800px; /* Limite la largeur du texte */
        width: 100%; /* Prend toute la largeur disponible dans max-width */
        margin-left: auto; /* Centre horizontalement */
        margin-right: auto; /* Centre horizontalement */
        word-break: break-word; /* Permet le retour à la ligne naturel */
        line-height: 1.5; /* Ajuste l'espacement entre les lignes */
    }

    .container-fluid {
    margin: 0 auto; /* Centre le conteneur horizontalement */
    max-width: 1200px; /* Limite la largeur maximale pour un meilleur centrage */
    display: flex;
    justify-content: center; /* Centre les cartes horizontalement */
    gap: 20px;
    }

    .row {
        display: flex;
        width: 100%;
        max-width: 1200px; /* Synchronisé avec .container-fluid */
        justify-content: center; /* Centre les cartes */
        gap: 20px;
        
    }

    .card, .card1 {
        border: none;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        background-color: #ffffff;        
        flex: 1;
    }
    .card {
        padding: 0 40px;
        min-height: 100%;
        width: 100%;
        min-width: 250px;
    }
    .card i {
        font-size: 1rem;
        margin-right: 10px;
    }
    .card-title{
        text-align: center;
    }
    
    .card1 {
        
        padding: 40px;
        min-height: 400px;
        width: 100%;
        min-width: 250px;
        /* max-width: 400px; */
    }

    .card1 h2 {
        margin-bottom: 20px;
        text-align: center;
    }

    .card1 label {
        display: block;
        margin-bottom: 8px;
    }

    .card1 input {
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
        border: 1px solid #ddd;
        border-radius: 4px;
        background: #fff;
    }

    .card1  input:focus {
        outline: none;
        background-color: #fff;
    }

    .card1 button {
        width: 40%;
        padding: 10px;
        background-color: #1a73e8;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-weight: lighter;
        margin-left: auto;
        margin-right: auto;
        display: block;
    }

    .card1 button:hover {
        background-color: #454444;
    }

    .card1 a {
        color: #1a73e8;
        text-decoration: none;
        display: block;
        text-align: center;
        margin-top: 10px;
    }

    .card1 .logo {
        margin-bottom: 10px;
        display: flex;
        justify-content: center;
    }

    .card1 .logo img {
        max-width: 120px;
    }

    .card1 .form-check {
        display: flex;
        align-items: center;
    }

    .card1 .form-check-input {
        margin-right: 3px;
    }

    .card1 .form-check-label {
        margin-left: 0px;
    }

    .card1 .no-wrap {
    display: flex;
    align-items: center;
    justify-content: center;
    white-space: nowrap; /* Empêche le retour à la ligne */
    
    }

    .card-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: #333;
        margin-bottom: 10px;
    }

    /* .map-placeholder {
        width: 100%;
        height: 400px;
        background-size: cover;
        background-position: center;
        border-radius: 5px;
    }

    #world-map {
        background-image: url('https://via.placeholder.com/400x400?text=World+Map');
    }

    #madagascar-map {
        background-image: url('https://via.placeholder.com/400x400?text=Madagascar+Map');
    }

    .form-group label {
        font-size: 0.9rem;
        font-weight: 500;
        color: #555;
    }

    .form-control {
        border-radius: 5px;
        font-size: 0.9rem;
        padding: 0.75rem;
        border-color: #ced4da;
    }

    .custom-select {
        font-size: 0.9rem;
        padding: 0.75rem;
        border-radius: 5px;
        border-color: #ced4da;
    } */

    .flex-center {
        align-items: center;
        display: flex;
        justify-content: center;
    }

    .position-ref {
        position: relative;
    }

    .content {
        text-align: center;
    }

    .title {
        font-size: 84px;
    }

    /* .links > a {
        color: #636b6f;
        padding: 0 25px;
        font-size: 13px;
        font-weight: 600;
        letter-spacing: .1rem;
        text-decoration: none;
        text-transform: uppercase;
    } */

    .m-b-md {
        margin-bottom: 30px;
    }

    .card-body {
        padding: 20px;
    }

    .card-body li {
        /* box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2); */
        
        /* padding: 10px; */
        margin-bottom: 10px;
        font-size: 1.2rem;
        color: #555;
        list-style-type: square; /* Supprime les puces */
        opacity: 0;
        transform: translateY(20px); /* Départ légèrement en bas */
        animation: fadeInSlide 0.6s ease-out forwards; /* Animation de 0.6s */
        animation-delay: calc(0.2s * var(--i)); /* Décalage basé sur l'index */
    }


    @keyframes fadeInSlide {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    .card-body1 {
        padding: 20px;
    }

    .card-body1 li {
        /* box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2); */
        
        /* padding: 10px; */
        margin-bottom: 10px;
        font-size: 1.2rem;
        color: rgba (85, 85, 85, 0.9);
        list-style-type: square; /* Supprime les puces */
        opacity: 0;
        transform: rotate(-15deg); /* Départ avec une légère rotation */
        animation: rotateIn 0.8s ease-out forwards;
        animation-delay: calc(1s + 0.1s * var(--i)); /* Délai progressif */
        }


    @keyframes rotateIn {
    to {
        opacity: 1;
        transform: rotate(0deg);
    }
}

    .logo img {
        /* animation: rotation 4s linear infinite alternate; */
        animation: 
        oscillate 4s ease-in-out infinite, /* Oscillation légère */
        burst 5s ease-in-out infinite; /* Éclat intermittent */
    }

    /* @keyframes rotation {
                from {
                    transform: rotate(0deg);
                }
                to {
                    transform: rotate(360deg);
                }
            } */
            
    @keyframes oscillate {
    0%, 100% {
        transform: rotate(-15deg);
    }
    50% {
        transform: rotate(15deg);
    }
    }

    @keyframes burst {
        0%, 70%, 100% {
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.2);
            filter: brightness(100%);
        }
        15% {
            box-shadow: 0 0 30px rgba(255, 255, 255, 0.8);
            filter: brightness(120%);
        }
    }
    

    @media (max-width: 991px) {
        .card {
            display: none;
        }
        .container-fluid {
            display: block;
            text-align: center;
            max-width: 400px;
        }
        .row {
            display: block;
            text-align: center;
            max-width: 400px;
        }
        .card1 {
            display: inline-block;
            width: 100%;
            max-width: 400px;
            margin: 0 auto;
            min-height: auto;
        }
        body {
            height: auto;
            padding: 10px;
        }
        .card1 .no-wrap {
        font-size: 0.9rem; /* Réduit légèrement la taille sur petit écran */
        }
        .header {
            margin-bottom: 10px; /* Réduit l'espace en bas de l'en-tête sur petit écran */
        }
        
    }

</style>
</head>
<body> 
    <div class="header">
        <h1>Bienvenue sur la plateforme de partage des microdonnées de l'INSTAT Madagascar</h1>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="flex-center position-ref">
                <div class="card"> <!-- Visible uniquement sur md et plus grand -->
                    <h5 class="card-title">
                        <i class="bi bi-bookmarks"></i>
                        Thèmes</h5>
                    <!-- <div class="map-placeholder" id="world-map"> -->
                        <div class="card-body">
                            <ul>
                                @php
                                $index = 0;
                                @endphp
                                @foreach ($themes as $theme)
                                    @php
                                    $index++;
                                    @endphp
                                    <li style="--i: {{ $loop->iteration }}">
                                            {{ $theme->nom }}
                                        
                                    </li>
                                @endforeach
                                @php
                                $index++;
                                @endphp
                                    <li style="--i: {{ $index }}">
                                            Etc ...
                                        
                                    </li>
                            </ul>
                        </div>
                    <!-- </div> -->
                </div>
            </div>
            <div class="flex-center position-ref">
                <div class="card1">
                    <!-- <div class="login-container"> -->
                        <div class="logo">
                            <img src="/logo/logo_instat.png" class="w-10 px-0" style="height: 100px;">
                        </div>
                        <!-- Si l'utilisateur n'a pas validé ses identifiants, afficher une erreur -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li style="color:red">{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Formulaire de connexion -->
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus>
                            </div>

                            <div class="form-group">
                                <label for="password">Mot de passe</label>
                                <input type="password" id="password" name="password" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label class="flex items-center justify-start" for="remember">
                                    <input type="checkbox" name="remember" id="remember" class="mr-2" style="width: auto; height: auto;">
                                    <span style="white-space: nowrap;">Se souvenir de moi</span>
                                </label>
                            </div>
                            <button type="submit" class="btn btn-primary">Se connecter</button>
                            <!-- Lien mot de passe oublié -->
                            <a href="{{ route('password.request') }}" class="d-block text-center mt-2">Mot de passe oublié ?</a>
                        </form>
                        <p class="mt-3 no-wrap" style="display: flex; align-items: center; justify-content: center; width: auto; height: auto;">
                            Pas encore inscrit ? <a href="{{ route('register') }}" style="margin-left: 5px; margin-top:0px;">Créer un compte</a>
                        </p>
                    <!-- </div> -->
                </div>
            </div>
            <div class="flex-center position-ref">
                <div class="card "> <!-- Visible uniquement sur md et plus grand -->
                    <h5 class="card-title">
                        <i class="bi bi-bar-chart-line"></i>
                        Recensement et enquêtes
                    </h5>
                    <div class="card-body1">
                            <ul>
                                @php
                                $index = 0;
                                @endphp
                                @foreach ($enquetes as $enquete)
                                    @php
                                    $index++;
                                    @endphp
                                    <li style="--i: {{ $loop->iteration }}">
                                            {{ $enquete->nom }}
                                        
                                    </li>
                                @endforeach
                                @php
                                $index++;
                                @endphp
                                    <li style="--i: {{ $index }}">
                                            Etc ...
                                        
                                    </li>
                            </ul>
                        </div>
                      
                </div>
                           
                    
            </div>
        </div>
    </div>
</body>

</html>
