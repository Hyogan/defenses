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

    public static function getByTuteur($tuteurId) 
    {
      $db = Database::getInstance();
      $sql  = "SELECT t.* 
              FROM taches t WHERE t.tuteur_id = ?";
        return $db->fetchAll($sql,[$tuteurId]);
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
        $query = "INSERT INTO taches (
                  stagiaire_id,
                  tuteur_id, 
                  titre, 
                  description, 
                  date_limite, 
                  statut,
                  ancien_pourcentage,
                  nouveau_pourcentage
                  ) 
                  VALUES (?, ?, ?,?, ?, ?,?,?)";
        $params = [
            $stagiaireId,
            $data['tuteur_id'],
            $data['titre'],
            $data['description'],
            $data['date_limite'],
            'en attente',
            0,0

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
    public static function getByStagiaire($stagiaireId)
    {
        $db = Database::getInstance();
        return $db->fetchAll("SELECT * FROM taches WHERE stagiaire_id = ?", [$stagiaireId]);
    }

    public static function getAllTask($limit = null)
    {
        $db = Database::getInstance();
        $sql = "SELECT * FROM taches" ;
        if($limit != null) {
          $sql.= " LIMIT ?";
          return $db->fetchAll($sql, [$limit]);
        }
        return $db->fetchAll(sql: $sql);
    }

    public static function getAllWithDetails()
    {
          $db = Database::getInstance();
          $sql = "SELECT 
                      t.*,
                      u_stagiaire.nom AS stagiaire_nom,
                      u_stagiaire.prenom AS stagiaire_prenom,
                      u_tuteur.nom AS tuteur_nom,
                      u_tuteur.prenom AS tuteur_prenom,
                      u_stagiaire.email AS stagiaire_email,
                      u_tuteur.email AS tuteur_email
                  FROM 
                      taches t
                  JOIN 
                      stagiaires st ON t.stagiaire_id = st.id
                  JOIN 
                      utilisateurs u_stagiaire ON st.utilisateur_id = u_stagiaire.id
                  JOIN 
                      tuteurs tu ON t.tuteur_id = tu.id
                  JOIN 
                      utilisateurs u_tuteur ON tu.utilisateur_id = u_tuteur.id";
  
          return $db->fetchAll($sql);
      
    }

    public static function getLateUnfinished()
    {
      $sql = "SELECT * FROM taches WHERE date_limite < NOW() AND statut != 'terminée'";
      $db = Database::getInstance();
      return $db->fetchAll($sql);
    }

}
