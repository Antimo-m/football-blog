<aside class="sidebar" id="sidebar">

    <!-- HEADER -->
    <div class="sidebar-header">
        <a href="{{ route('dashboard') }}" class="logo">
            <i class="fas fa-futbol"></i>
            <span class="logo-text">Football Blog</span>
        </a>

        <button class="sidebar-close" id="sidebarClose">
            <i class="fas fa-times"></i>
        </button>
    </div>


    <!-- NAV -->
    <nav class="sidebar-nav">
        <ul class="nav-list">

            {{-- Dashboard --}}
            <li class="nav-item">
                <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="fas fa-home"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>

            {{-- Articoli --}}
            <li class="nav-item">
                <a href="{{ route('admin.posts.index') }}" class="nav-link {{ request()->routeIs('admin.posts.*') ? 'active' : '' }}">
                    <i class="fas fa-newspaper"></i>
                    <span class="nav-text">Articoli</span>
                </a>
            </li>

            {{-- Categorie --}}
            <li class="nav-item">
                <a href="{{ route('admin.categories.index') }}" class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                    <i class="fas fa-folder-open"></i>
                    <span class="nav-text">Categorie</span>
                </a>
            </li>

            {{-- Squadre --}}
            <li class="nav-item">
                <a href="{{ route('admin.teams.index') }}" class="nav-link {{ request()->routeIs('admin.teams.*') ? 'active' : '' }}">
                    <i class="fas fa-people-group"></i>
                    <span class="nav-text">Squadre</span>
                </a>
            </li>

        </ul>
    </nav>


    <!-- USER FOOTER -->
    <div class="sidebar-footer">

        <div class="user-box" id="userToggle">

            <div class="user-avatar">
                {{ auth()->user() ? strtoupper(substr(auth()->user()->name, 0, 1)) : 'U' }}
            </div>

            <div class="user-info">
                <span class="user-name">
                    {{ auth()->user()->name ?? 'Utente' }}
                </span>
                <span class="user-role">Admin</span>
            </div>

            <i class="fas fa-chevron-up"></i>
        </div>

        {{-- DROPDOWN --}}
        <div class="user-menu" id="userMenu">
            <a href="{{ route('profile.edit') }}" class="dropdown-item">
                <i class="fas fa-user"></i> Profilo
            </a>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="dropdown-item">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </div>

    </div>

</aside>