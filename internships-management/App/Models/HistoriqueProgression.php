<?php
namespace App\Models;

use Core\Model;

class HistoriqueProgression extends Model {
    protected static $table = 'historique_progression';

    public $id;
    public $tache_id;
    public $stagiaire_id;
    public $ancien_pourcentage;
    public $nouveau_pourcentage;
    public $date_modification;

    public function __construct($data = []) {
        parent::__construct();
        if (!empty($data)) {
            $this->tache_id = $data['tache_id'] ?? 0;
            $this->stagiaire_id = $data['stagiaire_id'] ?? 0;
            $this->ancien_pourcentage = $data['ancien_pourcentage'] ?? 0;
            $this->nouveau_pourcentage = $data['nouveau_pourcentage'] ?? 0;
            $this->date_modification = date('Y-m-d H:i:s');
        }
    }
}
