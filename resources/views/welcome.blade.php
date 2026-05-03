@extends('layouts.app')

@section('content')

<div class="container">

    {{-- HERO --}}
    <div class="py-5 text-center">
        <h1 class="fw-bold display-4">Football Blog</h1>

        <p class="text-muted mt-3 fs-5">
            Notizie aggiornate su campionati, trasferimenti e analisi delle partite.
        </p>

        <a href="{{ route('posts.index') }}" class="btn btn-dark btn-lg mt-4 px-4">
            📰 Vai agli articoli
        </a>
    </div>

    {{-- FEATURED POSTS --}}
    <div class="row g-4 mt-5 mb-5">

        {{-- NEWS --}}
        <div class="col-md-4">
            @if($newsPost)
                <a href="{{ route('posts.show', $newsPost) }}" class="text-decoration-none">
                    <div class="card border-0 shadow-sm h-100" style="transition: all 0.3s ease;">
                        <div class="card-body d-flex flex-column">
                            <div class="mb-3">
                                <i class="bi bi-newspaper fs-1 text-primary"></i>
                            </div>
                            
                            <h5 class="card-title fw-bold text-dark mb-2">News</h5>
                            
                            <p class="text-muted small mb-3">
                                <i class="bi bi-calendar-event"></i> {{ $newsPost->created_at->translatedFormat('d F Y') }}
                            </p>
                            
                            <h6 class="card-text text-dark mb-3 flex-grow-1">
                                {{ Str::limit($newsPost->title, 60) }}
                            </h6>

                            <div class="mt-auto">
                                <span class="badge bg-primary">Leggi articolo →</span>
                            </div>
                        </div>
                    </div>
                </a>
            @else
                <div class="card border-0 shadow-sm h-100" style="background-color: #f8f9fa;">
                    <div class="card-body text-center">
                        <i class="bi bi-newspaper fs-1 text-muted"></i>
                        <h5 class="card-title fw-bold text-dark mt-3">News</h5>
                        <p class="text-muted">Nessun articolo disponibile</p>
                    </div>
                </div>
            @endif
        </div>

        {{-- ANALISI --}}
        <div class="col-md-4">
            @if($analisiPost)
                <a href="{{ route('posts.show', $analisiPost) }}" class="text-decoration-none">
                    <div class="card border-0 shadow-sm h-100" style="transition: all 0.3s ease;">
                        <div class="card-body d-flex flex-column">
                            <div class="mb-3">
                                <i class="bi bi-graph-up fs-1 text-success"></i>
                            </div>
                            
                            <h5 class="card-title fw-bold text-dark mb-2">Analisi</h5>
                            
                            <p class="text-muted small mb-3">
                                <i class="bi bi-calendar-event"></i> {{ $analisiPost->created_at->translatedFormat('d F Y') }}
                            </p>
                            
                            <h6 class="card-text text-dark mb-3 flex-grow-1">
                                {{ Str::limit($analisiPost->title, 60) }}
                            </h6>

                            <div class="mt-auto">
                                <span class="badge bg-success">Leggi articolo →</span>
                            </div>
                        </div>
                    </div>
                </a>
            @else
                <div class="card border-0 shadow-sm h-100" style="background-color: #f8f9fa;">
                    <div class="card-body text-center">
                        <i class="bi bi-graph-up fs-1 text-muted"></i>
                        <h5 class="card-title fw-bold text-dark mt-3">Analisi</h5>
                        <p class="text-muted">Nessun articolo disponibile</p>
                    </div>
                </div>
            @endif
        </div>

        {{-- CALCIOMERCATO --}}
        <div class="col-md-4">
            @if($calciomercatoPost)
                <a href="{{ route('posts.show', $calciomercatoPost) }}" class="text-decoration-none">
                    <div class="card border-0 shadow-sm h-100" style="transition: all 0.3s ease;">
                        <div class="card-body d-flex flex-column">
                            <div class="mb-3">
                                <i class="bi bi-arrow-left-right fs-1 text-danger"></i>
                            </div>
                            
                            <h5 class="card-title fw-bold text-dark mb-2">Calciomercato</h5>
                            
                            <p class="text-muted small mb-3">
                                <i class="bi bi-calendar-event"></i> {{ $calciomercatoPost->created_at->translatedFormat('d F Y') }}
                            </p>
                            
                            <h6 class="card-text text-dark mb-3 flex-grow-1">
                                {{ Str::limit($calciomercatoPost->title, 60) }}
                            </h6>

                            <div class="mt-auto">
                                <span class="badge bg-danger">Leggi articolo →</span>
                            </div>
                        </div>
                    </div>
                </a>
            @else
                <div class="card border-0 shadow-sm h-100" style="background-color: #f8f9fa;">
                    <div class="card-body text-center">
                        <i class="bi bi-arrow-left-right fs-1 text-muted"></i>
                        <h5 class="card-title fw-bold text-dark mt-3">Calciomercato</h5>
                        <p class="text-muted">Nessun articolo disponibile</p>
                    </div>
                </div>
            @endif
        </div>

    </div>

</div>

<style>
    .card {
        cursor: pointer;
    }

    a .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1) !important;
    }

    a {
        text-decoration: none;
    }

    a:hover {
        text-decoration: none;
    }
</style>

@endsection
