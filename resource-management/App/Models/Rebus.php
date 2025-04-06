<?php

namespace App\Models;
use Core\Model;
use Core\Database;

class Rebus extends Model {
    protected static $table = 'rebus';

    public static function getAll() {
        $db = Database::getInstance();
        return $db->fetchAll("SELECT * FROM rebus");
    }

    public static function getById($id) {
        $db = Database::getInstance();
        return $db->fetch("SELECT * FROM rebus WHERE id_rebus = ?", [$id]);
    }

    public static function add($data) {
        $db = Database::getInstance();
        $query = "INSERT INTO rebus (reference, id_materiel, panne, description_panne) VALUES (?, ?, ?, ?)";
        $params = [
            $data['reference'],
            $data['id_materiel'],
            $data['panne'],
            $data['description_panne']
        ];
        return $db->query($query, $params);
    }

    public static function update($id, $data) {
        $db = Database::getInstance();
        $query = "UPDATE rebus SET reference = ?, id_materiel = ?, panne = ?, description_panne = ? WHERE id_rebus = ?";
        $params = [
            $data['reference'],
            $data['id_materiel'],
            $data['panne'],
            $data['description_panne'],
            $id
        ];
        return $db->query($query, $params);
    }

    public static function delete($id) {
        $db = Database::getInstance();
        return $db->query("DELETE FROM rebus WHERE id_rebus = ?", [$id]);
    }
}
