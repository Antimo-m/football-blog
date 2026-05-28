@extends('layouts.dashboard')

@section('title', 'Creazione Articoli')

@section('content')

<div class="container py-5 d-flex justify-content-center">

    <div class="w-100" style="max-width: 760px;">


        <div class="text-center mb-5">

            <h1 class="fw-bold display-6 mb-2">
                Nuovo Articolo
            </h1>

            <p class="text-muted">
                Crea e pubblica un nuovo contenuto
            </p>

        </div>


        @if ($errors->any())

        <div class="alert alert-danger rounded-4 shadow-sm border-0">

            <strong>Errori di validazione:</strong>

            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>

        </div>

        @endif

        <div class="card border-0 shadow-lg rounded-5">

            <div class="card-body p-5">

                <form
                    action="{{ route('admin.posts.store') }}"
                    method="POST"
                    enctype="multipart/form-data">

                    @csrf


                    <div class="mb-4">

                        <label class="form-label fw-semibold mb-2">
                            Titolo
                        </label>

                        <input
                            type="text"
                            name="title"
                            class="form-control rounded-4 py-3"
                            placeholder="Inserisci il titolo..."
                            value="{{ old('title') }}">

                        @error('title')
                        <div class="text-danger small mt-1">
                            {{ $message }}
                        </div>
                        @enderror

                    </div>


                    <div class="mb-4">

                        <label class="form-label fw-semibold mb-2">
                            Scrittore
                        </label>

                        <input
                            type="text"
                            name="writer"
                            class="form-control rounded-4 py-3"
                            placeholder="Nome autore"
                            value="{{ old('writer') }}">

                        @error('writer')
                        <div class="text-danger small mt-1">
                            {{ $message }}
                        </div>
                        @enderror

                    </div>


                    <div class="mb-5">

                        <label class="form-label fw-semibold mb-3">
                            Categoria
                        </label>

                        <div class="d-flex flex-wrap gap-2">

                            @foreach($categories as $category)

                            <div class="form-check p-0">

                                <input
                                    class="btn-check"
                                    type="radio"
                                    name="category_id"
                                    value="{{ $category->id }}"
                                    id="category{{ $category->id }}"
                                    {{ old('category_id') == $category->id ? 'checked' : '' }}>

                                <label
                                    class="btn btn-outline-dark rounded-pill px-4 py-2"
                                    for="category{{ $category->id }}">

                                    {{ $category->name }}

                                </label>

                            </div>

                            @endforeach

                        </div>

                        @error('category_id')
                        <div class="text-danger small mt-2">
                            {{ $message }}
                        </div>
                        @enderror

                    </div>


                    <div class="mb-5">

                        <label class="form-label fw-semibold mb-3">
                            Squadre
                        </label>

                        <div class="d-flex flex-wrap gap-2">

                            @foreach($teams as $team)

                            <div class="form-check p-0">

                                <input
                                    class="btn-check"
                                    type="checkbox"
                                    name="teams[]"
                                    value="{{ $team->id }}"
                                    id="team{{ $team->id }}"
                                    {{ in_array($team->id, old('teams', [])) ? 'checked' : '' }}>

                                <label
                                    class="btn btn-outline-primary rounded-pill px-4 py-2"
                                    for="team{{ $team->id }}">

                                    {{ $team->name }}

                                </label>

                            </div>

                            @endforeach

                        </div>

                        @error('teams')
                        <div class="text-danger small mt-2">
                            {{ $message }}
                        </div>
                        @enderror

                    </div>

                    {{-- Contenuto --}}
                    <div class="mb-5">

                        <label class="form-label fw-semibold mb-2">
                            Contenuto
                        </label>

                        <textarea
                            name="content"
                            rows="7"
                            class="form-control rounded-4 p-3"
                            placeholder="Scrivi il contenuto dell'articolo...">{{ old('content') }}</textarea>

                        @error('content')
                        <div class="text-danger small mt-1">
                            {{ $message }}
                        </div>
                        @enderror

                    </div>

                   
                    <div class="mb-5">

                        <label
                            for="image"
                            class="file-upload rounded-5 border border-2 border-dashed p-5 text-center w-100"
                            data-file-upload>

                            <div class="upload-content">

                                <i class="bi bi-cloud-arrow-up display-5 text-primary"></i>

                                <p class="fw-semibold mt-3 mb-1">
                                    Carica immagine articolo
                                </p>

                                <small class="text-muted">
                                    PNG, JPG, WEBP
                                </small>

                            </div>

                            <div class="upload-preview d-none mt-3">

                                <img
                                    src=""
                                    alt="Preview"
                                    class="img-fluid rounded-4 shadow-sm"
                                    style="max-height: 260px;"
                                    data-upload-preview>

                            </div>

                            <div
                                class="upload-confirmation d-none mt-3 text-success"
                                data-upload-confirmation>

                                <i class="bi bi-check-circle-fill"></i>

                                <span>
                                    Immagine caricata correttamente
                                </span>

                            </div>

                            <input
                                id="image"
                                type="file"
                                name="image"
                                accept="image/*"
                                hidden
                                data-file-input>

                        </label>

                        @error('image')
                        <div class="text-danger small mt-2">
                            {{ $message }}
                        </div>
                        @enderror

                    </div>

                    <div class="d-flex justify-content-between align-items-center">

                        <button
                            type="button"
                            class="btn btn-danger btn-outline-secondary rounded-pill px-4 py-2"
                            data-bs-toggle="modal"
                            data-bs-target="#cancelModal">
                            Annulla
                        </button>

                        <button
                            type="submit"
                            class="btn btn-success rounded-pill px-5 py-2 fw-semibold">

                            Pubblica Articolo

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>


<div class="modal fade" id="cancelModal" tabindex="-1">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content rounded-5 border-0 shadow-lg">

            <div class="modal-header border-0 pb-0">

                <h5 class="modal-title fw-bold">
                    Annullare la creazione?
                </h5>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"></button>

            </div>

            <div class="modal-body pt-2">

                <p class="text-muted mb-0">
                    Se torni indietro perderai tutti i dati inseriti.
                </p>

            </div>

            <div class="modal-footer border-0 pt-0">


                <button
                    type="button"
                    class="btn btn-info text-white rounded-pill px-4"
                    data-bs-dismiss="modal">

                    Torna indietro

                </button>


                <a
                    href="{{ route('admin.posts.index') }}"
                    class="btn btn-danger rounded-pill px-4">

                    Conferma annullamento

                </a>

            </div>

        </div>

    </div>

</div>

@endsection