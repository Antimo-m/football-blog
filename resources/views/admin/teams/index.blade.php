@extends('layouts.dashboard')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<div class="teams-dashboard-container">

    <div class="teams-dashboard-hero">

        <div class="teams-dashboard-shape"></div>

        <div class="teams-dashboard-content">

            <div class="teams-dashboard-icon">
                <i class="fas fa-football-ball"></i>
            </div>

            <h1>
                Gestione Squadre
            </h1>

            <p>
                Organizza e gestisci tutte le squadre presenti nel sistema
                con una dashboard moderna e intuitiva.
            </p>

        </div>

    </div>

    <div class="teams-dashboard-topbar">

        <div>

            <h2>
                Elenco Squadre
            </h2>

            <span>
                Visualizza, modifica ed elimina rapidamente le squadre
            </span>

        </div>

        <a href="{{ route('admin.teams.create') }}"
            class="teams-create-btn">

            <i class="bi bi-plus-lg"></i>


        </a>

    </div>

    <div class="teams-table-wrapper">

        <div class="table-responsive">

            <table class="teams-table">

                <thead>

                    <tr>

                        <th>Squadra</th>

                        <th class="text-center">Azioni</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($teams as $team)

                    <tr>

                        <td>

                            <div class="team-name-wrapper">

                                <div class="team-content">

                                    <div class="team-label">
                                        Squadra
                                    </div>

                                    <div class="team-name-badge"
                                        style=" border-color: {{ $team->color }};background: {{ $team->color }}15;color: {{ $team->color }};
                 ">

                                        <div class="team-badge-dot"
                                            style="background-color: {{ $team->color }};">
                                        </div>

                                        {{ $team->name }}

                                    </div>

                                </div>

                            </div>

                        </td>

                        <td>

                            <div class="teams-actions">

                                <button
                                    type="button"
                                    class="teams-action-btn edit-btn edit-team-btn"
                                    data-url="{{ route('admin.teams.update', $team) }}"
                                    data-color="{{ $team->color }}"
                                    data-name="{{ $team->name }}"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editTeamModal">

                                    <i class="fas fa-pen"></i>

                                </button>

                                <button
                                    class="teams-action-btn delete-btn"
                                    data-bs-toggle="modal"
                                    data-bs-target="#deleteModal{{ $team->id }}">

                                    <i class="bi bi-trash-fill"></i>

                                </button>

                            </div>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="2">

                            <div class="teams-empty-state">

                                <i class="bi bi-shield-x"></i>

                                <h4>
                                    Nessuna squadra trovata
                                </h4>

                                <p>
                                    Inizia creando la tua prima squadra
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

<div class="modal fade" id="editTeamModal" tabindex="-1">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content border-0 rounded-4 shadow-lg">

            <div class="modal-header border-0">

                <h5 class="modal-title fw-bold">
                    Modifica Squadra
                </h5>

                <button type="button"
                    class="btn-close"
                    data-bs-dismiss="modal">

                </button>

            </div>

            <form id="editTeamForm"
                method="POST"
                action="">

                @csrf
                @method('PUT')

                <div class="modal-body">

                    <div class="mb-4">

                        <label class="form-label fw-semibold">
                            Nome Squadra
                        </label>

                        <input type="text"
                            name="name"
                            id="editTeamName"
                            class="form-control teams-input">

                    </div>

                    <div class="text-center">

                        <label class="form-label fw-semibold d-block mb-3">
                            Colore squadra
                        </label>

                        <input type="color"
                            name="color"
                            id="editTeamColor"
                            class="teams-color-input">

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

@foreach($teams as $team)

<div class="modal fade"
    id="deleteModal{{ $team->id }}"
    tabindex="-1">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content border-0 rounded-4 shadow-lg">

            <div class="modal-header border-0">

                <h5 class="modal-title fw-bold">
                    Conferma eliminazione
                </h5>

                <button type="button"
                    class="btn-close"
                    data-bs-dismiss="modal">

                </button>

            </div>

            <div class="modal-body">

                Vuoi eliminare definitivamente
                <strong>{{ $team->name }}</strong>?

            </div>

            <div class="modal-footer border-0">

                <button type="button"
                    class="btn btn-outline-secondary rounded-pill px-4"
                    data-bs-dismiss="modal">

                    Annulla

                </button>

                <form action="{{ route('admin.teams.destroy', $team) }}"
                    method="POST">

                    @csrf
                    @method('DELETE')

                    <button class="btn btn-danger rounded-pill px-4">

                        Elimina

                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

@endforeach

@endsection

@push('scripts')

<script>
    document.addEventListener('DOMContentLoaded', function() {

        const buttons = document.querySelectorAll('.edit-team-btn');

        buttons.forEach(button => {

            button.addEventListener('click', function() {

                const name = this.dataset.name;
                const color = this.dataset.color;
                const url = this.dataset.url;

                document.getElementById('editTeamName').value = name;
                document.getElementById('editTeamColor').value = color;
                document.getElementById('editTeamForm').action = url;

            });

        });

    });
</script>

@endpush