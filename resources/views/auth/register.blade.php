<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Microdonne INSTAT</title>
    <link rel="shortcut icon" href="/logo/logo_instat.png" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            font-family: Poppins, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(to left, #f9f9f9, #eeeeee, #dddddd);
            /* background: linear-gradient(to right, #ad6b2b, #edc659, #e1b739, #d4a821); */
            margin: 0;
        }

        .container {
            max-width: 800px;
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .login-container {
            background-color: white;
            padding: 20px; /* Réduire le padding */
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            width: 100%;
        }

        .login-container h2 {
            margin-bottom: 20px;
            text-align: center;
        }

        .login-container label {
            display: block;
            margin-bottom: 8px;
        }

        .login-container input {
            width: 100%;
            padding: 8px; /* Réduire le padding */
            margin-bottom: 15px; /* Réduire la marge inférieure */
            border: 1px solid #ddd;
            border-radius: 4px;
            background: #fff;
        }

        .login-container input:focus {
            outline: none;
            background-color: #fff;
        }

        .login-container button {
            width: auto; /* Ajuster la largeur automatiquement */
            padding: 10px 20px; /* Ajouter du padding pour le bouton */
            background-color: #000000;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: lighter;
            display: block;
            margin-left: auto;
            margin-right: auto; /* Centrer le bouton */
        }

        .login-container button:hover {
            background-color: #454444;
        }

        .login-container a {
            color: #1a73e8;
            text-decoration: none;
            display: block;
            text-align: center;
            margin-top: 10px;
        }

        .logo {
            margin-bottom: 10px;
            display: flex;
            justify-content: center;
        }

        .logo img {
            max-width: 120px;
        }

        .row {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        .col-md-6 {
            flex: 0 0 48%;
            box-sizing: border-box;
        }

        @media screen and (min-width: 530px){
            body{
                display: flex;
            }
        }

        .form-check {
            display: flex;
            align-items: center;
        }

        .form-check-input {
            margin-right: 3px;  /* Espacement à droite de la case à cocher */
        }

        .form-check-label {
            margin-left: 0px;  /* Espacement entre la case et le texte */
        }

    </style>
</head>
<body>
    <div class="container">
        <div class="login-container">
            <div class="logo">
                <img src="/logo/logo_instat.png" class="w-10 px-0" style="height: 100px;">
            </div> 
            <!-- Si l'utilisateur n'a pas validé ses identifiants, afficher une erreur -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li class="error-message" style="color:red">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Formulaire d'inscription -->
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Nom</label>
                            <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="prenom">Prénom(s)</label>
                            <input type="text" id="prenom" name="prenom" class="form-control" value="{{ old('prenom') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="adresse">Adresse</label>
                            <input type="text" id="adresse" name="adresse" class="form-control" value="{{ old('adresse') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="telephone">Téléphone</label>
                            <input type="text" id="telephone" name="telephone" class="form-control" value="{{ old('telephone') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="profession">Profession</label>
                            <input type="text" id="profession" name="profession" class="form-control" value="{{ old('profession') }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="entite">Entité</label>
                            <input type="text" id="entite" name="entite" class="form-control" value="{{ old('entite') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Mot de passe</label>
                            <input type="password" id="password" name="password" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Confirmer le mot de passe</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">S'inscrire</button>
                <a class="nav-link" href="{{ route('login') }}" style="margin-right: 10px;">Vous avez déjà un compte ?</a>
            </form>
        </div>
    </div>
</body>
