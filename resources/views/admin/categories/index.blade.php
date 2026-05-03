@extends('layouts.dashboard')

@section('title', 'Categorie')

@section('content')

<div class="page-header">
    <h2>Categorie</h2>
    <p class="text-muted">Gestisci le categorie</p>
</div>

<div class="action-header">
    <a href="{{ route('admin.categories.create') }}" class="btn btn-success">
        <i class="fas fa-plus"></i> Nuova Categoria
    </a>
</div>

<div class="card">
    <div class="card-body">

        <table class="table">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th style="text-align:right;">Azioni</th>
                </tr>
            </thead>

            <tbody>
                @forelse($categories as $category)
                <tr>
                    <td class="font-weight-600">{{ $category->name }}</td>

                    <td style="text-align:right;">
                        <a href="{{ route('admin.categories.edit', $category) }}" class="action-link">
                            <i class="fas fa-edit"></i>
                        </a>

                        <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')

                            <button class="action-link delete-btn">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="2" class="text-center text-muted py-4">
                        Nessuna categoria
                    </td>
                </tr>
                @endforelse
            </tbody>

        </table>

    </div>
</div>

@endsection