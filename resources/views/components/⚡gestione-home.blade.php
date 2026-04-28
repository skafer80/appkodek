<?php

use Livewire\Component;
use App\Models\User;
use App\Models\SimulatorPlayer;

new class extends Component {

        public $surname;
        public $name;
        public $email;
        public bool $showHome = false;
        public bool $showRegistrati = false;

        public function verifyEmail()
        {
            $user = User::where('email', $this->email)->first();
            if ($user) {
                $this->surname = $user->surname;
                $this->name = $user->name;
                $this->showHome = true;
                $this->showRegistrati = false;
            } else {
                $this->showHome = false;
                $this->showRegistrati = true;
            }

        }

        public function register()
        {
            $this->validate([
                'surname' => 'required',
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
            ]);

            $user = User::create([
                'surname' => $this->surname,
                'name' => $this->name,
                'email' => $this->email,
                'password' => bcrypt('password'),
            ]);

            $this->showHome = true;
            $this->showRegistrati = false;
        }

        public function NewPlayer()
        {
            $user = User::where('email', $this->email)->first();

            $player = SimulatorPlayer::firstOrCreate(
                ['user_id' => $user->id],
                ['kind' => 'manuale']
            );

            if ($user) {
                return redirect()->route('simulatore.index', ['SimulatorPlayer' => $player->id]);
            }
        }

};
?>

<div>
    <style>
        .gh-card {
            width: min(560px, 100%);
            border-radius: 22px;
            border: 1px solid rgba(86, 66, 44, 0.12);
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.88), rgba(250, 245, 238, 0.88));
            box-shadow: 0 16px 34px rgba(73, 50, 29, 0.1);
            padding: 24px;
        }

        .gh-title {
            margin: 0 0 6px;
            font-size: 1.25rem;
            color: #2f241b;
        }

        .gh-copy {
            margin: 0 0 18px;
            color: #6c5a4a;
            line-height: 1.55;
            font-size: 0.95rem;
        }

        .gh-row {
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 10px;
            margin-bottom: 14px;
        }

        .gh-input {
            width: 100%;
            border: 1px solid rgba(86, 66, 44, 0.2);
            border-radius: 12px;
            padding: 11px 12px;
            background: #fff;
            color: #2f241b;
            outline: none;
            transition: border-color 140ms ease, box-shadow 140ms ease;
        }

        .gh-input:focus {
            border-color: rgba(184, 92, 56, 0.55);
            box-shadow: 0 0 0 3px rgba(184, 92, 56, 0.16);
        }

        .gh-actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-top: 10px;
        }

        .gh-btn {
            border: 0;
            border-radius: 12px;
            padding: 11px 16px;
            font-weight: 700;
            cursor: pointer;
            transition: transform 140ms ease, box-shadow 140ms ease, opacity 140ms ease;
        }

        .gh-btn:hover {
            transform: translateY(-1px);
        }

        .gh-btn-primary {
            color: #fff;
            background: linear-gradient(135deg, #b85c38, #8f4326);
            box-shadow: 0 10px 20px rgba(143, 67, 38, 0.26);
        }

        .gh-btn-soft {
            color: #8f4326;
            background: rgba(234, 216, 199, 0.72);
            border: 1px solid rgba(184, 92, 56, 0.24);
        }

        .gh-panel {
            margin-top: 14px;
            padding-top: 14px;
            border-top: 1px dashed rgba(86, 66, 44, 0.2);
        }

        .gh-success {
            margin: 0 0 12px;
            color: #2d5e35;
            background: rgba(129, 185, 140, 0.2);
            border: 1px solid rgba(74, 136, 88, 0.25);
            border-radius: 12px;
            padding: 10px 12px;
        }

        .gh-error {
            margin: 8px 0 0;
            color: #8f2c1d;
            font-size: 0.9rem;
        }

        .gh-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 12px;
            border-radius: 10px;
            text-decoration: none;
            color: #8f4326;
            background: rgba(234, 216, 199, 0.62);
            border: 1px solid rgba(184, 92, 56, 0.22);
            font-weight: 700;
            transition: background-color 140ms ease, transform 140ms ease;
        }

        .gh-link::after {
            content: "->";
            font-size: 0.9rem;
        }

        .gh-link:hover {
            background: rgba(234, 216, 199, 0.9);
            transform: translateY(-1px);
        }

        .gh-key {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 999px;
            background: rgba(184, 92, 56, 0.14);
            border: 1px solid rgba(184, 92, 56, 0.26);
            color: #8f4326;
            font-weight: 700;
        }

        @media (max-width: 560px) {
            .gh-row {
                grid-template-columns: 1fr;
            }

            .gh-btn {
                width: 100%;
            }
        }
    </style>

    <div class="gh-card">
        <h3 class="gh-title">Accesso rapido</h3>
        <p class="gh-copy">Inserisci la tua email per recuperare i dati o registrarti in pochi secondi.</p>

        <div class="gh-row">
            <input class="gh-input" type="email" name="email" id="email" placeholder="Email" wire:model="email" autocomplete="email">
            <button class="gh-btn gh-btn-primary" type="button" wire:click="verifyEmail">Verifica</button>
        </div>
        @error('email')
            <p class="gh-error">{{ $message }}</p>
        @enderror

        @if($showRegistrati)
            <div class="gh-panel">
                <p class="gh-copy" style="margin-bottom:12px;">Email non trovata. Completa i dati per registrarti.</p>
                <div class="gh-row" style="grid-template-columns:1fr 1fr;">
                    <input class="gh-input" type="text" name="surname" id="surname" placeholder="Cognome" wire:model="surname" autocomplete="family-name">
                    <input class="gh-input" type="text" name="name" id="name" placeholder="Nome" wire:model="name" autocomplete="given-name">
                </div>
                @error('surname')
                    <p class="gh-error">{{ $message }}</p>
                @enderror
                @error('name')
                    <p class="gh-error">{{ $message }}</p>
                @enderror
                <div class="gh-actions">
                    <button class="gh-btn gh-btn-soft" type="button" wire:click="register">Registrati</button>
                </div>
            </div>
        @endif

        @if($showHome)
            <div class="gh-panel">
                <p class="gh-success">Benvenuto {{ $name }} {{ $surname }}!</p>
                <p class="gh-copy">Puoi accedere alla Home del Simulatore cliccando il pulsante qui sotto.</p>
                <p class="gh-copy" style="margin-bottom:10px;">
                    Prima di iniziare, apri una pagina di esempio con i dati utili in una nuova finestra.<br>
                    Password: <span class="gh-key">prova</span> - Ente di test: <span class="gh-key">Brisket Ente</span>
                </p>
                <p class="gh-copy" style="margin-bottom:10px;">
                    <a class="gh-link" href="{{ route('provadati.dati') }}" target="_blank" rel="noopener noreferrer">Apri esempio dati</a>
                </p>
                <div class="gh-actions">
                    <button class="gh-btn gh-btn-primary" type="button" wire:click="NewPlayer">Crea Nuovo Allenamento</button>
                </div>
            </div>
        @endif
    </div>
</div>
