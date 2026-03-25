<?php

namespace App\Livewire\Eweb;

use Livewire\Component;

class EwebConfig extends Component
{

    public $righe = [];
    public $password = null;
    private $filePath;

    public function mount()
    {
        $this->filePath = public_path('utility/e_web.json');

        if (file_exists($this->filePath)) {
            $contenuto = file_get_contents($this->filePath);
            $this->righe = json_decode($contenuto, true) ?? [];
        } else {
            $this->righe = [];
        }
    }

    public function accesso()
    {
        $passwordCorretta = 'roccalandia';
        if ($this->password === $passwordCorretta) {
            session()->flash('success', 'Accesso riuscito!');
        } else {
            $this->password = null;
            session()->flash('error', 'Password errata. Riprova.');
        }
    }

    public function aggiungiRiga()
    {
        $this->righe[] = [
            "scheda" => "",
            "chiave" => "",
            "tipo" => 0,
            "valore" => "",
            "etichetta" => "",
            "nomeCampo" => "",
            "chiaveCheckbox" => null
        ];
    }

    public function rimuoviRiga($index)
    {
        unset($this->righe[$index]);
        $this->righe = array_values($this->righe);
    }

    public function aggiorna()
    {
        if (empty($this->filePath)) {
            $this->filePath = public_path('utility/e_web.json');
        }

        $directory = dirname($this->filePath);
        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        $result = file_put_contents($this->filePath, json_encode($this->righe, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        if ($result !== false) {
            session()->flash('success', 'Dati salvati correttamente su e_web.json!');
        } else {
            session()->flash('error', 'Errore durante il salvataggio del file!');
        }
    }

    public function render()
    {
        return view('livewire.eweb.eweb-config');
    }
}
