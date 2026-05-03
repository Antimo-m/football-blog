@extends('layouts.dashboard')

@section('title', 'Gestione Articoli')

@section('content')

<div class="page-header">
    <h2>Gestione Articoli</h2>
    <p class="text-muted">Crea, modifica e gestisci i tuoi articoli</p>
</div>

{{-- Filtro Categoria --}}
<div class="filter-section">
    <div class="card">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.posts.index') }}" class="filter-form">
                <div class="form-group">
                    <label for="category_id">Filtra per Categoria</label>
                    <select name="category_id" id="category_id" class="form-select">
                        <option value="">Tutte</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Filtra</button>
                    @if(request('category_id'))
                    <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">↺ Ripristina</a>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Pulsante Nuovo Articolo --}}
<div class="action-header">
    <a href="{{ route('admin.posts.create') }}" class="btn btn-success">
        <i class="fas fa-plus"></i> Nuovo Articolo
    </a>
</div>

{{-- Tabella Articoli --}}
<div class="card">
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>Titolo</th>
                    <th>Categoria</th>
                    <th>Squadre</th>
                    <th style="text-align: right;">Azioni</th>
                </tr>
            </thead>
            <tbody>
                @forelse($posts as $post)
                <tr>
                    <td class="font-weight-600">{{ $post->title }}</td>
                    <td>
                        <span class="badge bg-light">{{ $post->category->name ?? '-' }}</span>
                    </td>
                    <td>
                        @forelse($post->teams as $team)
                            <span class="badge bg-light" style="color: #1976d2;">{{ $team->name }}</span>
                        @empty
                            <span class="text-muted">-</span>
                        @endforelse
                    </td>
                    <td style="text-align: right;">
                        <a href="{{ route('posts.show', $post) }}" class="action-link" title="Visualizza">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('admin.posts.edit', $post) }}" class="action-link" title="Modifica">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button class="action-link delete-btn" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $post->id }}" title="Elimina">
                            <i class="fas fa-trash"></i>
                        </button>

                        {{-- MODALE CONFERMA ELIMINAZIONE --}}
                        <div class="modal fade" id="deleteModal{{ $post->id }}" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Conferma eliminazione</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        Sei sicuro di voler eliminare il post <strong>{{ $post->title }}</strong>?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                                        <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Elimina</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center text-muted py-4">
                        <i class="fas fa-inbox" style="font-size: 24px; margin-bottom: 8px; display: block; opacity: 0.5;"></i>
                        Nessun articolo trovato
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
