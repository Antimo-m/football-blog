@extends('layouts.dashboard')

@section('title', 'Dettaglio Articolo')

@section('content')

<div class="container" style="max-width: 900px;">

    <div class="text-center mb-4">

        <h1 class="fw-bold fs-3 mb-1">
            Dettaglio Articolo
        </h1>

        <p class="text-muted mb-0">
            Visualizza il contenuto dell'articolo
        </p>

    </div>

    <div class="mb-4">

        <a
            href="{{ route('admin.posts.index', request()->query()) }}"
            class="btn btn-danger btn-outline-secondary rounded-pill px-4 py-2">
            ← Torna alla lista
        </a>
    </div>


    <div class="card border-0 shadow-lg rounded-5 overflow-hidden">

        <div class="post-image-wrapper">

            <img
                src="{{ $post->image
                    ? asset('storage/' . $post->image)
                    : asset('images/default-football.jpg')
                }}"
                alt="{{ $post->title }}"
                class="post-image">

        </div>

        <div class="card-body p-5">

            <h2 class="fw-bold mb-2">
                {{ $post->title }}
            </h2>

            <p class="text-muted small mb-4">
                {{ $post->formatted_date }}
            </p>

            <hr class="my-4">

            <p class="fw-semibold mb-4">
                Scritto da: {{ $post->writer }}
            </p>

            <div class="mb-4">

                <h6 class="text-muted fw-semibold mb-2">
                    Categoria
                </h6>

                <span class="badge bg-primary rounded-pill px-3 py-2">

                    {{ $post->category->name }}

                </span>

            </div>

            <div class="mb-4">

                <h6 class="text-muted fw-semibold mb-2">
                    Squadre
                </h6>

                <div class="d-flex flex-wrap gap-2">

                    @foreach($post->teams as $team)

                    @php
                        $teamColor = ltrim($team->color ?? '#0d6efd', '#');
                        $hex = strlen($teamColor) === 3
                            ? $teamColor[0] . $teamColor[0] . $teamColor[1] . $teamColor[1] . $teamColor[2] . $teamColor[2]
                            : str_pad($teamColor, 6, '0');
                        $red = hexdec(substr($hex, 0, 2));
                        $green = hexdec(substr($hex, 2, 2));
                        $blue = hexdec(substr($hex, 4, 2));
                        $luminance = (($red * 299) + ($green * 587) + ($blue * 114)) / 1000;
                        $teamTextColor = $luminance > 150 ? '#0f172a' : '#ffffff';
                    @endphp

                    <span
                        class="badge article-team-badge rounded-pill px-3 py-2"
                        style="background-color: #{{ $hex }}; color: {{ $teamTextColor }};">

                        {{ $team->name }}

                    </span>

                    @endforeach

                </div>

            </div>

            <hr class="my-4">

            <div>

                <h5 class="fw-semibold mb-3">
                    Contenuto
                </h5>

                <p class="text-secondary lh-lg mb-0">

                    {{ $post->content }}

                </p>

            </div>

        </div>

    </div>

</div>

<style>
    .post-image-wrapper {
        width: 100%;
        height: 480px;
        overflow: hidden;
        background: #f8f9fa;
    }

    .post-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    @media (max-width: 768px) {

        .post-image-wrapper {
            height: 300px;
        }

    }
</style>

@endsection
