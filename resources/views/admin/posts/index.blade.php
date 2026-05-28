@extends('layouts.dashboard')

@section('title', 'Gestione Articoli')

@section('content')

<div class="posts-dashboard-container">

    <div class="dashboard-hero">

        <div class="dashboard-hero-shape"></div>

        <div class="dashboard-hero-content">

            <div class="dashboard-hero-icon">
                <i class="fas fa-newspaper"></i>
            </div>

            <h1>
                Gestione Articoli
            </h1>

            <p>
                Crea, modifica e organizza tutti gli articoli del tuo blog
                con una dashboard moderna e professionale.
            </p>

        </div>

    </div>

    <div class="dashboard-topbar">

        <div>

            <h2>
                Elenco Articoli
            </h2>

            <span>
                Gestisci rapidamente i contenuti pubblicati
            </span>

        </div>

        <a href="{{ route('admin.posts.create') }}"
            class="create-post-btn">

            <i class="bi bi-plus-lg"></i>



        </a>

    </div>

    <div class="dashboard-filter-card">

        <div class="dashboard-filter-header">

            <div>

                <h5>
                    Filtri Articoli
                </h5>

                <p>
                    Filtra gli articoli per categoria o data
                </p>

            </div>

            <div class="dashboard-filter-icon">
                <i class="fas fa-filter"></i>
            </div>

        </div>

        <form method="GET"
            action="{{ route('admin.posts.index') }}">

            <div class="row g-3 align-items-end">

                <div class="col-md-4">

                    <label for="category_id"
                        class="form-label">

                        Categoria

                    </label>

                    <select name="category_id"
                        id="category_id"
                        class="form-select dashboard-input">

                        <option value="">
                            Tutte
                        </option>

                        @foreach($categories as $category)

                        <option value="{{ $category->id }}"
                            {{ request('category_id') == $category->id ? 'selected' : '' }}>

                            {{ $category->name }}

                        </option>

                        @endforeach

                    </select>

                </div>

                <div class="col-md-4">

                    <label for="sort"
                        class="form-label">

                        Ordina per

                    </label>

                    <select name="sort"
                        id="sort"
                        class="form-select dashboard-input">

                        <option value="">
                            Seleziona
                        </option>

                        <option value="recent"
                            {{ request('sort') == 'recent' ? 'selected' : '' }}>

                            Più recenti

                        </option>

                        <option value="oldest"
                            {{ request('sort') == 'oldest' ? 'selected' : '' }}>

                            Meno recenti

                        </option>

                    </select>

                </div>

                <div class="col-md-4 d-flex gap-2">

                    <button type="submit"
                        class="dashboard-filter-btn w-100">

                        Filtra

                    </button>

                    <a href="{{ route('admin.posts.index') }}"
                        class="dashboard-reset-btn">

                        ↺

                    </a>

                </div>

            </div>

        </form>

    </div>

    <div class="dashboard-table-wrapper">

        <div class="table-responsive">

            <table class="dashboard-table">

                <thead>

                    <tr>

                        <th>Articolo</th>
                        <th>Categoria</th>
                        <th>Squadre</th>
                        <th>Pubblicato</th>
                        <th class="text-center">Azioni</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($posts as $post)

                    <tr>

                        <td class="article-column">

                            <div class="article-card-preview">

                                <div class="article-image-wrapper">

                                    @if($post->image)

                                    <img src="{{ asset('storage/' . $post->image) }}"
                                        alt="{{ $post->title }}"
                                        class="article-preview-image">

                                    @else

                                    <div class="article-image-placeholder">

                                        <i class="bi bi-image"></i>

                                    </div>

                                    @endif

                                </div>

                                <div class="article-content">

                                    <div class="article-title-label">
                                        Titolo articolo
                                    </div>

                                    <h3 class="article-title">
                                        {{ $post->title }}
                                    </h3>

                                    <p>
                                        {{ Str::limit(strip_tags($post->content), 90) }}
                                    </p>

                                </div>

                            </div>

                        </td>

                        <td>

                            <span class="dashboard-category-badge">

                                {{ $post->category->name ?? '-' }}

                            </span>

                        </td>

                        <td>

                            @if($post->teams->isNotEmpty())

                            <div class="dashboard-team-list">

                                @foreach($post->teams as $team)

                                <span class="dashboard-team-badge"
                                    style="background-color: {{ $team->color }};">

                                    {{ $team->name }}

                                </span>

                                @endforeach

                            </div>

                            @else

                            <span class="empty-label">
                                Nessuna squadra
                            </span>

                            @endif

                        </td>

                        <td>

                            <div class="dashboard-date">

                                <strong>
                                    {{ $post->created_at->format('d/m/Y') }}
                                </strong>

                                <span>
                                    {{ $post->created_at->diffForHumans() }}
                                </span>

                            </div>

                        </td>

                        <td>

                            <div class="dashboard-actions">

                                <a href="{{ route('posts.show', [
                                    'post' => $post,
                                    ...request()->query()
                                ]) }}"
                                    class="dashboard-action-btn view-btn">

                                    <i class="fas fa-eye"></i>

                                </a>

                                <a href="{{ route('admin.posts.edit', $post) }}"
                                    class="dashboard-action-btn edit-btn">

                                    <i class="fas fa-pen"></i>

                                </a>

                                <button
                                    class="dashboard-action-btn delete-btn"
                                    data-bs-toggle="modal"
                                    data-bs-target="#deleteModal{{ $post->id }}">

                                    <i class="bi bi-trash-fill"></i>

                                </button>

                            </div>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="5">

                            <div class="dashboard-empty-state">

                                <i class="bi bi-journal-x"></i>

                                <h4>
                                    Nessun articolo trovato
                                </h4>

                                <p>
                                    Inizia creando il tuo primo articolo
                                </p>

                            </div>

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@foreach($posts as $post)
<div class="modal fade"
    id="deleteModal{{ $post->id }}"
    tabindex="-1"
    aria-labelledby="deleteModalTitle{{ $post->id }}"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content border-0 rounded-4 shadow-lg">

            <div class="modal-header border-0">

                <h5 class="modal-title fw-bold" id="deleteModalTitle{{ $post->id }}">
                    Conferma eliminazione
                </h5>

                <button type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Chiudi">

                </button>

            </div>

            <div class="modal-body">

                Vuoi eliminare definitivamente
                <strong>{{ $post->title }}</strong>?

            </div>

            <div class="modal-footer border-0">

                <button type="button"
                    class="btn btn-outline-secondary rounded-pill px-4"
                    data-bs-dismiss="modal">

                    Annulla

                </button>

                <form action="{{ route('admin.posts.destroy', $post) }}"
                    method="POST"
                    data-delete-form>

                    @csrf
                    @method('DELETE')

                    <button type="submit"
                        class="btn btn-danger rounded-pill px-4"
                        data-loading-text="Eliminazione...">

                        Elimina

                    </button>

                </form>

            </div>

        </div>

    </div>

</div>
@endforeach

@endsection
