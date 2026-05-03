@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <h1 class="mb-4">Modifica Articolo</h1>

    {{-- ERRORI --}}
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.posts.update', $post) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- TITOLO --}}
        <div class="mb-3">
            <label class="form-label">Titolo</label>
            <input type="text" name="title" class="form-control"
                value="{{ old('title', $post->title) }}">
        </div>

        {{-- CONTENUTO --}}
        <div class="mb-3">
            <label class="form-label">Contenuto</label>
            <textarea name="content" class="form-control" rows="5">{{ old('content', $post->content) }}</textarea>
        </div>

        {{-- CATEGORIA --}}
        <div class="mb-3">
            <label class="form-label">Categoria</label>
            <select name="category_id" class="form-select">
                @foreach($categories as $category)
                <option value="{{ $category->id }}"
                    {{ $category->id == $post->category_id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
                @endforeach
            </select>
        </div>

        {{-- TEAM (CHECKBOX) --}}
        <div class="mb-3">
            <label class="form-label">Squadre</label>

            @foreach($teams as $team)
            <div class="form-check">
                <input
                    type="checkbox"
                    name="teams[]"
                    value="{{ $team->id }}"
                    class="form-check-input"
                    {{ $post->teams->contains($team->id) ? 'checked' : '' }}>

                <label class="form-check-label">
                    {{ $team->name }}
                </label>
            </div>
            @endforeach
        </div>

        <button class="btn btn-primary">Aggiorna</button>

    </form>

</div>

@endsection