<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réinitialiser le Mot de Passe</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body { 
            background-color: #f8f9fc;
            font-family: 'Poppins', sans-serif;
            color: #333;
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-container {
            background-color: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 400px; /* Limite la largeur maximale */
        }
        
        .login-container h4 {
            text-align: center;
            color: darkgoldenrod;
            margin-bottom: 30px; /* Augmente la marge inférieure pour plus d'espace */
            margin-top: 0px;
        }

        .logo {
            margin-bottom: 20px;
            display: flex;
            justify-content: center;
        }

        .logo img {
            max-width: 120px;
        }

        .login-container label { 
            margin-bottom: 10px; /* Réduit l'espace en dessous du label */
        }
        
        .login-container input {
            width: 94%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 6px;
            transition: border-color 0.3s;
        }
        
        .login-container input:focus {
            outline: none;
            border-color: darkgoldenrod;
            background-color: #f9f9f9;
        }
        
        .login-container button {
            width: 100%;
            padding: 10px;
            background-color: grey;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s;
        }
        
        .login-container button:hover {
            background-color: darkgoldenrod;
        }
        
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 0.9rem;
        }
        
        .footer a {
            color: #6a11cb;
        }
        
        .footer a:hover {
            color: darkgoldenrod;
        }
        
        .alert {
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .success-message {
            background-color: #d4edda; /* Couleur de fond verte */
            color: #155724; /* Couleur du texte verte foncé */
            border-color: #c3e6cb; /* Couleur de la bordure verte */
            border-radius: 10px; /* Arrondir les coins */
            padding: 15px; /* Espacement interne */
            margin-bottom: 15px; /* Espacement en bas */
        }

        /* Media Queries pour rendre la page responsive */
        @media (max-width: 768px) {
            .login-container {
                padding: 20px; /* Réduit le padding sur les petits écrans */
            }

            .login-container h4 {
                font-size: 1.5rem; /* Ajuste la taille de la police pour les petits écrans */
            }
        }
    </style>
</head>
<body>
<div class="container">
    <div class="logo">
        <img src="/logo/logo_instat.png" alt="Logo INSTAT">
    </div> 
    <div class="login-container">
        <h4>Réinitialiser le Mot de Passe</h4>
        
        @if (session('status'))
            <div class="success-message" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="form-group">
                <label for="email">{{ __('Adresse e-mail') }}</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autofocus>
                
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">{{ __('Nouveau mot de passe') }}</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password-confirm">{{ __('Confirmer le mot de passe') }}</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
            </div>

            <div class="form-group mt-3">
                <button type="submit" class="btn btn-primary">
                    {{ __('Réinitialiser le mot de passe') }}
                </button>
            </div>
        </form>

        <div class="footer">
            <p>Vous avez un compte ? <a href="{{ route('login') }}">Se connecter</a></p>
        </div>
    </div>
</div>
</body>
</html>
