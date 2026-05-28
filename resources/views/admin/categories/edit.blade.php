<!-- @extends('layouts.dashboard')

@section('title', 'Modifica Categoria')

@section('content')

<div class="container py-4" style="max-width: 600px;">

    {{-- HEADER --}}
    <div class="text-center mb-4">
        <h1 class="fw-bold fs-3 mb-1">Modifica Categoria</h1>
        <p class="text-muted mb-0">Aggiorna il nome della categoria</p>
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

  
    <form method="POST" action="{{ route('admin.categories.update', $category) }}">
        @csrf
        @method('PUT')

    
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-body p-4">

                <div class="mb-3">
                    <label class="form-label fw-semibold fs-6">Nome Categoria</label>

                    <input type="text"
                        name="name"
                        value="{{ $category->name }}"
                        class="form-control"
                        placeholder="Inserisci il nome categoria">
                </div>

            </div>
        </div>

      
        <div class="d-flex justify-content-center gap-2 mt-3">

            <a href="{{ route('admin.categories.index') }}"
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