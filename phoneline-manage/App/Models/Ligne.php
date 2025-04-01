<?php
namespace App\Models;

use Core\Model;
use Core\Database;

class Ligne extends Model {
    protected static $table = 'lignes';

    public static function getAll() {
        $db = Database::getInstance();
        return $db->fetchAll("SELECT * FROM lignes");
    }

    public static function getById($id) {
        $db = Database::getInstance();
        return $db->fetch("SELECT * FROM lignes WHERE id = ?", [$id]);
    }

    public static function create($data) {
        $db = Database::getInstance();
        $query = "INSERT INTO lignes (type_ligne, numero_ligne, marque_poste, nom_proprietaire, numero_port, numero_bandeau, numero_fusible, numero_jarretiere) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $params = [
            $data['type_ligne'],
            $data['numero_ligne'],
            $data['marque_poste'],
            $data['nom_proprietaire'],
            $data['numero_port'],
            $data['numero_bandeau'],
            $data['numero_fusible'],
            $data['numero_jarretiere']
        ];
        $db->query($query, $params);
        Log::create([
          'userId' => Auth::id(),  // Get the authenticated user's ID
          'action' => 'Creation d\'une ligne ',
          'message' => 'creation d\'une nouvelle ligne avec: numero_ligne: ' . $data['numero_ligne']
      ]);
      return $db->getConnection()->lastInsertId();
    }

    public static function update($id, $data) {
        $db = Database::getInstance();
        $query = "UPDATE lignes SET type_ligne = ?, numero_ligne = ?, marque_poste = ?, nom_proprietaire = ?, numero_port = ?, numero_bandeau = ?, numero_fusible = ?, numero_jarretiere = ? WHERE id = ?";
        $params = [
            $data['type_ligne'],
            $data['numero_ligne'],
            $data['marque_poste'],
            $data['nom_proprietaire'],
            $data['numero_port'],
            $data['numero_bandeau'],
            $data['numero_fusible'],
            $data['numero_jarretiere'],
            $id
        ];
        $db->query($query, $params);
        Log::create([
          'userId' => Auth::id(),  // Get the authenticated user's ID
          'action' => 'Mise a jour de ligne',
          'message' => 'Mise a jour de la ligne : ' . $id
      ]);
  }

    public static function delete($id) {
        $db = Database::getInstance();
        $ligne = self::getById($id);
        if (!$ligne) {
            return false;  // Ligne not found
        }
        $db->query("DELETE FROM lignes WHERE id = ?", [$id]);
        Log::create([
          'userId' => Auth::id(),  // Get the authenticated user's ID
          'action' => 'Suppression ligne ',
          'message' => 'Suppression de la ligne avec pour numero : ' . $ligne['numero_ligne']
      ]);
    }

    public static function search($criteria) {
      $db = Database::getInstance();
      $query = "SELECT * FROM lignes WHERE 1=1";  // Start with a basic query

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
}
