<?php
namespace App\Models;

use Core\Model;
use Core\Database;

class Evaluation extends Model {

    protected static $table = 'evaluations';

    // Ajouter une évaluation pour un stagiaire

    public static function add($data) {
        $stagiaireId = $data['stagiaire_id'];
        $tuteurId = $data['tuteur_id'];
        return self::addEvaluation($stagiaireId, $tuteurId, $data);
    }

    public static function addEvaluation($stagiaireId, $tuteurId, $data) {
        $db = Database::getInstance();
        $query = "INSERT INTO evaluations (stagiaire_id, tuteur_id, note, commentaires, date_evaluation) 
                  VALUES (?, ?, ?, ?, NOW())";
        $params = [
            $stagiaireId,
            $tuteurId,
            $data['note'],
            $data['commentaires']
        ];
        $db->query($query, $params);
        return $db->getConnection()->lastInsertId();
    }

    // Mettre à jour une évaluation
    public static function updateEvaluation($id, $data) {
        $db = Database::getInstance();
        $query = "UPDATE evaluations SET note = ?, commentaires = ? WHERE id = ?";
        $params = [
            $data['note'],
            $data['commentaires'],
            $id
        ];
        return $db->query($query, $params);
    }

    // Obtenir l'évaluation d'un stagiaire par un tuteur spécifique
    public static function getByStagiaireAndTuteur($stagiaireId, $tuteurId) {
        $db = Database::getInstance();
        return $db->fetch("SELECT * FROM evaluations WHERE stagiaire_id = ? AND tuteur_id = ?", [$stagiaireId, $tuteurId]);
    }

    // Obtenir toutes les évaluations d'un stagiaire
    public static function getByStagiaire($stagiaireId) {
        $db = Database::getInstance();
        return $db->fetchAll("SELECT * FROM evaluations WHERE stagiaire_id = ?", [$stagiaireId]);
    }

    // Obtenir toutes les évaluations d'un tuteur
    public static function getByTuteur($tuteurId) {
        $db = Database::getInstance();
        return $db->fetchAll("SELECT * FROM evaluations WHERE tuteur_id = ?", [$tuteurId]);
    }

    // Supprimer une évaluation
    public static function delete($id) {
        $db = Database::getInstance();
        return $db->query("DELETE FROM evaluations WHERE id = ?", [$id]);
    }

    public static function getById($id) {
        $db = Database::getInstance();
        return $db->fetchAll("SELECT * FROM evaluations WHERE id = ?", [$id]);
    }
}
