<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Microdonne INSTAT</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            font-family: Poppins, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            /*display: flex;*/
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fc;
            margin: 0;
        }



        .login-container {
            background-color: white;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            width: 400px;
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
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background: #fff;
        }

        .login-container input:focus {
            outline: none;
            background-color: #fff;
        }

        .login-container button {
            width: 30%;
            padding: 10px;
            background-color: #000000;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: lighter;
            margin-left: auto;
            margin-right: auto;
            display: block;
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
        <div class="logo">
            <img src="/logo/logo_instat.png" class="w-10 px-0" style="height: 100px;">
        </div> 
        <div class="login-container">
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
                    <input type="checkbox" name="remember" id="remember" class="mr-2" style="width: auto; height: auto; "> 
                    <span style="white-space: nowrap;">Se souvenir de moi</span>
                </label>
            </div>
            <button type="submit" class="btn btn-primary">Se connecter</button>
             <!-- Lien mot de passe oublié -->
            <a href="{{ route('password.request') }}" class="d-block text-center mt-2">Mot de passe oublié ?</a>
        </form>
        <p class="mt-3" style="display: flex; align-items: center; justify-content: center; width: auto; height: auto;">
                 Pas encore inscrit ? <a href="{{ route('register') }}" style="margin-left: 5px; margin-top:0px;">Créer un compte</a>
        </p>
    </div>
    </body>

</html>
