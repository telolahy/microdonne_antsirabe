<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Microdonnées INSTAT Madagascar</title>
    <link rel="shortcut icon" href="/logo/logo instat.ico" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
    
    body {
        font-family: 'Poppins', ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
        /* background-color: #f8f9fc; */
        color: #2c3e50;
        margin: 0;
        padding: 20px;
        height: 100vh;
        /* background-color: #B0ABA8; */
        /* display: flex;
        justify-content: center;
        align-items: center; */
        background: linear-gradient(to right, #f1f4f9, #e0e7ef);
        /* background: linear-gradient(to right, #f9f9f9, #eeeeee, #dddddd); */
        /* width: 100%; */
    }

   
    .header {
    text-align: center;
    margin-bottom: 60px;
    padding-top: 10px; /* Ajoute un espace en haut */
    width: 100%;
    position: relative; /* Pour le garder en haut */
    z-index: 1; /* Assure qu'il reste au-dessus du fond */
    }

    .header h1 {
        font-size: 1.8rem;
        color: #2D495C;
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
        border-radius: 20px;
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.08);
        background-color: #ffffff;        
        flex: 1;
        transition: all 0.3s ease;
    }

    .card {
        padding: 0 30px;
        /* min-height: 100%; */
        height: 450px;
        width: 100%;
        min-width: 250px;
        max-width: 250px;
        display: flex;
        flex-direction: column;
    }
    .card i, .card1 i {
        font-size: 1rem;
        margin-right: 8px;
    }
    .card-title {
        text-align: center;
        font-size: 1.3rem;
        font-weight: 600;
        color: #333;
        margin-bottom: 10px;
        max-width: 250px; /* Limite la largeur du titre */
        break-word: break-word; /* Permet le retour à la ligne naturel */
        flex-shrink: 0;
    }
    .card-title1 {
        text-align: center;
        font-size: 1.3rem;
        font-weight: 600;
        color: #333;
        margin-bottom: 20px;
        max-width: 250px; /* Limite la largeur du titre */
        break-word: break-word; /* Permet le retour à la ligne naturel */
    }
    
    .card1 {
        
        padding: 0px 25px 25px 25px;
        max-height: 450px;
        width: 100%;
        min-width: 250px;
        max-width: 250px;
    }

    /* .card1 h2 {
        margin-bottom: 20px;
        text-align: center;
    } */

    .card1 label {
        display: block;
        margin-bottom: 5px;
        font-weight: 500;
        font-size: 0.75rem;
        color: #555;
    }

    .card1 input {
        width: 100%;
        padding: 8px;
        margin-bottom: 15px;
        border: 1px solid #ddd;
        border-radius: 6px;
        background: #fff;
        transition: border 0.3s ease;
    }

    .card1  input:focus {
        outline: none;
        background-color: #fff;
        border-color: #1a73e8;
        box-shadow: 0 0 4px #c2dbff;
    }

    .card1 button {
        width: 40%;
        padding: 10px;
        background-color: #1a73e8;
        color: white;
        border: none;
        border-radius: 6px;
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
        font-size: 0.75rem;
    }

    .card1 p {
        font-size: 0.75rem;
    }

    /* .card1 .logo {
        margin-bottom: 5px;
        display: flex;
        justify-content: center;
    }

    .card1 .logo img {
        max-width: 120px;
        
        animation: 
        oscillate 4s ease-in-out infinite, 
        burst 5s ease-in-out infinite; 
    } */
    

            
    /* @keyframes oscillate {
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
    } */

    .card1 .form-check {
        display: flex;
        align-items: center;
    }

    .card1 .form-check-input {
        margin-right: 5px;
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
        padding: 0;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    /* .card-body li {
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        
        padding: 10px;
        margin-bottom: 10px;
        font-size: 1.2rem;
        color: #555;
        list-style-type: square; 
        opacity: 0;
        transform: translateY(20px); 
        animation: fadeInSlide 0.6s ease-out forwards; 
        animation-delay: calc(0.2s * var(--i));
    }


    @keyframes fadeInSlide {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    } */

    .card-body1 {
        padding: 20px;
    }

    .card-body1 li {
        /* box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2); */
        
        /* padding: 10px; */
        margin-bottom: 10px;
        font-size: 1rem;
        color: rgba (85, 85, 85, 0.9);
        list-style-type: square; /* Supprime les puces */
        opacity: 0;
        transform: rotate(-15deg); /* Départ avec une légère rotation */
        animation: rotateIn 0.8s ease-out forwards;
        animation-delay: calc(0.2s * var(--i)); /* Délai progressif */
        }


    @keyframes rotateIn {
    to {
        opacity: 1;
        transform: rotate(0deg);
    }
}

/*icônes dans les champs de saisie */
.input-group {
    position: relative;
    margin-bottom: 20px;
}
.input-group .input-icon {
    position: absolute;
    top: 50%;
    left: 12px;
    transform: translateY(-90%);
    color: #888;
    font-size: 0.9rem;
}
.input-group input {
    padding-left: 38px; /* espace pour l'icône */
}

 /* Style pour l'icône de l'œil */
    .input-group .toggle-password {
        position: absolute;
        top: 50%;
        right: 5px;
        transform: translateY(-80%);
        color: #888;
        font-size: 0.9rem;
        cursor: pointer;
    }

.guide {
    padding-top: 10px;
}
.guide a {
    color: #1a73e8;
    display: flex;
    align-items: center;
    justify-content: center;
    width: auto;
    height: auto;
    margin: 0 auto;
}
.guide i {
    color: red;
    margin-left: 5px;
}
.guide:hover {
    color: #1a73e8;
    transform: scale(1.05);
    transition: transform 0.3s ease;
}

/* Andrana kely */
    .carousel {
            width: 100%;
            overflow: hidden;
            position: relative;
            flex-grow: 1; /* Prend tout l'espace restant dans .card-body */
            display: flex;
            flex-direction: column;
        }
        .carousel-container {
            display: flex;
            transition: transform 0.5s ease;
            width: 700%; /* 7 slides (6 originaux + 1 copie) */
            flex-grow: 1; /* Prend tout l'espace disponible */
        }
        .carousel-slide {
            width: 14.2857%; /* 100% / 7 */
            
            display: flex;
            align-items: center;
            justify-content: center;
            background-size: contain;
            background-position: center;
            position: relative;
        }
        .carousel-slide-content {
            text-align: center;
            color: white;
            text-shadow: 0 0 3px rgba(0, 0, 0, 0.5);
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 5px 0; /* Espacement interne */
        }
        .carousel-slide img {
            max-width: 200px;
            max-height: 200px;
            height: auto;
            object-fit: contain; /* Assure que l'image s'adapte sans déformation */
            margin-bottom: 5px;
        }

        .description {
            padding: 10px;
            font-size: 1rem;
            color: #666;
            text-align: center;
            flex-shrink: 0;
        }
        
        .dots {
            text-align: center;
            padding: 5px 0;
            flex-shrink: 0;
            min-height: 20px; /* Hauteur minimale pour les dots */
            /* display: none; */
        }
        .dot {
            height: 7px;
            width: 7px;
            background-color: #bbb;
            border-radius: 50%;
            display: inline-block;
            margin: 0 3px;
            cursor: pointer;
        }
        .dot.active {
            background-color: #0071e3;
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
        .card1 label {
            text-align: left;
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
        .header h1 {
            font-size: 1.3rem; /* Réduit la taille du titre sur petit écran */
            margin-bottom: 10px; /* Ajoute un espace en bas du titre */
        }
        .card-title1 {
            margin-left: auto; /* Centre le titre horizontalement */
            margin-right: auto; /* Centre le titre horizontalement */
            font-size: 1.2rem;

        }
        .card1 i {
            font-size: 0.8rem;
            margin-right: 8px;
        }
        .input-group .input-icon {
            transform: translateY(-100%);
        }
        .input-group .toggle-password {
            transform: translateY(-100%);
        }
        
    }

</style>
</head>
<body> 
    <div class="header">
        <div class="logo">
            <img src="/logo/logo_instat.png" style="height: 100px; margin: 0 auto; display: block;" alt="Logo INSTAT Madagascar">
        </div>
        <h1>Bienvenue sur la plateforme de partage des microdonnées de l'INSTAT Madagascar</h1>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="flex-center position-ref">
                <div class="card"> <!-- Visible uniquement sur md et plus grand -->
                    <h5 class="card-title" style="color : #2D495C;">
                        <!-- <i class="bi bi-bookmarks"></i> -->
                        🏷️  Thèmes disponibles</h5>
                    
                        <!-- <div class="card-body">
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
                        </div> -->
                    <div class="carousel">
                            <div class="carousel-container">
                                <div class="carousel-slide">
                                    <div class="carousel-slide-content">
                                        <img src="{{ Storage::url('images/themes/Instat_PictoAgriculture.jpg') }}" alt="Agriculture">
                                        <div class="description">
                                            Agriculture
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-slide">
                                    <div class="carousel-slide-content">
                                        <img src="{{ Storage::url('images/themes/Instat_PictoCommerce.jpg') }}" alt="Commerce">
                                        <div class="description">
                                            Commerce
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-slide">
                                    <div class="carousel-slide-content">
                                        <img src="{{ Storage::url('images/themes/Instat_PictoEducation.jpg') }}" alt="Education">
                                        <div class="description">
                                            Education
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-slide">
                                    <div class="carousel-slide-content">
                                        <img src="{{ Storage::url('images/themes/Instat_PictoSante.jpg') }}" alt="Santé">
                                        <div class="description">
                                            Santé
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-slide">
                                    <div class="carousel-slide-content">
                                        <img src="{{ Storage::url('images/themes/Instat_PictoEntreprise.jpg') }}" alt="Entreprise">
                                        <div class="description">
                                            Entreprise
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-slide">
                                    <div class="carousel-slide-content">
                                        <img src="{{ Storage::url('images/themes/Etc.jpg') }}" alt="Etc...">
                                        <div class="description">
                                            Etc
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-slide">
                                    <div class="carousel-slide-content">
                                        <img src="{{ Storage::url('images/themes/Instat_PictoAgriculture.jpg') }}" alt="Agriculture">
                                        <div class="description">
                                            Agriculture
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="dots"></div>
                        </div>
                </div>
            </div>
            <div class="flex-center position-ref">
                <div class="card1">
                    <!-- <div class="login-container"> -->
                    <h5 class="card-title1" style="color : #2D495C;">
                        <!-- <i class="bi bi-lock"></i> -->
                        🔐  Connexion</h5>
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
                                <div class="input-group">
                                    <span class="input-icon"><i class="bi bi-envelope-fill"></i></span>
                                    <input type="email" id="email" name="email" class="form-control" placeholder="Votre adresse email" value="{{ old('email') }}" required autofocus>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password">Mot de passe</label>
                                <div class="input-group">
                                    <span class="input-icon"><i class="bi bi-lock-fill"></i></span>
                                    <input type="password" id="password" name="password" placeholder="Mot de passe" class="form-control" required>
                                    <span class="toggle-password"><i class="bi bi-eye"></i></span>
                                </div>
                            </div>

                            <div class="form-group" style="display: flex; align-items: center; justify-content: center; width: auto; height: auto;">
                                <label class="flex items-center justify-start" for="remember">
                                    <input type="checkbox" name="remember" id="remember" class="mr-2" style="width: auto; height: auto; transform: translateY(20%);">
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
                            <div class="guide">
                                <a href="#" class="no-wrap">
                                Guide d'utilisation
                                    <i class="bi bi-filetype-pdf" ></i>
                                </a>
                            </div>
                    <!-- </div> -->

                </div>
            </div>
            <div class="flex-center position-ref">
                <div class="card "> <!-- Visible uniquement sur md et plus grand -->
                    <h5 class="card-title" style="color : #2D495C;">
                        <!-- <i class="bi bi-bar-chart-line"></i> -->
                        📈  Données <br> de recensement et enquêtes disponibles
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

<script>
        const slides = document.querySelector('.carousel-container').children;
        const dotsContainer = document.querySelector('.dots');
        let currentSlide = 0;
        const totalOriginalSlides = 6; // Nombre de slides originaux

        // Créer les points de navigation pour les 6 slides originaux
        for (let i = 0; i < totalOriginalSlides; i++) {
            const dot = document.createElement('div');
            dot.classList.add('dot');
            dot.addEventListener('click', () => goToSlide(i));
            dotsContainer.appendChild(dot);
        }
        updateDots();

        // Passer à la diapositive suivante toutes les 2 secondes
        setInterval(nextSlide, 2000);

        function updateDots() {
            const dots = document.querySelectorAll('.dot');
            dots.forEach((dot, index) => {
                dot.classList.toggle('active', index === currentSlide % totalOriginalSlides);
            });
        }

        function goToSlide(index) {
            if (index >= 0 && index < slides.length) {
                currentSlide = index;
                const offset = -currentSlide * 14.2857; // 100% / 7
                document.querySelector('.carousel-container').style.transition = 'transform 0.5s ease';
                document.querySelector('.carousel-container').style.transform = `translateX(${offset}%)`;
                updateDots();
            }
        }

        function nextSlide() {
            currentSlide++;
            const offset = -currentSlide * 14.2857; // 100% / 7
            document.querySelector('.carousel-container').style.transition = 'transform 0.5s ease';
            document.querySelector('.carousel-container').style.transform = `translateX(${offset}%)`;

            // Si on atteint le 7e slide (copie du 1er), revenir au 1er slide sans animation
            if (currentSlide === slides.length - 1) {
                setTimeout(() => {
                    currentSlide = 0;
                    document.querySelector('.carousel-container').style.transition = 'none';
                    document.querySelector('.carousel-container').style.transform = `translateX(0%)`;
                    updateDots();
                }, 500); // Attendre la fin de l'animation (0.5s)
            } else {
                updateDots();
            }
        }

        // Gestion de l'affichage/masquage du mot de passe
        document.querySelector('.toggle-password').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const icon = this.querySelector('i');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            }
        });
        
</script>

</body>

</html>
