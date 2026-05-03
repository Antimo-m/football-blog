@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('content')

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
                    <th>Data</th>
                    <th>Azioni</th>
                </tr>
            </thead>

            <tbody>
                @forelse($recentPosts as $post)
                <tr>
                    <td class="font-weight-600">{{ $post->title }}</td>

                    <td>
                        <span class="badge bg-light">
                            {{ $post->category->name ?? '-' }}
                        </span>
                    </td>

                    <td class="text-muted">
                        {{ $post->created_at->format('d M Y') }}
                    </td>

                    <td>
                        <a href="{{ route('posts.show', $post) }}" class="action-link">
                            <i class="fas fa-eye"></i>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center text-muted py-4">
                        Nessun articolo disponibile
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection