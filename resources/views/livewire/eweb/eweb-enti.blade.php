<div>
    @if (session()->has('success'))
        <div class="p-2 bg-success rounded mb-2">
            {{ session('success') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="p-2 bg-danger text-white rounded mb-2">
            {{ session('error') }}
        </div>
    @endif


    @if ($password == null)
        <div class="mt-3">
            <label class="block mb-1 font-bold" for="password">Password:</label>
            <input type="password" wire:model="password" class="border rounded px-1" style="width: 100%;">
            <button wire:click="accesso" class="bg-primary text-white px-3 py-1 rounded mt-2">🔓 Accedi</button>
        </div>
    @else

        <div class="mb-3">
            <label class="block mb-1 font-bold" for="enteSelezionato">Seleziona Ente:</label>
            <select wire:model.live="enteSelezionato" class="border rounded px-2 py-1" style="width: 100%;">
                <option value="">-- Seleziona un ente --</option>
                @foreach ($enti as $ente)
                    <option value="{{ $ente }}">{{ $ente }}</option>
                @endforeach
            </select>
        </div>

        @if ($enteSelezionato && count($personaleSelezionato) > 0)
            @if($modalitaModifica && $personaInModifica)
                {{-- Form di modifica --}}
                <div class="card">
                    <div class="card-header">
                        <h4>
                            @if($modalitaAggiunta)
                                Aggiungi Nuova Persona
                            @else
                                Modifica Persona: {{ $personaInModifica['nome'] }} {{ $personaInModifica['cognome'] }}
                            @endif
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nome:</label>
                                <input type="text" wire:model="personaInModifica.nome" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Cognome:</label>
                                <input type="text" wire:model="personaInModifica.cognome" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Codice Fiscale:</label>
                                <input type="text" wire:model="personaInModifica.codice_fiscale" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Telefono:</label>
                                <input type="text" wire:model="personaInModifica.telefono" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email:</label>
                                <input type="email" wire:model="personaInModifica.email" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Data di Nascita:</label>
                                <input type="text" wire:model="personaInModifica.data_nascita" class="form-control" placeholder="dd/mm/yyyy">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Titolo:</label>
                                                                <select wire:model="personaInModifica.titolo" class="form-control">
                                    <option value="REO">REO</option>
                                    <option value="Direttore di progetto">Direttore di progetto</option>
                                    <option value="Tutor">Tutor</option>
                                    <option value="Personale amministrativo">Personale amministrativo</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Esterno:</label>
                                <select wire:model="personaInModifica.esterno" class="form-control">
                                    <option value="Y">Sì</option>
                                    <option value="N">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="mt-3">
                            <button wire:click="salvaModifiche" class="btn btn-success me-2">💾 Salva Modifiche</button>
                            <button wire:click="annullaModifica" class="btn btn-secondary">❌ Annulla</button>
                        </div>
                    </div>
                </div>
            @endif

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3>Personale di {{ $enteSelezionato }}</h3>
                {{-- <button wire:click="aggiungiPersona" class="btn btn-primary">➕ Aggiungi Persona</button> --}}
            </div>
            <div class="table-responsive">
                <table class="table table-striped align-middle mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th class="border px-2 py-1">ID</th>
                            <th class="border px-2 py-1">Nome</th>
                            <th class="border px-2 py-1">Cognome</th>
                            <th class="border px-2 py-1">Codice Fiscale</th>
                            <th class="border px-2 py-1">Telefono</th>
                            <th class="border px-2 py-1">Email</th>
                            <th class="border px-2 py-1">Data di Nascita</th>
                            <th class="border px-2 py-1">Titolo</th>
                            <th class="border px-2 py-1">Esterno</th>
                            <th class="border px-2 py-1">Azione</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($personaleSelezionato as $persona)
                            <tr>
                                <td class="border px-2 py-1">{{ $persona['id'] }}</td>
                                <td class="border px-2 py-1">{{ $persona['nome'] }}</td>
                                <td class="border px-2 py-1">{{ $persona['cognome'] }}</td>
                                <td class="border px-2 py-1">{{ $persona['codice_fiscale'] }}</td>
                                <td class="border px-2 py-1">{{ $persona['telefono'] }}</td>
                                <td class="border px-2 py-1">{{ $persona['email'] }}</td>
                                <td class="border px-2 py-1">{{ $persona['data_nascita'] }}</td>
                                <td class="border px-2 py-1">{{ $persona['titolo'] }}</td>
                                <td class="border px-2 py-1">
                                    @if($persona['esterno'] === 'Y')
                                        <span class="badge bg-success">Sì</span>
                                    @else
                                        <span class="badge bg-secondary">No</span>
                                    @endif
                                </td>
                                <td class="border px-2 py-1">
                                    <button wire:click="editPersona({{ $persona['id'] }})" class="btn btn-warning btn-sm">Modifica</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @elseif ($enteSelezionato && count($personaleSelezionato) === 0)
            <div class="alert alert-warning">
                Nessun personale trovato per l'ente selezionato.
            </div>
        @endif
    @endif
</div>
