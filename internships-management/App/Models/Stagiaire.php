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

    public static function getAllStagiaires() {
        $db = Database::getInstance();
        return $db->fetchAll("SELECT * FROM stagiaires");
    }

    // Historique des tâches d'un stagiaire
    public static function getTaskHistory($stagiaireId) {
        $db = Database::getInstance();
        return $db->fetchAll("SELECT * FROM tasks WHERE stagiaire_id = ?", [$stagiaireId]);
    }

    public static function getById($stagiaireId){
            return null;
    }
}
