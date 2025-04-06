<?php

namespace App\Models;

use Core\Model;
use Core\Database;

class Affectation extends Model {
    protected static $table = 'affectation';

    public static function getAll() {
        $db = Database::getInstance();
        return $db->fetchAll("SELECT * FROM affectation");
    }

    public static function getById($id) {
        $db = Database::getInstance();
        return $db->fetch("SELECT * FROM affectation WHERE id_affectation = ?", [$id]);
    }

    public static function add($data) {
        $db = Database::getInstance();
        $query = "INSERT INTO affectation (id_materiel, id_laboratoire, id_service, date_fin_affectation) VALUES (?, ?, ?, ?)";
        $params = [
            $data['id_materiel'],
            $data['id_laboratoire'],
            $data['id_service'],
            $data['date_fin_affectation']
        ];
        return $db->query($query, $params);
    }

    public static function update($id, $data) {
        $db = Database::getInstance();
        $query = "UPDATE affectation SET id_materiel = ?, id_laboratoire = ?, id_service = ?, date_fin_affectation = ? WHERE id_affectation = ?";
        $params = [
            $data['id_materiel'],
            $data['id_laboratoire'],
            $data['id_service'],
            $data['date_fin_affectation'],
            $id
        ];
        return $db->query($query, $params);
    }

    public static function delete($id) {
        $db = Database::getInstance();
        return $db->query("DELETE FROM affectation WHERE id_affectation = ?", [$id]);
    }
}
?>
