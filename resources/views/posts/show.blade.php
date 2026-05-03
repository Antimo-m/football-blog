@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <a href="{{ route('posts.index') }}" class="btn btn-secondary mb-3">
        ← Torna alla lista
    </a>

    <div class="card shadow-sm">

        {{-- Immagine --}}
        <img src="https://source.unsplash.com/1200x500/?football"
            class="card-img-top">

        <div class="card-body">

            <h1 class="mb-3">Titolo: {{ $post->title }}</h1>

            <p class="text-muted mb-2">
                <small>Data di pubblicazione: {{ $post->formatted_date }}</small>
            </p>

            <p><strong>Slug:</strong> {{ $post->slug }}</p>

            Categoria articolo
            <div class="mb-3">
                <span class="badge bg-primary">
                    {{ $post->category->name }}
                </span>
                <p>tag</p>
                @foreach($post->teams as $team)
                <span class="badge bg-secondary">{{ $team->name }}</span>
                @endforeach
            </div>

            <p class="lead">
                Contenuto articolo: {{ $post->content }}
            </p>

        </div>

    </div>

</div>

@endsection