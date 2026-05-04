@extends('layouts.dashboard')

@section('title', 'Gestione Articoli')

@section('content')

<div class="container" style="max-width: 1000px;">

    {{-- HEADER --}}
    <div class="text-center mb-4">
        <h1 class="fw-bold fs-3 mb-1">Gestione Articoli</h1>
        <p class="text-muted mb-0">Crea, modifica e gestisci i tuoi articoli</p>
    </div>

    {{-- FILTRO --}}
    <div class="d-flex justify-content-center align-items-center gap-3 mb-4">

        <div class="card shadow-sm border-0 rounded-4" style="width: 320px;">
            <div class="card-body py-3 px-3">

                <form id="filterForm" method="GET" action="{{ route('admin.posts.index') }}">
                    <label for="category_id" class="form-label small text-muted mb-1">
                        Categoria
                    </label>

                    <select name="category_id" id="category_id" class="form-select">
                        <option value="">Tutte</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                        @endforeach
                    </select>
                </form>

            </div>
        </div>

        <div class="d-flex flex-column gap-2">
            <button type="submit" form="filterForm"
                class="btn btn-primary px-4 py-2 rounded-pill fw-semibold">
                Filtra
            </button>

            @if(request('category_id'))
            <a href="{{ route('admin.posts.index') }}"
                class="btn btn-outline-secondary rounded-pill">
                ↺
            </a>
            @endif
        </div>

    </div>

    {{-- NUOVO ARTICOLO --}}
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('admin.posts.create') }}"
            class="btn btn-success rounded-circle shadow-sm d-flex align-items-center justify-content-center"
            style="width: 45px; height: 45px;">
            +
        </a>
    </div>

    {{-- TABELLA --}}
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body p-0">

            <table class="table align-middle mb-0">
                <thead class="text-center">
                    <tr>
                        <th>Titolo</th>
                        <th>Categoria</th>
                        <th>Squadre</th>
                        <th class="text-center">Azioni</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($posts as $post)

                    <tr>
                        <td class="fw-semibold">{{ $post->title }}</td>

                        <td>
                            <span class="badge bg-light text-dark rounded-pill">
                                {{ $post->category->name ?? '-' }}
                            </span>
                        </td>

                        <td>
                            @forelse($post->teams as $team)
                            <span class="badge bg-light text-primary rounded-pill">
                                {{ $team->name }}
                            </span>
                            @empty
                            <span class="text-muted">-</span>
                            @endforelse
                        </td>

                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">

                                <a href="{{ route('posts.show', $post) }}"
                                    class="btn btn-sm btn-outline-secondary rounded-pill"
                                    title="Visualizza">
                                    <i class="fas fa-eye"></i>
                                </a>

                                <a href="{{ route('admin.posts.edit', $post) }}"
                                    class="btn btn-sm btn-outline-primary rounded-pill"
                                    title="Modifica">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <button
                                    class="btn btn-sm btn-outline-danger rounded-pill"
                                    data-bs-toggle="modal"
                                    data-bs-target="#deleteModal{{ $post->id }}"
                                    title="Elimina">
                                    <i class="bi bi-trash-fill"></i>
                                </button>

                            </div>
                        </td>
                    </tr>

                    {{-- MODAL --}}
                    <div class="modal fade" id="deleteModal{{ $post->id }}" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content rounded-4">

                                <div class="modal-header border-0">
                                    <h5 class="modal-title fw-semibold">Conferma eliminazione</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <div class="modal-body">
                                    Vuoi eliminare <strong>{{ $post->title }}</strong>?
                                </div>

                                <div class="modal-footer border-0">

                                    <button type="button"
                                        class="btn btn-primary btn-outline-secondary rounded-pill"
                                        data-bs-dismiss="modal">
                                        Annulla
                                    </button>

                                    <form action="{{ route('admin.posts.destroy', $post) }}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            class="btn btn-danger rounded-pill">
                                            Elimina
                                        </button>
                                    </form>

                                </div>

                            </div>
                        </div>
                    </div>

                    @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted py-4">
                            Nessun articolo trovato
                        </td>
                    </tr>
                    @endforelse

                </tbody>
            </table>

        </div>
    </div>

</div>

@endsection