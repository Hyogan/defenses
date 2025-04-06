<?php

namespace App\Models;

use Core\Model;
use Core\Database;
class Laboratory extends Model {
    protected static $table = 'laboratoires';

    public static function getAll() {
        $db = Database::getInstance();
        return $db->fetchAll("SELECT * FROM laboratoires");
    }

    public static function getById($id) {
        $db = Database::getInstance();
        return $db->fetch("SELECT * FROM laboratoires WHERE id_laboratoire = ?", [$id]);
    }

    public static function add($data) {
        $db = Database::getInstance();
        $query = "INSERT INTO laboratoires (nom, numero, localisation, description) VALUES (?, ?, ?, ?)";
        $params = [
            $data['nom'],
            $data['numero'],
            $data['localisation'],
            $data['description']
        ];
        return $db->query($query, $params);
    }

    public static function update($id, $data) {
        $db = Database::getInstance();
        $query = "UPDATE laboratoires SET nom = ?, numero = ?, localisation = ?, description = ? WHERE id_laboratoire = ?";
        $params = [
            $data['nom'],
            $data['numero'],
            $data['localisation'],
            $data['description'],
            $id
        ];
        return $db->query($query, $params);
    }

    public static function delete($id) {
        $db = Database::getInstance();
        return $db->query("DELETE FROM laboratoires WHERE id_laboratoire = ?", [$id]);
    }
}
?>
