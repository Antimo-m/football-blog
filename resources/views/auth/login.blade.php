@extends('layouts.dashboard')

@section('title', 'Login')

@section('content')
<main class="auth-page" aria-labelledby="auth-title">
    <div class="auth-shell">
        <section class="auth-hero" aria-label="Area amministrativa">
            <p class="auth-eyebrow">Football Blog Admin</p>

            <div class="auth-hero-copy">
                <h1>Gestisci contenuti sportivi con precisione editoriale.</h1>
                <p>
                    Accedi al workspace per pubblicare articoli, organizzare categorie
                    e mantenere il flusso editoriale sempre sotto controllo.
                </p>
            </div>

            <div class="auth-signal" aria-hidden="true">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </section>

        <section class="auth-panel" aria-label="Login amministratore">
            <div class="auth-form-wrap">
                <header class="auth-header">
                    <p class="auth-kicker">Area riservata</p>
                    <h2 id="auth-title">Bentornato</h2>
                    <p>Inserisci le credenziali per continuare nel pannello.</p>
                </header>

                <form class="auth-form" method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="auth-field">
                        <label for="email">Email</label>
                        <input
                            id="email"
                            type="email"
                            class="auth-input @error('email') is-invalid @enderror"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autocomplete="email"
                            autofocus
                            placeholder="nome@dominio.it">

                        @error('email')
                            <p class="auth-error" role="alert">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="auth-field">
                        <label for="password">Password</label>
                        <input
                            id="password"
                            type="password"
                            class="auth-input @error('password') is-invalid @enderror"
                            name="password"
                            required
                            autocomplete="current-password"
                            placeholder="La tua password">

                        @error('password')
                            <p class="auth-error" role="alert">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="auth-meta">
                        <label class="auth-remember" for="remember">
                            <input
                                type="checkbox"
                                name="remember"
                                id="remember"
                                {{ old('remember') ? 'checked' : '' }}>
                            <span>Ricordami</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}">Password dimenticata?</a>
                        @endif
                    </div>

                    <button class="auth-submit" type="submit">
                        Accedi al pannello
                    </button>
                </form>
            </div>
        </section>
    </div>
</main>
@endsection
