@extends('layouts.dashboard')

@section('title', 'Categorie')

@section('content')

<div class="categories-dashboard-container">

    <div class="categories-dashboard-hero">

        <div class="categories-dashboard-shape"></div>

        <div class="categories-dashboard-content">

            <div class="categories-dashboard-icon">
                <i class="fas fa-folder"></i>
            </div>

            <h1>
                Gestione Categorie
            </h1>

            <p>
                Organizza e gestisci tutte le categorie del blog
                con una dashboard moderna, ordinata e professionale.
            </p>

        </div>

    </div>

    <div class="categories-dashboard-topbar">

        <div>

            <h2>
                Elenco Categorie
            </h2>

            <span>
                Visualizza e modifica rapidamente le categorie disponibili
            </span>

        </div>

        <a href="{{ route('admin.categories.create') }}"
            class="categories-create-btn">

            <i class="bi bi-plus-lg"></i>

            

        </a>

    </div>

    <div class="categories-table-wrapper">

        <div class="table-responsive">

            <table class="categories-table">

                <thead>

                    <tr>

                        <th>Categoria</th>
                        <th class="text-center">Azioni</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($categories as $category)

                    <tr>

                        <td>

                            <div class="category-name-wrapper">

                                <div class="category-content">

                                    <div class="category-label">
                                        Categoria
                                    </div>

                                    <div class="category-name-badge">

                                        <div class="category-badge-dot"></div>

                                        {{ $category->name }}

                                    </div>

                                </div>

                            </div>

                        </td>

                        <td>

                            <div class="categories-actions">

                                <button
                                    type="button"
                                    class="categories-action-btn edit-btn category-edit-btn"
                                    data-url="{{ route('admin.categories.update', $category) }}"
                                    data-name="{{ $category->name }}"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editCategoryModal">

                                    <i class="fas fa-pen"></i>

                                </button>

                                <button
                                    class="categories-action-btn delete-btn"
                                    data-bs-toggle="modal"
                                    data-bs-target="#deleteCategoryModal{{ $category->id }}">

                                    <i class="bi bi-trash-fill"></i>

                                </button>

                            </div>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="2">

                            <div class="categories-empty-state">

                                <i class="bi bi-folder-x"></i>

                                <h4>
                                    Nessuna categoria trovata
                                </h4>

                                <p>
                                    Inizia creando la tua prima categoria
                                </p>

                            </div>

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@foreach($categories as $category)
<div class="modal fade"
    id="deleteCategoryModal{{ $category->id }}"
    tabindex="-1"
    aria-labelledby="deleteCategoryModalTitle{{ $category->id }}"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content border-0 rounded-4 shadow-lg">

            <div class="modal-header border-0">

                <h5 class="modal-title fw-bold" id="deleteCategoryModalTitle{{ $category->id }}">
                    Conferma eliminazione
                </h5>

                <button type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Chiudi">

                </button>

            </div>

            <div class="modal-body">

                Vuoi eliminare definitivamente
                <strong>{{ $category->name }}</strong>?

            </div>

            <div class="modal-footer border-0">

                <button type="button"
                    class="btn btn-outline-secondary rounded-pill px-4"
                    data-bs-dismiss="modal">

                    Annulla

                </button>

                <form action="{{ route('admin.categories.destroy', $category) }}"
                    method="POST"
                    data-delete-form>

                    @csrf
                    @method('DELETE')

                    <button type="submit"
                        class="btn btn-danger rounded-pill px-4"
                        data-loading-text="Eliminazione...">

                        Elimina

                    </button>

                </form>

            </div>

        </div>

    </div>

</div>
@endforeach

<div class="modal fade"
    id="editCategoryModal"
    tabindex="-1"
    aria-labelledby="editCategoryModalTitle"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content border-0 rounded-4 shadow-lg">

            <div class="modal-header border-0">

                <h5 class="modal-title fw-bold" id="editCategoryModalTitle">
                    Modifica Categoria
                </h5>

                <button type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Chiudi">

                </button>

            </div>

            <form id="editCategoryForm"
                method="POST"
                action="">

                @csrf
                @method('PUT')

                <div class="modal-body">

                    <div class="mb-3">

                        <label class="form-label fw-semibold">
                            Nome Categoria
                        </label>

                        <input type="text"
                            name="name"
                            id="editCategoryName"
                            class="form-control categories-input">

                    </div>

                </div>

                <div class="modal-footer border-0">

                    <button type="button"
                        class="btn btn-danger btn-outline-secondary rounded-pill px-4"
                        data-bs-dismiss="modal">

                        Annulla

                    </button>

                    <button class="btn btn-success rounded-pill px-4">

                        Salva

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection

@push('scripts')

<script>
    document.addEventListener('DOMContentLoaded', function() {

        const buttons = document.querySelectorAll('.category-edit-btn');

        buttons.forEach(button => {

            button.addEventListener('click', function() {

                const name = this.dataset.name;
                const url = this.dataset.url;

                document.getElementById('editCategoryName').value = name;
                document.getElementById('editCategoryForm').action = url;

            });

        });

    });
</script>

@endpush
