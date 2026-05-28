@extends('layouts.dashboard')

@section('content')

    <div class="container py-4 welcome-page">

    <div class="hero-section text-center mb-5">

        <div class="hero-overlay"></div>

        <div class="position-relative z-1">

            <span class="badge bg-light text-dark px-4 py-2 rounded-pill shadow-sm mb-4">
                ⚽ Aggiornamenti live sul mondo del calcio
            </span>

            <h1 class="display-3 fw-bold text-white mb-4">
                Football Blog
            </h1>

            <p class="lead text-light hero-text mx-auto mb-4">
                Scopri le ultime notizie calcistiche, approfondimenti tattici,
                aggiornamenti di mercato e analisi dettagliate sulle squadre e i giocatori
                più seguiti del momento.
            </p>

            <div class="d-flex justify-content-center gap-3 flex-wrap">

                <a href="{{ route('posts.index') }}"
                    class="btn btn-light btn-lg px-5 py-3 rounded-pill fw-semibold shadow">
                    📰 Esplora gli articoli
                </a>

                <a href="{{route('admin.categories.index')}}"
                    class="btn btn-outline-light btn-lg px-4 py-3 rounded-pill">
                    Scopri le categorie
                </a>

            </div>

        </div>

    </div>

    <div class="row text-center mb-5">

        <div class="col-md-4 mb-3">
            <div class="stats-box">
                <h2 class="fw-bold text-primary mb-1">
                    {{ $postsCount ?? 0 }}+
                </h2>

                <p class="text-muted mb-0">
                    Articoli pubblicati
                </p>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="stats-box">
                <h2 class="fw-bold text-success mb-1">
                    {{ $categories->count() ?? 0 }}+
                </h2>

                <p class="text-muted mb-0">
                    Categorie disponibili
                </p>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="stats-box">
                <h2 class="fw-bold text-danger mb-1">
                    Daily
                </h2>

                <p class="text-muted mb-0">
                    Aggiornamenti quotidiani
                </p>
            </div>
        </div>

    </div>

    <div class="d-flex justify-content-between align-items-center mb-4" id="categorie">

        <div>
            <h2 class="fw-bold mb-1">
                Categorie principali
            </h2>

            <p class="text-muted mb-0">
                Ultimi articoli pubblicati per ogni categoria
            </p>
        </div>

    </div>

    <div class="row g-4">

        @foreach($categories as $category)

        @if($category->latestPost)

        <div class="col-lg-4 col-md-6">

            <a href="{{ route('posts.show', $category->latestPost) }}"
                class="text-decoration-none">

                <div class="custom-news-card h-100">

                    <div class="card-body d-flex flex-column p-4">

                        <div class="category-icon mb-4">

                            @if($category->name === 'News')
                            <i class="bi bi-newspaper fs-2 text-primary"></i>

                            @elseif($category->name === 'Analisi')
                            <i class="bi bi-graph-up fs-2 text-success"></i>

                            @elseif($category->name === 'Calciomercato')
                            <i class="bi bi-arrow-left-right fs-2 text-danger"></i>

                            @else
                            <i class="bi bi-bookmark-star fs-2 text-warning"></i>
                            @endif

                        </div>

                        <span class="welcome-category-badge mb-3 align-self-start">
                            {{ $category->name }}
                        </span>

                        <h4 class="welcome-card-title fw-bold mb-3">
                            {{ Str::limit($category->latestPost->title, 65) }}
                        </h4>

                        <p class="welcome-card-excerpt mb-4">
                            {{ Str::limit($category->latestPost->content, 120) }}
                        </p>

                        <div class="d-flex align-items-center justify-content-between mt-auto">

                            <div class="d-flex align-items-center gap-2">
                                <div class="author-avatar">
                                    {{ strtoupper(substr($category->latestPost->writer, 0, 1)) }}
                                </div>

                                <div>

                                    <small class="welcome-author fw-semibold d-block">
                                        {{ $category->latestPost->writer }}
                                    </small>

                                    <small class="welcome-date">
                                        {{ $category->latestPost->created_at->translatedFormat('d F Y') }}
                                    </small>

                                </div>

                            </div>

                            <span class="read-more-btn">
                                →
                            </span>

                        </div>

                    </div>

                </div>

            </a>

        </div>

        @endif

        @endforeach

    </div>

</div>

<style>
    .hero-section {
        position: relative;
        overflow: hidden;
        border-radius: 32px;
        padding: 100px 30px;
        background:
            linear-gradient(135deg,
                rgba(13, 110, 253, 0.88),
                rgba(25, 135, 84, 0.82)),
            url('/images/football-bg.jpg');

        background-size: cover;
        background-position: center;
    }

    .hero-overlay {
        position: absolute;
        inset: 0;
        backdrop-filter: blur(2px);
    }

    .hero-text {
        max-width: 760px;
        font-size: 1.2rem;
    }

    .welcome-page h2,
    .welcome-page .fw-bold {
        color: #f8fbff;
    }

    .welcome-page .text-muted {
        color: rgba(203, 213, 225, 0.78) !important;
    }

    .stats-box {
        background:
            linear-gradient(180deg, rgba(255, 255, 255, 0.09), rgba(255, 255, 255, 0.045)),
            rgba(10, 22, 39, 0.78);
        border-radius: 24px;
        padding: 30px;
        border: 1px solid rgba(226, 232, 240, 0.13);
        box-shadow: 0 14px 34px rgba(0, 0, 0, 0.16);
        height: 100%;
    }

    .stats-box .text-primary,
    .stats-box .text-success,
    .stats-box .text-danger {
        color: #7dd3fc !important;
    }

    .custom-news-card {
        border-radius: 28px;
        overflow: hidden;
        background:
            linear-gradient(180deg, rgba(255, 255, 255, 0.11), rgba(255, 255, 255, 0.055)),
            rgba(10, 22, 39, 0.84);

        border: 1px solid rgba(226, 232, 240, 0.14);

        transition: all .35s ease;

        box-shadow: 0 16px 38px rgba(0, 0, 0, 0.18);

        height: 100%;
    }

    .custom-news-card:hover {
        transform: translateY(-8px);
        border-color: rgba(125, 211, 252, 0.30);
        box-shadow: 0 22px 52px rgba(0, 0, 0, 0.24);
    }

    .category-icon {
        width: 72px;
        height: 72px;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;

        background:
            linear-gradient(135deg, rgba(56, 189, 248, 0.16), rgba(99, 102, 241, 0.12));
        border: 1px solid rgba(125, 211, 252, 0.18);
    }

    .welcome-category-badge {
        display: inline-flex;
        align-items: center;
        padding: 0.52rem 0.82rem;
        border-radius: 999px;
        border: 1px solid rgba(125, 211, 252, 0.28);
        background: rgba(56, 189, 248, 0.14);
        color: #e0f2fe;
        font-size: 0.78rem;
        font-weight: 800;
        line-height: 1;
    }

    .welcome-card-title {
        color: #ffffff;
        line-height: 1.28;
    }

    .welcome-card-excerpt {
        color: rgba(226, 232, 240, 0.80);
        line-height: 1.7;
    }

    .welcome-author {
        color: #f8fbff;
    }

    .welcome-date {
        color: rgba(203, 213, 225, 0.74);
    }

    .author-avatar {
        width: 42px;
        height: 42px;
        border-radius: 50%;

        background: linear-gradient(135deg,
                #0d6efd,
                #198754);

        color: white;

        display: flex;
        align-items: center;
        justify-content: center;

        font-weight: bold;
    }

    .read-more-btn {
        width: 42px;
        height: 42px;
        border-radius: 50%;

        background: #0d6efd;
        color: white;

        display: flex;
        align-items: center;
        justify-content: center;

        font-size: 20px;
        font-weight: bold;

        transition: all .3s ease;
    }

    .custom-news-card:hover .read-more-btn {
        transform: translateX(4px);
    }

    a {
        text-decoration: none;
    }

    a:hover {
        text-decoration: none;
    }

    @media(max-width: 768px) {

        .hero-section {
            padding: 70px 20px;
        }

        .hero-text {
            font-size: 1rem;
        }

        .display-3 {
            font-size: 2.5rem;
        }

    }
</style>

@endsection
