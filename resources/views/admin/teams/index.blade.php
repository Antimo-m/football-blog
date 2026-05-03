@extends('layouts.dashboard')

@section('content')

<div class="container mt-4">

    <div class="text-center mb-4">
        <h1>Gestione Squadre</h1>
    </div>

    {{-- BUTTON NUOVA SQUADRA --}}
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('admin.teams.create') }}"
            class="btn btn-success d-flex align-items-center justify-content-center rounded-circle shadow-sm"
            style="width: 45px; height: 45px; font-size: 1.4rem;">
            +
        </a>
    </div>

    {{-- CARD TABLE --}}
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">

            <table class="table align-middle mb-0">

                <thead class="bg-light">
                    <tr>
                        <th class="px-4 py-3">Nome</th>
                        <th class="text-end px-4">Azioni</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($teams as $team)
                    <tr>

                        <td class="px-4 py-3 fw-semibold">
                            {{ $team->name }}
                        </td>

                        <td class="text-end px-4">

                            {{-- EDIT --}}
                            <a href="{{ route('admin.teams.edit', $team) }}"
                                class="btn btn-sm btn-outline-warning">
                                ✏️
                            </a>

                            {{-- DELETE --}}
                            <button
                                class="btn btn-sm btn-outline-danger"
                                data-bs-toggle="modal"
                                data-bs-target="#deleteModal{{ $team->id }}">
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

{{-- MODALI DELETE --}}
@foreach($teams as $team)
<div class="modal fade" id="deleteModal{{ $team->id }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Conferma eliminazione</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                Sei sicuro di voler eliminare:
                <strong>{{ $team->name }}</strong>?
            </div>

            <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Annulla
                </button>

                <form action="{{ route('admin.teams.destroy', $team) }}" method="POST">
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