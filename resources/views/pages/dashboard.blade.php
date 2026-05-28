@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('content')

<section class="admin-dashboard-intro">
    <div class="admin-dashboard-intro-shape"></div>

    <div class="admin-dashboard-intro-content">
        <span class="admin-dashboard-kicker">Pannello amministrativo</span>

        <h1>Controlla contenuti, categorie e squadre da un unico workspace.</h1>

        <p>
            Monitora rapidamente l'attivita editoriale, accedi agli ultimi articoli
            e gestisci le sezioni principali del blog con strumenti pensati per un flusso di lavoro ordinato.
        </p>
    </div>
</section>

<div class="page-header">
    <h2>Dashboard</h2>
    <p class="text-muted">Benvenuto nel pannello di amministrazione</p>
</div>

<div class="stats-grid">

    <div class="stat-card stat-blue">
        <div class="stat-icon">
            <i class="fas fa-newspaper"></i>
        </div>
        <div class="stat-content">
            <h3>{{ $postsCount }}</h3>
            <p>Articoli Totali</p>
        </div>
    </div>

    <div class="stat-card stat-purple">
        <div class="stat-icon">
            <i class="fas fa-folder"></i>
        </div>
        <div class="stat-content">
            <h3>{{ $categoriesCount }}</h3>
            <p>Categorie</p>
        </div>
    </div>

    <div class="stat-card stat-green">
        <div class="stat-icon">
            <i class="fas fa-football"></i>
        </div>
        <div class="stat-content">
            <h3>{{ $teamsCount }}</h3>
            <p>Squadre</p>
        </div>
    </div>

    <div class="stat-card stat-orange">
        <div class="stat-icon">
            <i class="fas fa-users"></i>
        </div>
        <div class="stat-content">
            <h3>{{ $usersCount }}</h3>
            <p>Utenti</p>
        </div>
    </div>

</div>

<div class="card">
    <div class="card-header">
        <h3>Articoli Recenti</h3>
        <a href="{{ route('posts.index') }}" class="link-btn">
            Visualizza tutti →
        </a>
    </div>

    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>Titolo</th>
                    <th>Categoria</th>
                    <th>Squadra tag</th>
                    <th>Data</th>
                    <th class="text-center">Azioni</th>
                </tr>
            </thead>

            <tbody>
                @forelse($recentPosts as $post)
                <tr>
                    <td class="font-weight-600">
                        <div class="dashboard-recent-post">
                            @if($post->image)
                                <img
                                    src="{{ asset('storage/' . $post->image) }}"
                                    alt="{{ $post->title }}"
                                    class="dashboard-recent-post-image">
                            @else
                                <div class="dashboard-recent-post-placeholder">
                                    <i class="bi bi-image"></i>
                                </div>
                            @endif

                            <div class="dashboard-recent-post-copy">
                                <strong>{{ $post->title }}</strong>
                                <span>{{ \Illuminate\Support\Str::limit(strip_tags($post->content), 72) }}</span>
                            </div>
                        </div>
                    </td>

                    <td>
                        <span class="badge bg-light">
                            {{ $post->category->name ?? '-' }}
                        </span>
                    </td>
                    <td>
                        @if($post->teams->isNotEmpty())
                        @foreach($post->teams as $team)
                        <span class="badge px-2 py-1 rounded-pill"
                            style="background-color: {{ $team->color }}; color: white;">
                            {{ $team->name }}
                        </span>
                        @endforeach
                        @else
                        <span class="text-muted small">N/A</span>
                        @endif
                    </td>
                    <td class="text-muted">
                        {{ $post->created_at->format('d M Y') }}
                    </td>

                    <td class="text-center">
                        <a href="{{ route('posts.show', $post) }}" class="action-link">
                            <i class="fas fa-eye"></i>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted py-4">
                        Nessun articolo disponibile
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
