<?php
namespace App\Models;

use Core\Model;

class Affectation extends Model {
    protected static $table = 'affectations';

    public $id;
    public $tuteur_id;
    public $stagiaire_id;
    public $date_affectation;

    public function __construct($data = []) {
        parent::__construct();
        if (!empty($data)) {
            $this->tuteur_id = $data['tuteur_id'] ?? 0;
            $this->stagiaire_id = $data['stagiaire_id'] ?? 0;
            $this->date_affectation = date('Y-m-d H:i:s');
        }
    }
}
