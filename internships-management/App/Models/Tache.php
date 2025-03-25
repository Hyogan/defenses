<?php
namespace App\Models;

use Core\Model;
use Core\Database;

class Tache extends Model {
    protected static $table = 'taches';

    public $id;
    public $titre;
    public $description;
    public $stagiaire_id;
    public $tuteur_id;
    public $statut;
    public $date_echeance;
    public $pourcentage;

    public function __construct($data = []) {
        parent::__construct();
        if (!empty($data)) {
            $this->titre = $data['titre'] ?? '';
            $this->description = $data['description'] ?? '';
            $this->stagiaire_id = $data['stagiaire_id'] ?? 0;
            $this->tuteur_id = $data['tuteur_id'] ?? 0;
            $this->statut = $data['statut'] ?? 'En cours';
            $this->date_echeance = $data['date_echeance'] ?? null;
            $this->pourcentage = $data['pourcentage'] ?? 0;
        }
    }


    // public static function assignTaskToStagiaire($stagiaireId, $taskData) {
    //     // Créer une tâche pour un stagiaire
    //     Task::add([
    //         'stagiaire_id' => $stagiaireId,
    //         'description' => $taskData['description'],
    //         'deadline' => $taskData['deadline'],
    //         'status' => 'en cours',
    //         'tuteur_id' => $taskData['tuteur_id']
    //     ]);
    // }
    

    /**
     * Mettre à jour le pourcentage et enregistrer l'historique
     */
    public function updatePourcentage($nouveauPourcentage) {
        $ancienPourcentage = $this->pourcentage;
        if ($nouveauPourcentage !== $ancienPourcentage) {
            // Mettre à jour la tâche
            self::update($this->id, ['pourcentage' => $nouveauPourcentage]);

            // Insérer dans l'historique
            HistoriqueProgression::create([
                'tache_id' => $this->id,
                'stagiaire_id' => $this->stagiaire_id,
                'ancien_pourcentage' => $ancienPourcentage,
                'nouveau_pourcentage' => $nouveauPourcentage
            ]);
        }
    }

    // Assigner une tâche à un stagiaire
    public static function assignTaskToStagiaire($stagiaireId, $data) {
        $db = Database::getInstance();
        $query = "INSERT INTO taches (stagiaire_id, titre, description, date_limite, statut) 
                  VALUES (?, ?, ?, ?, ?)";
        $params = [
            $stagiaireId,
            $data['titre'],
            $data['description'],
            $data['date_limite'],
            'en cours' // Statut initial
        ];
        return $db->query($query, $params);
    }

    // Mettre à jour le statut d'une tâche
    public static function updateTaskStatus($taskId, $status) {
        $db = Database::getInstance();
        $query = "UPDATE taches SET statut = ? WHERE id = ?";
        $params = [$status, $taskId];
        return $db->query($query, $params);
    }

    // Obtenir une tâche par ID
    public static function getById($id) {
        $db = Database::getInstance();
        return $db->fetch("SELECT * FROM taches WHERE id = ?", [$id]);
    }

    // Obtenir les tâches d'un stagiaire
    public static function getByStagiaire($stagiaireId) {
        $db = Database::getInstance();
        return $db->fetchAll("SELECT * FROM taches WHERE stagiaire_id = ?", [$stagiaireId]);
    }
}
