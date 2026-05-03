@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <h1 class="mb-4">Modifica Categoria</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body">

            <form method="POST" action="{{ route('admin.categories.update', $category) }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Nome</label>
                    <input type="text"
                        name="name"
                        value="{{ $category->name }}"
                        class="form-control">
                </div>

                <button class="btn btn-primary">
                    Aggiorna
                </button>

            </form>

        </div>
    </div>

</div>

@endsection