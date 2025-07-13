<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar Responsive</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
    <style>
        body {
            margin: 0;
            font-family: 'poppins', sans-serif;
            background-color: #f5f6fa;
        }
.sidebar {
      width: 280px;
      height: 100vh;
      position: fixed;
      top: 0;
      left: -280px; /* cachée au départ */
      background: #ffffff;
      padding:  30px 20px;
      margin-top: 80px;
      box-shadow: 0 20px 60px rgba(0, 0, 0, 0.05);
      border-right: 1px solid #e6e8ec;
    overflow-y: auto;
     border-top-right-radius: 16px;
     border-bottom-right-radius: 16px;
      transition: left 0.35s ease;
      
      z-index: 1000;
    }

    .sidebar.show {
      left: 0;
    }

   .sidebar hr {
    border-top: 1px solid #e6e8ec;
     margin: 25px 0;
    }


   .search-box {
    width: 100%;
    margin-bottom: 30px;
    padding: 12px 16px;
    border-radius: 10px;
    border: 1px solid #dfe3e8;
    background-color: #ffffff;
    font-size: 14px;
    transition: all 0.3s ease;
}

.search-box:focus {
  outline: none;
  border-color: #1f4cf5;
  box-shadow: 0 0 0 2px rgba(31, 76, 245, 0.2);
}


    
/* === LINKS === */
.nav-pills .nav-link {
  padding: 12px 18px;
  margin-bottom: 12px;
  font-size: 15px;
  font-weight: 500;
  color: #2f3542;
  background-color: #f9fafc;
  border-radius: 10px;
  display: flex;
  align-items: center;
  gap: 20px;
  transition: all 0.3s ease;
  box-shadow: 0 0 0 rgba(0, 0, 0, 0);
}

.nav-pills .nav-link i {
  font-size: 18px;
  color: #1f4cf5;
  transition: color 0.3s ease;
}

.nav-pills .nav-link:hover {
  background-color: #e9f0ff;
  color: #1f4cf5;
  transform: translateX(5px);
  box-shadow: 0 4px 14px rgba(31, 76, 245, 0.08);
}

.nav-pills .nav-link.active {
  background-color: #1f4cf5;
  color: #ffffff;
  font-weight: 600;
  box-shadow: 0 6px 18px rgba(31, 76, 245, 0.25);
}

.nav-pills .nav-link.active i {
  color: #ffffff;
}


  
/* === TOGGLE BUTTON === */
.sidebar-toggle {
  position: fixed;
  top: 80px;
  left: 15px;
 outline: none !important;
  z-index: 1101;
  background-color: transparent;
  border: none;
  font-size: 28px;
  color: #1f4cf5;
  cursor: pointer;
  transition: all 0.3s ease;
}

.sidebar-toggle:hover {
  transform: translateY(2px);
  color: #1738b8;
}

.sidebar-toggle i {
  transition: transform 0.4s ease, color 0.3s ease;
}

/* === BADGE NOTIF === */
.not-badge {
  background-color: #e74c3c;
  color: white;
  font-size: 0.6rem;
  padding: 4px 8px;
  border-radius: 12px;
  margin-left: 6px;
  font-weight: bold;
  position: absolute;
  top: -5px;
  right: 0px;
}

        /* Responsive pour mobile */
        @media (max-width: 768px) {
            .sidebar {
                left: -280px;
                position: fixed;
            }

            .sidebar.show {
                left: 0;
            }

            .sidebar-toggle {
                display: block;
            }
        }

        .main-content {
            margin-left: 280px;
            padding: 20px;
        }

        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
            }
        }
        
      /* Contenu principal */
    .main-content {
      margin-left: 0;
      padding: 20px;
      transition: margin-left 0.3s ease;
    }

    /* Si sidebar ouverte, décale le contenu */
    .sidebar.show ~ .main-content {
      margin-left: 280px;
    }

    .not-badge {
      background-color: #e74c3c;
      color: white;
      font-size: 0.5rem;
      padding: 5px 10px;
      border-radius: 50px;
      margin-left: 10px;
      font-weight: bold;
      position: absolute;
      top: -5px;
      right: 0px;
    }
    </style>
</head>
<body>
@if(Auth::user()->isDirection())
<button class="sidebar-toggle" onclick="toggleSidebar(this)">
    <i class="bi bi-list"></i>
</button>


<div id="sidebar" class="sidebar">
    <hr>
    <input type="text" class="search-box" placeholder="Rechercher..." id="searchInput">

    <ul class="nav nav-pills flex-column">
        <li class="nav-item">
            <a href="{{ route('themes.index') }}" class="nav-link {{ Request::routeIs('themes.index') ? 'active' : '' }}">
                <i class="bi bi-folder"></i> THEMES
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('enquete.index') }}" class="nav-link {{ Request::routeIs('enquete.index') ? 'active' : '' }}">
                <i class="bi bi-file-earmark-text"></i> ENQUETES
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('historiques.index') }}" class="nav-link {{ Request::routeIs('historiques.index') ? 'active' : '' }}">
                <i class="bi bi-clock"></i> HISTORIQUE
            </a>
        </li>
        <li class="nav-item">
    <a href="{{ route('notifications.index') }}" class="nav-link {{ Request::routeIs('notifications.index') ? 'active' : '' }}">
    <div style="position: relative; display: inline-block;">
    <i class="bi bi-bell" style="font-size: 20px;"></i>
    @if($nouvellesDemandes > 0)
        <span class="not-badge">
            {{ $nouvellesDemandes }}
        </span>
    @endif
</div>
        NOTIFICATIONS
    </a>
</li>

    </ul>
</div>
@endif
<div class="main-content">
@yield('content')
</div>

<!-- JS -->
<script>
  function toggleSidebar(button) {
    const sidebar = document.getElementById('sidebar');
    const icon = button.querySelector('i');

    sidebar.classList.toggle('show');

    // Change l'icône
    if (sidebar.classList.contains('show')) {
      icon.classList.remove('bi-list');
      icon.classList.add('bi-x');
    } else {
      icon.classList.remove('bi-x');
      icon.classList.add('bi-list');
    }
  }

  // Recherche dans le menu
  document.getElementById('searchInput')?.addEventListener('keyup', function () {
    const filter = this.value.toLowerCase();
    const items = document.querySelectorAll('.nav-item');

    items.forEach(item => {
      const text = item.textContent.toLowerCase();
      item.style.display = text.includes(filter) ? '' : 'none';
    });
  });
</script>


</body>
</html>
