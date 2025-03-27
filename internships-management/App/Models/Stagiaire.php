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
  public static function getById($stagiaireId)
   {
      $sql = "SELECT stagiaires.*, utilisateurs.* 
              FROM stagiaires 
              JOIN utilisateurs ON stagiaires.utilisateur_id = utilisateurs.id 
              WHERE stagiaires.id = ?";
      $db = Database::getInstance();
      return $db->fetchAll($sql);
  }
}
