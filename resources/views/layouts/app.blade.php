<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Microdonnées INSTAT Madagascar</title>
    <link rel="shortcut icon" href="/logo/logo instat.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=League+Gothic&family=Londrina+Shadow&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&family=Poppins:ital,wght@0,400;0,500;0,700;1,400;1,600&family=Raleway:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=League+Gothic&family=Londrina+Shadow&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&family=Poppins:ital,wght@0,400;0,500;0,700;1,400;1,600&family=Raleway:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/amprex/main.css') }}">
    <link rel="stylesheet" href="/fontawesome/css/all.min.css">
        <link rel="stylesheet" href="{{asset('dist/aos.css')}}">
    



    <script src="https://cdn.jsdelivr.net/npm/ckeditor@4.25.1-lts/standard/ckeditor.js"></script>
    <style>
    .navbar {
            background-color: #0b1120 !important; 
            box-shadow: 0 4px 12px rgba(0,0,0,0.05) !important;
            font-family: 'Poppins', sans-serif !important;
            height: 80px;
             border-bottom: 1px solid rgba(255, 255, 255, 0.05);
             
        }
        /* Micky d*/
    .navbar-nav {
        font-family: 'Montserrat', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-weight: 700;
            font-size: 1.2rem; 
            
    }  

    .dropdown{
        font-family: 'Montserrat', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-weight: 700;
            font-size: 1rem; 
    }
        

    .navbar .nav-link {
            display: inline-flex !important;
            align-items: center !important;
            gap: 6px; 
            padding-bottom: 8px 12px !important;
            position: relative !important;
            color: #f0f0f0 !important;
        
            white-space: nowrap;
        }
        /* Micky f*/
        .navbar .nav-link::after {
            content: "" !important;
            position: absolute!important ;
            left: 0 !important;
            bottom: 0 !important;
            height: 4px !important;
            width: 0% !important;
            background-color: #1f4cf5 !important; 
            transition: width 0.3s ease-in-out !important;
            border-radius: 2px !important;
        }
        .navbar .nav-link:hover {
            color: #4dabf7 !important;
            text-decoration: none !important;
        }
        .navbar .nav-link:hover::after {
            width: 50% !important;
        }

        /* Micky d*/
        .nav-link1 {
            display: inline-flex !important;
            align-items: center !important;
            gap: 0px; 
            padding-bottom: 8px 12px !important;
            position: relative !important;
            color: #f0f0f0 !important;
            cursor: default;
            white-space: nowrap;
        }
        /* .nav-link1::after {
            content: "" !important;
            position: absolute!important ;
            left: 0 !important;
            bottom: 0 !important;
            height: 4px !important;
            width: 0% !important;
            background-color: #1f4cf5 !important; 
            transition: width 0.3s ease-in-out !important;
            border-radius: 2px !important;
        }
        .navbar .nav-link1:hover {
            color: #4dabf7 !important;
            text-decoration: none !important;
        }
        .navbar .nav-link1:hover::after {
            width: 50% !important;
        } */


       /*  .navbar-brand span {
            font-size: 1.2rem !important;
            font-weight: 700 !important;
            letter-spacing: 0.8px !important;
            color: #ffffff !important;
            margin-left: 10px !important;
        } */
        /* Micky f*/
            
                #userDropdown img {
                    width: 40px !important;
                    height: 40px !important;
                    border-radius: 45% !important;
                }
                .dropdown-menu .dropdown-item.text-danger {
                    color: #ff7f00 !important;
                }
           /*  @keyframes rotation {
                from {
                    transform: rotate(0deg);
                }
                to {
                    transform: rotate(360deg);
                }
            } */
            
            /* Animation de pulsation */
            @keyframes pulse {
            0%, 100% {
                transform: scale(1);
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.2); /* Ombre légère */
            }
            50% {
                transform: scale(1.3);
                box-shadow: 0 0 20px rgba(0, 0, 0, 0.4); /* Ombre plus intense pour l'effet de lueur */
            }
            }


        .navbar-brand img {
            height: 60px;
            animation: 
            /* rotation 4s linear infinite; durée: 4s, type: linéaire, infini */
            pulse 2s ease-in-out infinite; /* Pulsation toutes les 2 secondes */
        }
        

        .user-block {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            text-decoration: none;
        }

        .avatar-img, .avatar-placeholder {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #ccc;
            background-color: #ccc;
            color: #fff;
            font-weight: bold;
            font-size: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 5px;
            transition: transform 0.3s ease;
        }
     .avatar-img:hover, .avatar-placeholder:hover {
    transform: scale(1.05);
    border: 3px solid #1f4cf5;
}
/* Micky d*/
        .user-name {
            font-family: 'Poppins', sans-serif !important;
            font-weight: 500;
            font-size: 0.75rem;
            color: #ffffff;
        }
        .user-name:hover {
            color: #1738b8 !important;
            text-decoration: underline !important;
        }
        
        
      /* .badge-direction {
            background-color: #1f4cf5 !important;
            color: #fff !important;
            padding: 4px 20px !important; 
            margin-bottom: 10px;
            border-radius: 20px !important;
            font-weight: 600 !important;
            font-size: 0.8rem !important;
            font-family: 'Poppins', sans-serif !important;
            text-align: center !important;
            text-transform: uppercase !important;
            box-shadow: 0 2px 8px rgba(31, 76, 245, 0.4) !important;
            transition: all 0.3s ease !important;

            display: inline-flex;                    
            align-items: center;         
            justify-content: center;    
            line-height: 1;              
        } */
        /* Micky f*/

       /*  .badge-direction:hover {
            background-color: #1738b8 !important;
            box-shadow: 0 4px 14px rgba(23, 56, 184, 0.6) !important;
            color: #e6eaff !important;
            text-decoration: none !important;
        } */

        .navbar .dropdown-menu {
    top: 100%; /* Positionne le menu juste en dessous de l'élément parent */
    left: auto !important;
    right: 0; /* Aligne à droite pour correspondre à la position du dropdown-toggle */
    }
/* Micky d*/

.nav-link {
    margin-right: 20px; /* Espace entre les éléments du menu */
}

  @media (max-width: 1350px) {
.nav-link {
    margin-right: 3px; /* Supprime l'espace entre les éléments du menu */
}
.navbar-nav {
    font-size: 1rem;      
    }  
 .dropdown {
    font-size: 0.8rem;
    }
    
}  

@media (max-width: 1200px) {
.navbar-nav {
    font-size: 0.8rem;      
    }  
 .dropdown {
    font-size: 0.75rem;
    }
    
}  

/* @media (max-width: 1215px) and (min-width: 992px) {
            .navbar-brand span {
                display: none;
            }
            .navbar-brand {
                margin-right: 0;
            }
            .navbar-nav {
                font-size: 0.7rem;
            }
            .navbar .nav-link {
                padding: 6px 10px !important;
            }
            .user-name {
                font-size: 0.85rem;
            }
            .dropdown {
        
            font-size: 0.65rem; 
            
            }  
            
        } */

@media (max-width: 991px) {
    .navbar-collapse {
        background-color: #1c252e !important;
        padding: 15px;
    }
    .navbar-collapse .navbar-nav {
        flex-direction: column;
    }
    .navbar .nav-link {
        font-size: 0.95rem;
        padding: 10px 15px !important;
    }
    /* .navbar-brand span {
        font-size: 1.1rem !important;
        margin-left: 8px !important;
    } */
    .user-name {
        font-size: 0.9rem;
    }
    .navbar .dropdown-menu {
        position: static;
        float: none;
        width: 100%;
    }
    /* .badge-direction {
        font-size: 0.75rem;
        padding: 3px 15px !important;
    } */
}

/* @media (max-width: 359px) {
    .navbar-brand span {
        display: none;
    }
    .navbar-brand {
        margin-right: 0;
    }
    .navbar-nav {
        font-size: 0.85rem;
    }
    .navbar .nav-link {
        padding: 8px 12px !important;
    }
    .user-name {
        font-size: 0.8rem;
    }
} */

#not-badge {
    display: inline-block;
    min-width: 19px;
    height: 19px;
    background: linear-gradient(135deg, #ff6b6b, #ee5a52);
    color: white;
    border-radius: 50%;
    font-size: 9px;
    font-weight: bold;
    text-align: center;
    line-height: 20px;
    padding: 0 4px;
    box-shadow: 0 2px 8px rgba(255, 107, 107, 0.3);
    position: absolute;
    top: -10px;
    right: -8px;
    border: 2px solid white;
    animation: pulse 2s infinite;
    z-index: 100;
    transition: transform 0.2s ease;
}

#not-badge:hover {
    transform: scale(1.1);
    animation-play-state: paused;
}

/* Animation keyframes */
@keyframes pulse {
    0% { 
        transform: scale(1); 
    }
    50% { 
        transform: scale(1.1); 
    }
    100% { 
        transform: scale(1); 
    }
}

        /* Micky f*/

.navbar-dark .navbar-toggler {
    border: 2px solid #fff;
    border-radius: 8px;
    padding: 8px 12px;
    background-color: rgba(255, 255, 255, 0.1);
    transition: all 0.3s ease;
}

.navbar-dark .navbar-toggler-icon {
    background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 32 32' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgba(255, 255, 255, 0.9)' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 8h24M4 16h24M4 24h24'/%3E%3C/svg%3E");
    width: 24px;
    height: 24px;
}



</style>
</head>

<body class="d-flex flex-column min-vh-100">

<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center" href="{{ route('front-office') }}">
            <img src="/logo/logo_instat.png" alt="Logo INSTAT">
            <!-- Micky d-->
            <!-- <span>INSTAT Microdonnées</span> -->
        </a>
        <button class="navbar-toggler ms-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Micky f-->

        <div class="collapse navbar-collapse mt-2 mt-lg-0" id="navbarSupportedContent">
        
            <ul class="navbar-nav mx-auto">
                <li class="nav-item {{ Route::is('front-office') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('front-office') }}">
                        <!-- <i class="bi bi-house-door"></i>  -->
                        <i class="bi bi-bookmarks"></i>  THÈMES
                    </a>
                </li>
                <li class="nav-item {{ Route::is('showEnquetes') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('showEnquetes') }}">
                        <i class="bi bi-bar-chart-line"></i> RECENSEMENTS ET ENQUÊTES
                    </a>
                </li>
                <li class="nav-item {{ Route::is('historique') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('historique') }}">
                        <i class="bi bi-clock-history"></i> HISTORIQUE DES TÉLÉCHARGEMENTS
                    </a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link" href="https://www.instat.mg/" target="_blank">
                        <i class="bi bi-globe"></i> SITE WEB INSTAT
                    </a>
                </li> -->
            </ul>
            

            <div class="dropdown ml-lg-auto mt-2 mt-lg-0 d-flex align-items-center">
                @if(Auth::user()->isDirection() && Auth::user()->direction)
                <div style="position: relative; display: inline-block;">
                       <a href="{{ route('notifications.index') }}" style= "font-weight: 800; color: #fff; margin-right: 2px;" >
                        <i class="bi bi-bell" style="font-size: 15px;"></i>
                       @if($nouvellesDemandes > 0)
                            <span class="not-badge" id="not-badge">
                               {{ $nouvellesDemandes > 99 ? '99+' : $nouvellesDemandes }}
                            </span>
                       @endif
               </div>
                    <a class="nav-link1 ml-3 mr-3" href="#">{{ Auth::user()->direction->name }}</a>

                @endif
               @php
                    $profilePath = public_path('images/profiles/' . Auth::user()->profile);
                    $profileUrl = file_exists($profilePath) && Auth::user()->profile
                        ? asset('images/profiles/' . Auth::user()->profile)
                        : asset('images.png');
                @endphp

                <a href="#" class="d-flex align-items-center dropdown-toggle" id="userDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="{{ $profileUrl }}" alt="avatar" style="width: 32px; height: 32px; border-radius: 50%;">
                    <span class="ml-2 user-name">{{ Auth::user()->name }}</span>
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    @can('DSIC')
                        <a class="dropdown-item" href="{{ route('profile') }}">
                            <i class="bi bi-person-circle"></i> Voir Profil
                        </a>
                    @endcan
                   
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="bi bi-box-arrow-right"></i> Se déconnecter
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>    


<div>
    @include('layouts.sidebar')
</div>

{{-- <div class="main-content flex-grow-1">
    @yield('content')
</div> --}}

<footer class="footer g-bg-bluegray-darken-3 footer-light-color">
    @include('layouts.footer')
</footer>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

<script src="{{asset('dist/aos.js')}}"></script>
<script>
    AOS.init({
        once: false,
        duration: 600,
        offset: 50,
        mirror: true,
        disable: function() {
            return window.innerWidth < 885; // désactiver AOS sur mobile
        }
    });
</script>

<script>
    $(document).ready(function () {
        $('#userDropdown').dropdown();
    });
</script>
</body>
</html>
