@extends('layouts.dashboard')

@section('title', 'Nuovo Articolo')

@section('content')

<div class="page-header">
    <h2>Nuovo Articolo</h2>
    <p class="text-muted">Crea un nuovo articolo per il blog</p>
</div>

{{-- Errori --}}
@if ($errors->any())
<div class="alert alert-danger">
    <strong>Errori di validazione:</strong>
    <ul class="mb-0">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="card" style="max-width: 800px;">
    <div class="card-header">
        <h3>Compila i dettagli dell'articolo</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.posts.store') }}" method="POST">
            @csrf

            {{-- Titolo --}}
            <div class="form-group">
                <label for="title">Titolo *</label>
                <input type="text" id="title" name="title" class="form-control" value="{{ old('title') }}">
                @error('title')
                <span class="form-error">{{ $message }}</span>
                @enderror
            </div>

            {{-- Contenuto --}}
            <div class="form-group">
                <label for="content">Contenuto *</label>
                <textarea id="content" name="content" class="form-control" rows="6">{{ old('content') }}</textarea>
                @error('content')
                <span class="form-error">{{ $message }}</span>
                @enderror
            </div>

            {{-- Categoria --}}
            <div class="form-group">
                <label for="category_id">Categoria *</label>
                <select id="category_id" name="category_id" class="form-select">
                    <option value="">Seleziona una categoria</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                    @endforeach
                </select>
                @error('category_id')
                <span class="form-error">{{ $message }}</span>
                @enderror
            </div>

            {{-- Squadre (Multiple) --}}
            <div class="form-group">
                <label for="teams">Squadre *</label>
                <select id="teams" name="teams[]" class="form-select" multiple style="min-height: 120px;">
                    @foreach($teams as $team)
                    <option value="{{ $team->id }}" {{ in_array($team->id, old('teams', [])) ? 'selected' : '' }}>
                        {{ $team->name }}
                    </option>
                    @endforeach
                </select>
                <small class="form-text">Seleziona una o più squadre (Ctrl/Cmd + Click)</small>
                @error('teams')
                <span class="form-error">{{ $message }}</span>
                @enderror
            </div>

            {{-- Pulsanti --}}
            <div class="form-actions">
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i> Salva Articolo
                </button>
                <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">Annulla</a>
            </div>
        </form>
    </div>
</div>

@endsection
