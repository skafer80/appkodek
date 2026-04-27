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

    <input type="text" name="email" id="email" placeholder="Email" wire:model="email">
    <button wire:click="verifyEmail">Verifica</button>

    @if($showRegistrati)
        <p>Associa i tuoi dati!</p>
        <input type="text" name="surname" id="surname" placeholder="Cognome" wire:model="surname">
        <input type="text" name="name" id="name" placeholder="Nome" wire:model="name">
        <button wire:click="register">Registrati</button>
    @endif

    @if($showHome)
        <p>Benvenuto {{ $name }} {{ $surname }}!</p>
        <p>Puoi accedere alla Home del Simulatore cliccando il link qui sotto:</p>
        <button wire:click="NewPlayer">Crea Nuovo Allenamento</button>
    @endif

</div>
