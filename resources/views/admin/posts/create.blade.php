@extends('layouts.dashboard')

@section('title', 'Creazione Articoli')

@section('content')

<div class="text-center mb-4">
    <h1 class="fw-bold fs-2 mb-1">Nuovo Articolo</h1>
    <p class="text-muted">Crea e pubblica un nuovo contenuto</p>
</div>

<div class="d-flex justify-content-center">

    <div class="w-100" style="max-width: 700px;">

        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4">

                <form action="{{ route('admin.posts.store') }}" method="POST">
                    @csrf

                    {{-- Titolo --}}
                    <div class="mb-4">
                        <label class="form-label fw-semibold fs-5">Titolo</label>
                        <input type="text" name="title"
                            class="form-control form-control-lg"
                            placeholder="Inserisci il titolo..."
                            value="{{ old('title') }}">

                        @error('title')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Categoria --}}
                    <div class="mb-4">
                        <label class="form-label fw-semibold fs-5">Categoria</label>
                        <select name="category_id" class="form-select form-select-lg">
                            <option value="">Seleziona categoria</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                            @endforeach
                        </select>

                        @error('category_id')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Contenuto --}}
                    <div class="mb-4">
                        <label class="form-label fw-semibold fs-5">Contenuto</label>
                        <textarea name="content"
                            class="form-control"
                            rows="5"
                            placeholder="Scrivi il contenuto...">{{ old('content') }}</textarea>

                        @error('content')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Squadre --}}
                    <div class="mb-4">
                        <label class="form-label fw-semibold fs-5">Squadre</label>

                        <div class="d-flex flex-wrap gap-2">
                            @foreach($teams as $team)
                            <div class="form-check">
                                <input
                                    class="btn-check"
                                    type="checkbox"
                                    name="teams[]"
                                    value="{{ $team->id }}"
                                    id="team{{ $team->id }}"
                                    {{ in_array($team->id, old('teams', [])) ? 'checked' : '' }}>

                                <label
                                    class="btn btn-outline-primary rounded-pill px-3 py-1"
                                    for="team{{ $team->id }}">
                                    {{ $team->name }}
                                </label>
                            </div>
                            @endforeach
                        </div>

                        @error('teams')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Azioni --}}
                    <div class="d-flex justify-content-between align-items-center mt-4">

                        {{-- Bottone Annulla --}}
                        <button
                            type="button"
                            class="btn btn-outline-secondary btn-danger rounded-pill px-4"
                            data-bs-toggle="modal"
                            data-bs-target="#cancelModal">
                            Annulla
                        </button>

                        {{-- Bottone Salva --}}
                        <button type="submit"
                            class="btn btn-success rounded-pill px-4">
                            Salva
                        </button>
                    </div>
                </form>
                <div class="modal fade" id="cancelModal" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content rounded-4">

                            <div class="modal-header border-0">
                                <h5 class="modal-title fw-semibold">Annullare le modifiche?</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <div class="modal-body">
                                Se torni indietro perderai i dati inseriti. Vuoi continuare?
                            </div>

                            <div class="modal-footer border-0">

                                <button type="button"
                                    class="btn btn-outline-secondary btn-success rounded-pill px-3"
                                    data-bs-dismiss="modal">
                                    Continua modifica
                                </button>

                                <a href="{{ route('admin.posts.index') }}"
                                    class="btn btn-warning rounded-pill px-3">
                                    Conferma
                                </a>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

@endsection