<header class="topbar">
    <div class="topbar-left">
        <button class="sidebar-toggle-btn" id="sidebarToggleMobile">
            <i class="fas fa-bars"></i>
        </button>
        <h1 class="topbar-title">@yield('title', 'Admin Panel')</h1>
    </div>

    <div class="topbar-right">
        {{-- User Dropdown --}}
        <div class="user-dropdown">
            <button class="user-toggle" id="userToggle">

                {{-- Avatar sicuro --}}
                <div class="user-avatar">
                    {{ Auth::check() && Auth::user()->name 
                        ? strtoupper(substr(Auth::user()->name, 0, 1)) 
                        : 'U' }}
                </div>

                {{-- Nome utente sicuro --}}
                <span class="user-name">
                    {{ Auth::user()?->name ?? 'Utente' }}
                </span>

                <i class="fas fa-chevron-down"></i>
            </button>

            <ul class="dropdown-menu user-menu" id="userMenu">
                <li>
                    <a href="{{ route('profile.edit') }}" class="dropdown-item">
                        <i class="fas fa-user"></i> Profilo
                    </a>
                </li>

                <li>
                    <hr class="dropdown-divider">
                </li>

                <li>
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="dropdown-item">
                            <i class="fas fa-sign-out-alt"></i> Esci
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</header>