<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Microdonnées INSTAT Madagascar</title>
    <link rel="shortcut icon" href="/logo/logo_instat.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --instat-primary: #000000;
            --instat-secondary: #B0ABA8;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: var(--instat-secondary);
            margin: 0;
            padding: 20px;
        }

        .login-wrapper {
            width: 100%;
            max-width: 900px;
        }

        .login-container {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .logo-container {
            padding: 20px 0;
            text-align: center;
            background-color: white;
        }

        .logo-container img {
            max-height: 80px;
            width: auto;
        }

        .form-container {
            padding: 25px;
        }

        .form-title {
            color: var(--instat-primary);
            margin-bottom: 1.5rem;
            text-align: center;
            font-weight: 600;
        }

        .form-label {
            font-weight: 500;
            color: #333;
            margin-bottom: 0.5rem;
        }

        .form-control {
            padding: 10px 12px;
            border-radius: 4px;
            border: 1px solid #ced4da;
            margin-bottom: 1rem;
        }

        .boutonSinscrire {
            display: flex;
            justify-content: center;
            margin-top: 1.5rem;

        }
        .form-control:focus {
            border-color: var(--instat-primary);
            box-shadow: 0 0 0 0.25rem rgba(0, 0, 0, 0.1);
        }

        .btn-inst {
            background-color: var(--instat-primary);
            color: white;
            padding: 10px 24px;
            border-radius: 4px;
            font-weight: 500;
            border: none;
            transition: all 0.3s;
            /* Largeur automatique par défaut */
            width: auto;
            display: inline-block;
        }

        .btn-inst:hover {
            background-color: #333;
            transform: translateY(-1px);
        }

        .login-link {
            color: var(--instat-primary);
            text-decoration: none;
            display: inline-block;
            margin-top: 1rem;
            text-align: center;
            width: 100%;
        }

        .login-link:hover {
            text-decoration: underline;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .logo-container img {
                max-height: 70px;
            }
            
            .boutonSinscrire{
                width: 100!important%;
            }
            .form-container {
                padding: 20px;
            }
            
            .col-md-6 {
                padding: 0 5px;
            }
            
            body {
                padding: 10px;
                align-items: flex-start;
                padding-top: 30px;
            }
        }

        @media (max-width: 576px) {
            .login-container {
                border-radius: 0;
            }
            
            .form-control {
                padding: 8px 10px;
                font-size: 14px;
            }
            
            .btn-inst {
                padding: 8px 16px;
            }
        }
    </style>
</head>
<body>
    <div class="login-wrapper">
        <div class="login-container">
            <div class="logo-container">
                <img src="/logo/logo_instat.png" alt="Logo INSTAT">
            </div>
            
            <div class="form-container">
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="form-label">Nom</label>
                                <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="prenom" class="form-label">Prénom(s)</label>
                                <input type="text" id="prenom" name="prenom" class="form-control" value="{{ old('prenom') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="adresse" class="form-label">Adresse</label>
                                <input type="text" id="adresse" name="adresse" class="form-control" value="{{ old('adresse') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="telephone" class="form-label">Téléphone</label>
                                <input type="text" id="telephone" name="telephone" class="form-control" value="{{ old('telephone') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="profession" class="form-label">Profession</label>
                                <input type="text" id="profession" name="profession" class="form-control" value="{{ old('profession') }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="entite" class="form-label">Entité</label>
                                <input type="text" id="entite" name="entite" class="form-control" value="{{ old('entite') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="password" class="form-label">Mot de passe</label>
                                <input type="password" id="password" name="password" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation" class="form-label">Confirmer le mot de passe</label>
                                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-grid mt-4 boutonSinscrire">
                        <button type="submit" class="btn btn-inst">S'inscrire</button>
                    </div>
                    
                    <div class="text-center mt-3">
                        <a href="{{ route('login') }}" class="login-link">Vous avez déjà un compte ? Connectez-vous</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>