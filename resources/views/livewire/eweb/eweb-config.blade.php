<div>
    @if (session()->has('success'))
        <div class="p-2 bg-success rounded mb-2">
            {{ session('success') }}
        </div>
    @endif
@if ($password == null)
    <div class="mt-3">
        <label class="block mb-1 font-bold" for="filePath">Password:</label>
        <input type="password" wire:model="password" class="border rounded px-1" style="width: 100%;">
        <button wire:click="accesso" class="bg-primary text-white px-3 py-1 rounded mt-2">🔓 Accedi</button >
    </div>
@else
    <div class="table-responsive">
        <table class="table table-striped align-middle mb-0" style="table-layout: fixed;">
            <thead class="table-dark">
                <tr>
                    <th class="border px-2 py-1" style="width: 8%;">Scheda</th>
                    <th class="border px-2 py-1" style="width: 20%;">Chiave</th>
                    <th class="border px-2 py-1" style="width: 15%;">Tipo</th>
                    <th class="border px-2 py-1" style="width: 8%;">Colonna</th>
                    <th class="border px-2 py-1" style="width: 15%;">Etichetta</th>
                    <th class="border px-2 py-1" style="width: 15%;">Nome Campo</th>
                    <th class="border px-2 py-1" style="width: 10%;">Chiave Checkbox</th>
                    <th class="border px-2 py-1" style="width: 5%;">-</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($righe as $i => $riga)
                    <tr>
                        <td class="border px-2 py-1">
                            <input type="text" wire:model="righe.{{ $i }}.scheda"
                                class="border rounded px-1" style="width: 100%;">
                        </td>
                        <td class="border px-2 py-1">
                            <input type="text" wire:model="righe.{{ $i }}.chiave"
                                class="border rounded px-1" style="width: 100%;">
                        </td>
                        <td class="border px-2 py-1">
                            <select wire:model="righe.{{ $i }}.tipo" class="border rounded px-1"
                                style="width: 100%;">
                                <option value="0">Non Impostato</option>
                                <option value="1">Casella di Testo</option>
                                <option value="2">Radio</option>
                                <option value="3">Checkbox</option>
                                <option value="4">Casella combinata</option>
                            </select>
                        </td>
                        <td class="border px-2 py-1">
                            <input type="text" wire:model="righe.{{ $i }}.valore"
                                class="border rounded px-1" style="width: 100%;">
                        </td>
                        <td class="border px-2 py-1">
                            <input type="text" wire:model="righe.{{ $i }}.etichetta"
                                class="border rounded px-1" style="width: 100%;">
                        </td>
                        <td class="border px-2 py-1">
                            <input type="text" wire:model="righe.{{ $i }}.nomeCampo"
                                class="border rounded px-1" style="width: 100%;">
                        </td>
                        <td class="border px-2 py-1">
                            <input type="text" wire:model="righe.{{ $i }}.chiaveCheckbox"
                                class="border rounded px-1" style="width: 100%;">
                        </td>
                        <td class="border px-2 py-1 text-center">
                            <button wire:click="rimuoviRiga({{ $i }})"
                                class="bg-danger text-white px-2 py-1 rounded"
                                onclick="return confirm('Sei sicuro di voler rimuovere questa riga?');">🗑️</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-3 flex gap-2">
            <button wire:click="aggiungiRiga" class="bg-primary text-white px-3 py-1 rounded">+ Aggiungi riga</button>
            <button wire:click="aggiorna" class="bg-success text-white px-3 py-1 rounded">💾 Salva</button>
        </div>

        @if (session()->has('success'))
            <div class="p-2 bg-green-200 text-green-800 rounded mb-2">
                {{ session('success') }}
            </div>
        @endif
    @endif
    </div>
