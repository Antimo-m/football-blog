@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <h1 class="mb-4">Nuovo Articolo</h1>

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

    <form action="{{ route('admin.posts.store') }}" method="POST">
        @csrf

        {{-- TITOLO --}}
        <div class="mb-3">
            <label class="form-label">Titolo</label>
            <input type="text" name="title" class="form-control" value="{{ old('title') }}">
        </div>

        {{-- CONTENUTO --}}
        <div class="mb-3">
            <label class="form-label">Contenuto</label>
            <textarea name="content" class="form-control" rows="5">{{ old('content') }}</textarea>
        </div>

        {{-- CATEGORIA --}}
        <div class="mb-3">
            <label class="form-label">Categoria</label>
            <select name="category_id" class="form-select">
                @foreach($categories as $category)
                <option value="{{ $category->id }}">
                    {{ $category->name }}
                </option>
                @endforeach
            </select>
        </div>

        {{-- TEAM (MULTIPLA) --}}
        <div class="mb-3">
            <label class="form-label">Squadre</label>

            @foreach($teams as $team)
            <div class="form-check">
                <input
                    type="checkbox"
                    name="teams[]"
                    value="{{ $team->id }}"
                    class="form-check-input">

                <label class="form-check-label" for="{ $team->id }}">
                    {{ $team->name }}
                </label>
            </div>
            @endforeach
        </div>

        <button class="btn btn-success">Salva</button>

    </form>

</div>

@endsection