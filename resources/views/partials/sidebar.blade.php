<aside class="sidebar" id="sidebar">

    <!-- HEADER -->
    <div class="sidebar-header">
        <a href="{{ route('home') }}" class="logo">
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
    <div class="sidebar-footer p-3 border-top">

        <div class="dropup w-100">

            {{-- TOGGLE --}}
            <button
                class="btn w-100 d-flex justify-content-between align-items-center text-white border-0 rounded-3 px-2 py-2"
                style="background-color: rgba(255,255,255,0.05);"
                data-bs-toggle="dropdown"
                data-bs-display="static">

                <div class="text-start">
                    @auth
                    <div class="fw-semibold">
                        {{ auth()->user()->name }}
                    </div>
                    <small class="text-secondary">Admin</small>
                    @else
                    <div class="fw-semibold">Guest</div>
                    <small class="text-secondary">Utente</small>
                    @endauth
                </div>

                <i class="fas fa-chevron-up text-secondary"></i>
            </button>

            {{-- MENU --}}
            <ul class="dropdown-menu dropdown-menu-dark w-100 mt-2 border-0 rounded-3">

                @auth
                <li>
                    <a class="dropdown-item d-flex align-items-center gap-2 w-100 px-3"
                        href="{{ route('profile.edit') }}">
                        <i class="fas fa-user"></i>
                        Profilo
                    </a>
                </li>

                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="dropdown-item d-flex align-items-center gap-2 w-100 px-3 text-danger border-0 bg-transparent text-start">
                            <i class="fas fa-sign-out-alt"></i>
                            Logout
                        </button>
                    </form>
                </li>
                @else
                <li>
                    <a class="dropdown-item d-flex align-items-center gap-2"
                        href="{{ route('login') }}">
                        <i class="fas fa-sign-in-alt"></i>
                        Login
                    </a>
                </li>

                <li>
                    <a class="dropdown-item d-flex align-items-center gap-2"
                        href="{{ route('register') }}">
                        <i class="fas fa-user-plus"></i>
                        Registrati
                    </a>
                </li>
                @endauth

            </ul>

        </div>

    </div>
</aside>