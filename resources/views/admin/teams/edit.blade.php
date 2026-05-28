@extends('layouts.dashboard')

@section('title', 'Modifica Squadra')

<!-- @section('content')

<div class="container py-4" style="max-width: 600px;">

    {{-- HEADER --}}
    <div class="text-center mb-4">
        <h1 class="fw-bold fs-3 mb-1">Modifica Squadra</h1>
        <p class="text-muted mb-0">Aggiorna i dettagli della squadra</p>
    </div>

    {{-- ERRORI --}}
    @if ($errors->any())
    <div class="alert alert-danger rounded-4">
        <ul class="mb-0 mt-2">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    {{-- FORM --}}
    <form method="POST" action="{{ route('admin.teams.update', $team) }}">
        @csrf
        @method('PUT')

        {{-- CARD --}}
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-body p-4">

                <div class="mb-3">
                    <label class="form-label fw-semibold fs-6">Nome</label>

                    <input type="text"
                        name="name"
                        value="{{ old('name', $team->name) }}"
                        class="form-control"
                        placeholder="Inserisci il nome squadra">
                </div>

            </div>
        </div>

        {{-- AZIONI --}}
        <div class="d-flex justify-content-center gap-2 mt-3">

            <a href="{{ route('admin.teams.index') }}"
                class="btn btn-danger btn-outline-secondary rounded-pill px-4">
                Annulla
            </a>

            <button type="submit"
                class="btn btn-primary rounded-pill px-4">
                Aggiorna
            </button>

        </div>

    </form>

</div>

@endsection -->