@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <h1 class="mb-4 text-center">Gestione Articoli</h1>

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('admin.posts.create') }}"
            class="btn btn-success d-flex align-items-center justify-content-center rounded-circle shadow-sm"
            style="width: 45px; height: 45px; font-size: 1.4rem;">
            +
        </a>
    </div>

    {{-- TABLE --}}
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">

            <table class="table align-middle mb-0">

                <thead class="bg-light">
                    <tr>
                        <th class="px-4 py-3">Titolo</th>
                        <th>Categoria</th>
                        <th>Squadre</th>
                        <th class="text-end px-4">Azioni</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($posts as $post)
                    <tr>

                        <td class="px-4 py-3 fw-semibold">
                            {{ $post->title }}
                        </td>

                        <td>
                            <span class="badge bg-primary">
                                {{ $post->category->name }}
                            </span>
                        </td>

                        <td>
                            @php
                            $colors = ['primary', 'success', 'danger', 'warning', 'info', 'dark'];
                            @endphp

                            @foreach($post->teams as $team)
                            <span class="badge bg-{{ $colors[$loop->index % count($colors)] }}">
                                {{ $team->name }}
                            </span>
                            @endforeach
                        </td>

                        <td class="text-end px-4">

                            {{-- SHOW --}}
                            <a href="{{ route('posts.show', $post) }}" class="btn btn-sm btn-outline-primary">
                                👁
                            </a>

                            {{-- EDIT --}}
                            <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-sm btn-outline-warning">
                                ✏️
                            </a>

                            {{-- DELETE --}}
                            <button
                                type="button"
                                class="btn btn-sm btn-outline-danger"
                                data-bs-toggle="modal"
                                data-bs-target="#deleteModal{{ $post->id }}">
                                🗑
                            </button>

                        </td>

                    </tr>
                    @endforeach
                </tbody>

            </table>

        </div>
    </div>

</div>


@foreach($posts as $post)
<div class="modal fade" id="deleteModal{{ $post->id }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            {{-- HEADER --}}
            <div class="modal-header">
                <h5 class="modal-title">Conferma eliminazione</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            {{-- BODY --}}
            <div class="modal-body">
                Sei sicuro di voler eliminare:
                <strong>{{ $post->title }}</strong>?
            </div>

            {{-- FOOTER --}}
            <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Annulla
                </button>

                <form action="{{ route('admin.posts.destroy', $post) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <button class="btn btn-danger">
                        Elimina
                    </button>
                </form>

            </div>

        </div>
    </div>
</div>
@endforeach

@endsection