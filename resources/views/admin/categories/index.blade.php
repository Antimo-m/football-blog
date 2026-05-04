@extends('layouts.dashboard')

@section('title', 'Categorie')

@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <title>Document</title>
</head>

<body>
    <div class="page-header">
        <h2>Categorie</h2>
        <p class="text-muted">Gestisci le categorie</p>
    </div>

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('admin.categories.create') }}"
            class="btn btn-success d-flex align-items-center justify-content-center rounded-circle shadow-sm"
            style="width: 45px; height: 45px; font-size: 1.4rem;">
            +
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

                        <td class="text-end">
                            <div class="d-inline-flex align-items-center gap-2">

                                <a href="{{ route('admin.categories.edit', $category) }}"
                                    class="btn btn-sm btn-outline-primary"
                                    title="Modifica">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <button
                                    class="btn btn-sm btn-outline-danger"
                                    data-bs-toggle="modal"
                                    data-bs-target="#deleteCategoryModal{{ $category->id }}"
                                    title="Elimina">
                                    <i class="bi bi-trash-fill"></i>
                                </button>

                            </div>

                            {{-- MODALE CONFERMA ELIMINAZIONE --}}
                            <div class="modal fade" id="deleteCategoryModal{{ $category->id }}" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <h5 class="modal-title">Conferma eliminazione</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>

                                        <div class="modal-body">
                                            Sei sicuro di voler eliminare la categoria
                                            <strong>{{ $category->name }}</strong>?
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                Annulla
                                            </button>

                                            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-danger">
                                                    Elimina
                                                </button>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>
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

</body>

</html>
@endsection