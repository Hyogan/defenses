<?php
namespace App\Models;
use Core\Model;
use Core\Database;
class Log extends Model
{
   /**
     * Récupérer tous les logs
     */
    public static function getAll($limit = null, $offset = null)
    {
        $db = Database::getInstance();
        $sql = "SELECT l.*, u.email AS user_email FROM logs l LEFT JOIN utilisateurs u ON l.id_utilisateur = u.id ORDER BY l.date DESC";
        $params = [];
        if ($limit !== null) {
            $sql .= " LIMIT ?";
            $params[] = (int)$limit;
            if ($offset !== null) {
                $sql .= " OFFSET ?";
                $params[] = (int)$offset;
            }
        }
        return $db->fetchAll($sql, $params);
    }

    /**
     * Récupérer un log par ID
     */
    public static function getById($id) 
    {
        $db = Database::getInstance();
        $log = $db->fetch("SELECT * FROM logs WHERE id = ?", [$id]);
        return $log;
    }
    public static function search($criteria) 
    {
        $db = Database::getInstance();
        $query = "SELECT * FROM lignes WHERE 1=1";

        $params = [];

        if (!empty($criteria['type_ligne'])) {
            $query .= " AND type_ligne LIKE ?";
            $params[] = "%" . $criteria['type_ligne'] . "%";
        }

        if (!empty($criteria['numero_ligne'])) {
            $query .= " AND numero_ligne LIKE ?";
            $params[] = "%" . $criteria['numero_ligne'] . "%";
        }

        if (!empty($criteria['marque_poste'])) {
            $query .= " AND marque_poste LIKE ?";
            $params[] = "%" . $criteria['marque_poste'] . "%";
        }

        if (!empty($criteria['nom_proprietaire'])) {
            $query .= " AND nom_proprietaire LIKE ?";
            $params[] = "%" . $criteria['nom_proprietaire'] . "%";
        }

        return $db->fetchAll($query, $params);
    }

    /**
     * Récupérer tous les logs d'un utilisateur
     */
    public static function getByUserId($userId)
    {
        $db = Database::getInstance();
        return $db->fetchAll("SELECT * FROM logs WHERE id_utilisateur = ? ORDER BY date DESC", [$userId]);
    }

    /**
     * Ajouter un nouveau log
     */
    public static function create($data) {
        $db = Database::getInstance();
        $query = "INSERT INTO logs (id_utilisateur, action, message, date) 
                  VALUES (?, ?, ?, NOW())";
        $params = [
            $data['userId'],
            $data['action'],
            $data['message']
        ];
        $db->query($query, $params);
        return $db->getConnection()->lastInsertId();  // Return the inserted log ID
    }

    /**
     * Récupérer les logs d'un utilisateur dans une période spécifique
     */
    public static function getLogsInRange($userId, $startDate, $endDate) 
    {
        $db = Database::getInstance();
        return $db->fetchAll(
            "SELECT * FROM logs WHERE id_utilisateur = ? AND date BETWEEN ? AND ? ORDER BY date DESC", 
            [$userId, $startDate, $endDate]
        );
    }

    /**
     * Supprimer un log
     */
    public static function delete($id) {
        $db = Database::getInstance();  
        return $db->query("DELETE FROM logs WHERE id = ?", [$id]);
    }
}
