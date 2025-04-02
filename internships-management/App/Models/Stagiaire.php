<?php 
namespace App\Models;

use Core\Model;
use Core\Database;


class Stagiaire extends Model {
    protected static $table = 'stagiaires';

    /**
     * Récupérer un stagiaire par ID utilisateur
     */
    public static function getByUserId($userId) {
        $db = Database::getInstance();
        return $db->fetch("SELECT * FROM stagiaires WHERE utilisateur_id = ?", [$userId]);
    }

    // public static function getUser($internId)
    // {
    //   $db = Database::getInstance();
    //   return $db->fetch("SELECT * FROM utilisateurs WHERE id = ?",)
    // }
 
    /**
     * Ajouter un stagiaire
     */
    public static function add($data) {
        $db = Database::getInstance();
        $query = "INSERT INTO stagiaires (utilisateur_id, formation, date_debut, date_fin) VALUES (?, ?, ?, ?)";
        $params = [
            $data['utilisateur_id'],
            $data['formation'],
            $data['date_debut'],
            $data['date_fin']
        ];
        return $db->query($query, $params);
    }


    public static function update($userId, $data) {
        $db = Database::getInstance();
        $query = "UPDATE stagiaires SET formation = ?, date_debut = ?, date_fin = ? WHERE utilisateur_id = ?";
        $params = [
            $data['formation'],
            $data['date_debut'],
            $data['date_fin'],
            $userId
        ];
        return $db->query($query, $params);
    }

    // Supprimer un stagiaire
    public static function deleteByUserId($userId) {
        $db = Database::getInstance();
        return $db->query("DELETE FROM stagiaires WHERE utilisateur_id = ?", [$userId]);
    }

    public static function getAllStagiaires($limit = null)
    {
        $db = Database::getInstance();
        $sql = "SELECT s.*,u.role, u.nom, u.email, u.prenom
                FROM stagiaires s  
                JOIN utilisateurs u ON u.id = s.utilisateur_id" ;
        if($limit != null) {
          $sql.= " LIMIT ?";
          return $db->fetchAll($sql, [$limit]);
        }
        return $db->fetchAll(sql: $sql);
    }

    // Historique des tâches d'un stagiaire
    public static function getTaskHistory($stagiaireId) {
        $db = Database::getInstance();
        return $db->fetchAll("SELECT * FROM tasks WHERE stagiaire_id = ?", [$stagiaireId]);
    }

    public static function getByTuteurId($tuteurId) {
      $db = Database::getInstance();
      $sql = "SELECT stagiaires.*, utilisateurs.nom, utilisateurs.prenom, utilisateurs.email 
            FROM stagiaires JOIN utilisateurs 
            ON stagiaires.utilisateur_id = utilisateurs.id 
            JOIN affectations ON stagiaires.id = affectations.stagiaire_id 
            WHERE affectations.tuteur_id = ?";
      return $db->fetchAll($sql,[$tuteurId]);
      // $stmt->execute([$tuteurId]);
      // return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
  /**
   * Récupérer un stagiaire par ID
   */
  public static function getById($stagiaireId)
   {
      $sql = "SELECT 
              s.id, 
              s.utilisateur_id,
              s.date_debut,
              s.formation,
              s.date_fin,
              s.date_creation,
              u.nom,
              u.prenom,
              u.email,
              u.role,
              u.statut,
              u.date_modification
              FROM stagiaires s
              JOIN utilisateurs u ON s.utilisateur_id = u.id 
              WHERE s.id = ?";
      $db = Database::getInstance();
      return $db->fetchAll($sql, [$stagiaireId]);
  }

  public static function getAllWithDetails($stagiaireId)
  {
    $sql = "SELECT
    s.*,
    s.date_debut,
    s.date_fin,
    u.nom AS nom_stagiaire,
    u.prenom AS prenom_stagiaire,
    u.email AS email_stagiaire,
    t.id AS tuteur_id,
    t.departement AS departement_tuteur,
    t.poste AS poste_tuteur,
    t.experience AS experience_tuteur,
    ut.nom AS nom_tuteur,
    ut.prenom AS prenom_tuteur,
    ut.email AS email_tuteur,
    ta.*,
    d.*,
    e.*
FROM stagiaires s
JOIN utilisateurs u ON s.utilisateur_id = u.id
LEFT JOIN affectations a ON s.id = a.stagiaire_id
LEFT JOIN tuteurs t ON a.tuteur_id = t.id
LEFT JOIN utilisateurs ut ON t.utilisateur_id = ut.id
LEFT JOIN taches ta ON s.id = ta.stagiaire_id
LEFT JOIN documents d ON s.id = d.stagiaire_id
LEFT JOIN evaluations e ON s.id = e.stagiaire_id
WHERE s.id = ?";
$db = Database::getInstance();
$results = $db->fetchAll($sql, [$stagiaireId]);

if (empty($results)) {
    return null;
}

$stagiaire = $results[0]; // Informations de base du stagiaire

// Initialisation des tableaux pour les tâches, documents et évaluations
$stagiaire['taches'] = [];
$stagiaire['documents'] = [];
$stagiaire['evaluations'] = [];

foreach ($results as $row) {
    if ($row['titre']) { // Vérification pour les tâches
        $stagiaire['taches'][] = $row;
    }
    if ($row['nom_fichier']) { // Vérification pour les documents
        $stagiaire['documents'][] = $row;
    }
    if ($row['note']) { // Vérification pour les évaluations
        $stagiaire['evaluations'][] = $row;
    }
}

// Nettoyer les données redondantes de la première ligne
unset($stagiaire['id']);
unset($stagiaire['utilisateur_id']);
// unset($stagiaire['formation']);
// unset($stagiaire['date_debut']);
// unset($stagiaire['date_fin']);
unset($stagiaire['date_creation']);


    return $stagiaire;
  }
    
}
