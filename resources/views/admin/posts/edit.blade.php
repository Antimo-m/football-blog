@extends('layouts.dashboard')

@section('title', 'Modifica Articolo')

@section('content')

<div class="d-flex justify-content-center py-4">

    <div class="w-100" style="max-width: 680px;">

        {{-- HEADER --}}
        <div class="text-center mb-4">
            <h1 class="fw-bold fs-3 mb-1">Modifica Articolo</h1>
            <p class="text-muted mb-0">Aggiorna i dettagli del contenuto</p>
        </div>

        {{-- ERRORI --}}
        @if ($errors->any())
        <div class="alert alert-danger rounded-4">
            <strong>Errori di validazione:</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        {{-- CARD --}}
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-body p-4">

                <form action="{{ route('admin.posts.update', $post) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Titolo --}}
                    <div class="mb-4">
                        <label class="form-label fw-semibold fs-5">Titolo</label>
                        <input type="text" name="title"
                            class="form-control form-control-lg"
                            value="{{ old('title', $post->title) }}">

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
                            <option value="{{ $category->id }}" {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>
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
                            rows="5">{{ old('content', $post->content) }}</textarea>

                        @error('content')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Squadre (pill style come create) --}}
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
                                    {{ in_array($team->id, old('teams', $post->teams->pluck('id')->toArray())) ? 'checked' : '' }}>

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

                    {{-- AZIONI --}}
                    <div class="d-flex justify-content-between align-items-center mt-4">

                        <a href="{{ route('admin.posts.index') }}"
                            class="btn btn-outline-secondary rounded-pill px-4">
                            Annulla
                        </a>

                        <button type="submit"
                            class="btn btn-primary rounded-pill px-4">
                            Aggiorna
                        </button>

                    </div>

                </form>

            </div>
        </div>

    </div>

</div>

@endsection