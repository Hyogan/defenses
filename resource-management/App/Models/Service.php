<?php

namespace App\Models;

use Core\Model;
use Core\Database;

class Service extends Model {
    protected static $table = 'services';

    public static function getAll() {
        $db = Database::getInstance();
        return $db->fetchAll("SELECT * FROM services");
    }

    public static function getById($id) {
        $db = Database::getInstance();
        return $db->fetch("SELECT * FROM services WHERE id_service = ?", [$id]);
    }

  //   public static function getByUserId($userId) {
  //     $db = Database::getInstance();
  //     return $db->fetch("SELECT * FROM services WHERE id_service = ?", [$userId]);
  // }

    public static function add($data) {
        $db = Database::getInstance();
        $query = "INSERT INTO services (nom, localisation, description) VALUES (?, ?, ?)";
        $params = [
            $data['nom'],
            $data['localisation'],
            $data['description']
        ];
        return $db->query($query, $params);
    }

    public static function update($id, $data) {
        $db = Database::getInstance();
        $query = "UPDATE services SET nom = ?, localisation = ?, description = ? WHERE id_service = ?";
        $params = [
            $data['nom'],
            $data['localisation'],
            $data['description'],
            $id
        ];
        return $db->query($query, $params);
    }

    public static function delete($id) {
        $db = Database::getInstance();
        return $db->query("DELETE FROM services WHERE id_service = ?", [$id]);
    }
}
?>
