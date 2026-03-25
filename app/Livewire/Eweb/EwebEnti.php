<?php

namespace App\Livewire\Eweb;

use Livewire\Component;
use App\Models\Entity;
use Illuminate\Support\Facades\Log;

class EwebEnti extends Component
{
    public $password = null;
    public $enteSelezionato = '';
    public $enti = [];
    public $personaleSelezionato = [];
    public $filePath;

    // Proprietà per la modifica
    public $personaInModifica = null;
    public $modalitaModifica = false;
    public $modalitaAggiunta = false;

    public function mount()
    {
        $this->filePath = public_path('utility/enti.json');
        $this->caricaDati();
    }

    public function editPersona($id)
    {
        // Trova la persona con l'ID specificato
        $personaArray = collect($this->personaleSelezionato)->firstWhere('id', $id);

        if ($personaArray) {
            // Imposta la persona in modalità modifica
            $this->personaInModifica = $personaArray;
            $this->modalitaModifica = true;
            $this->modalitaAggiunta = false;

            Log::info('Avvio modifica persona: ', $this->personaInModifica);
            session()->flash('info', 'Modalità modifica attivata per: ' . $this->personaInModifica['nome'] . ' ' . $this->personaInModifica['cognome']);
        } else {
            Log::warning('Persona con ID ' . $id . ' non trovata.');
            session()->flash('error', 'Persona con ID ' . $id . ' non trovata.');
        }
    }

    public function aggiungiPersona()
    {
        if (!$this->enteSelezionato) {
            session()->flash('error', 'Seleziona prima un ente.');
            return;
        }

        // Crea una nuova persona vuota con un ID temporaneo
        $nuovoId = $this->calcolaProximoId();

        $this->personaInModifica = [
            'id' => $nuovoId,
            'nome' => '',
            'cognome' => '',
            'codice_fiscale' => '',
            'telefono' => '',
            'email' => '',
            'data_nascita' => '',
            'titolo' => '',
            'esterno' => 'Y'
        ];

        $this->modalitaAggiunta = true;
        $this->modalitaModifica = true;

        session()->flash('info', 'Modalità aggiunta persona attivata.');
    }

    private function calcolaProximoId()
    {
        if (empty($this->personaleSelezionato)) {
            return 1;
        }

        $maxId = collect($this->personaleSelezionato)->max('id');
        return $maxId + 1;
    }

    public function salvaModifiche()
    {
        if (!$this->personaInModifica || !$this->modalitaModifica) {
            session()->flash('error', 'Nessuna persona in modifica.');
            return;
        }

        // Validazione di base
        if (empty($this->personaInModifica['nome']) || empty($this->personaInModifica['cognome'])) {
            session()->flash('error', 'Nome e cognome sono obbligatori.');
            return;
        }

        try {
            // Carica il file JSON
            if (file_exists($this->filePath)) {
                $contenuto = file_get_contents($this->filePath);
                $dati = json_decode($contenuto, true) ?? [];

                // Trova l'ente corretto
                foreach ($dati as &$ente) {
                    if ($ente['ente'] === $this->enteSelezionato) {
                        if ($this->modalitaAggiunta) {
                            // Aggiungi nuova persona
                            $ente['personale'][] = $this->personaInModifica;
                            $messaggio = 'Persona aggiunta con successo!';
                        } else {
                            // Modifica persona esistente
                            foreach ($ente['personale'] as &$persona) {
                                if ($persona['id'] == $this->personaInModifica['id']) {
                                    $persona = $this->personaInModifica;
                                    break;
                                }
                            }
                            $messaggio = 'Persona modificata con successo!';
                        }
                        break;
                    }
                }

                // Salva il file JSON aggiornato
                file_put_contents($this->filePath, json_encode($dati, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

                // Ricarica i dati locali
                $this->caricaPersonale();

                // Reset modalità modifica
                $this->personaInModifica = null;
                $this->modalitaModifica = false;
                $this->modalitaAggiunta = false;

                session()->flash('success', $messaggio);
                Log::info('Persona salvata con successo nel file JSON');

            } else {
                session()->flash('error', 'File JSON non trovato.');
            }

        } catch (\Exception $e) {
            Log::error('Errore durante il salvataggio: ' . $e->getMessage());
            session()->flash('error', 'Errore durante il salvataggio: ' . $e->getMessage());
        }
    }

    public function annullaModifica()
    {
        $this->personaInModifica = null;
        $this->modalitaModifica = false;
        $this->modalitaAggiunta = false;
        session()->flash('info', 'Modifica annullata.');
    }

    public function caricaDati()
    {
        if (file_exists($this->filePath)) {
            $contenuto = file_get_contents($this->filePath);
            $dati = json_decode($contenuto, true) ?? [];

            // Estrai la lista degli enti dal file JSON
            $this->enti = collect($dati)->pluck('ente')->unique()->values()->toArray();

            Log::info('Enti caricati: ', $this->enti);

            // Se c'è un ente selezionato, carica il suo personale
            if ($this->enteSelezionato) {
                $this->caricaPersonale();
            }
        } else {
            $this->enti = [];
            $this->personaleSelezionato = [];
            Log::error('File enti.json non trovato');
        }
    }

    public function updatedEnteSelezionato()
    {
        Log::info('Ente selezionato: ' . $this->enteSelezionato);
        $this->caricaPersonale();
    }

    public function caricaPersonale()
    {
        // Assicurati che filePath sia sempre impostato
        if (!$this->filePath) {
            $this->filePath = public_path('utility/enti.json');
        }

        if (!$this->enteSelezionato) {
            $this->personaleSelezionato = [];
            return;
        }

        if (file_exists($this->filePath)) {
            $contenuto = file_get_contents($this->filePath);
            $dati = json_decode($contenuto, true) ?? [];

            // Trova l'ente selezionato e carica il suo personale
            foreach ($dati as $ente) {
                if ($ente['ente'] === $this->enteSelezionato) {
                    $this->personaleSelezionato = $ente['personale'] ?? [];
                    break;
                }
            }
        }
    }

    public function accesso()
    {
        $passwordCorretta = 'roccalandia';
        if ($this->password === $passwordCorretta) {
            session()->flash('success', 'Accesso riuscito!');
            // Non ricariciamo i dati perché sono già stati caricati nel mount()
        } else {
            $this->password = null;
            session()->flash('error', 'Password errata. Riprova.');
        }
    }

    public function render()
    {
        return view('livewire.eweb.eweb-enti');
    }
}
