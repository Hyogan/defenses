<?php
namespace App\Models;

use Core\Model;
use Core\Database;

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

    /**
     * Récupère toutes les affectations pour un stagiaire
     */
    public static function getByStagiaire($stagiaireId) {
        $db = Database::getInstance();
        return $db->fetchAll(
            "SELECT * FROM " . static::$table . " WHERE stagiaire_id = ?", 
            [$stagiaireId]
        );
    }
    public static function getByStagiareAndTuteur($stagiaireId, $tuteurId)
    {
      $db = Database::getInstance();
      return $db->fetchAll(
          "SELECT * FROM " . static::$table . " WHERE stagiaire_id = ? AND tuteur_id = ?", 
          [$stagiaireId, $tuteurId]
      );
    }
    
    /**
     * Récupère toutes les affectations pour un tuteur
     */
    public static function getByTuteur($tuteurId) {
        $db = Database::getInstance();
        return $db->fetchAll(
            "SELECT * FROM " . static::$table . " WHERE tuteur_id = ?", 
            [$tuteurId]
        );
    }
    
    /**
     * Vérifie si une affectation existe
     */
    public static function exists($stagiaireId, $tuteurId) {
        $db = Database::getInstance();
        $result = $db->fetch(
            "SELECT id FROM " . static::$table . " WHERE stagiaire_id = ? AND tuteur_id = ?", 
            [$stagiaireId, $tuteurId]
        );
        return !empty($result);
    }
    
    /**
     * Crée une nouvelle affectation
     */
    public static function add($stagiaireId, $tuteurId)
     {
        $db = Database::getInstance();
        return $db->query(
            "INSERT INTO " . static::$table . " (stagiaire_id, tuteur_id, date_affectation) VALUES (?, ?, NOW())",
            [$stagiaireId, $tuteurId]
        );
    }
    
    /**
     * Supprime une affectation spécifique
     */
    public static function delete($id)
    {
        $db = Database::getInstance();
        return $db->query(
            "DELETE FROM " . static::$table . " WHERE id = ?",
            [$id]
        );
    }

    public static function getAllWithDetails($limit = null) {
      $db = Database::getInstance();
      $sql = "SELECT a.*, t.email as tuteur_email, s.email as stagiaire_email, s.nom AS stagiaire_nom, s.prenom AS stagiaire_prenom, t.nom AS tuteur_nom, t.prenom AS tuteur_prenom 
              FROM affectations a 
              JOIN stagiaires st ON a.stagiaire_id = st.id
              JOIN utilisateurs s ON st.utilisateur_id = s.id
              JOIN tuteurs tu ON a.tuteur_id = tu.id
              JOIN utilisateurs t ON tu.utilisateur_id = t.id";

      if ($limit !== null) {
          $sql .= " LIMIT ?";
          return $db->fetchAll($sql, [(int)$limit]);
      } else {
          return $db->fetchAll($sql);
      }
  }
    
    /**
     * Supprime toutes les affectations d'un stagiaire
     */
    public static function deleteByStagiaire($stagiaireId) {
        $db = Database::getInstance();
        return $db->query(
            "DELETE FROM " . static::$table . " WHERE stagiaire_id = ?",
            [$stagiaireId]
        );
    }
    
    /**
     * Supprime toutes les affectations d'un tuteur
     */
    public static function deleteByTuteur($tuteurId) {
        $db = Database::getInstance();
        return $db->query(
            "DELETE FROM " . static::$table . " WHERE tuteur_id = ?",
            [$tuteurId]
        );
    }
}
