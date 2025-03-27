<?php 
namespace App\Models;

use Core\Model;
use Core\Database;

class Tuteur extends Model {
    protected static $table = 'tuteurs';

    /**
     * Récupérer un tuteur par ID utilisateur
     */
    public static function getByUserId($userId) {
        $db = Database::getInstance();
        return $db->fetch("SELECT * FROM tuteurs WHERE utilisateur_id = ?", [$userId]);
    }

    /**
     * Ajouter un tuteur
     */
    public static function add($data) {
        $db = Database::getInstance();
        $query = "INSERT INTO tuteurs (utilisateur_id, departement, poste, experience) VALUES (?, ?, ?, ?)";
        $params = [
            $data['utilisateur_id'],
            $data['departement'],
            $data['poste'],
            $data['experience']
        ];
        return $db->query($query, $params);
    }



    public static function update($userId, $data) {
        $db = Database::getInstance();
        $query = "UPDATE tuteurs SET departement = ?, poste = ?, experience = ? WHERE utilisateur_id = ?";
        $params = [
            $data['departement'],
            $data['poste'],
            $data['experience'],
            $userId
        ];
        return $db->query($query, $params);
    }

    // Supprimer un tuteur
    public static function deleteByUserId($userId) {
        $db = Database::getInstance();
        return $db->query("DELETE FROM tuteurs WHERE utilisateur_id = ?", [$userId]);
    }


    public static function assignToStagiaire($stagiaireId, $tuteurIds) {
        $db = Database::getInstance();
        foreach ($tuteurIds as $tuteurId) {
            $query = "INSERT INTO stagiaires_tuteurs (stagiaire_id, tuteur_id) VALUES (?, ?)";
            $params = [$stagiaireId, $tuteurId];
            $db->query($query, $params);
        }
    }

    // Obtenir tous les tuteurs
    public static function getAll() {
        $db = Database::getInstance();
        $sql = "SELECT u.id, u.nom, u.prenom, u.email, t.departement, t.poste, t.experience
                FROM utilisateurs u
                JOIN tuteurs t ON u.id = t.utilisateur_id
                WHERE u.role = 'tuteur'";
        return $db->fetchAll($sql);
    }
    public static function getById($tuteurId) 
    {
      $db = Database::getInstance();
      $sql = "SELECT utilisateurs.* , tuteurs.* 
                FROM utilisateurs 
                JOIN tuteurs 
                ON utilisateurs.id = tuteurs.utilisateur_id 
                WHERE tuteurs.id = ?";
      return $db->fetchAll($sql,[$tuteurId]);
  }
    
    public static function getByStagiaire($stagiaireId) 
    {
      $db = Database::getInstance();
      $sql = "SELECT utilisateurs.*, tuteurs.* 
        FROM utilisateurs 
        JOIN tuteurs ON utilisateurs.id = tuteurs.utilisateur_id 
        JOIN affectations ON tuteurs.id = affectations.tuteur_id 
        WHERE affectations.stagiaire_id = ?";
      
      return $db->fetchAll($sql,[$stagiaireId]);
  }
}
