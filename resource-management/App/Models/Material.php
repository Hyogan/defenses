<?php

namespace App\Models;

use Core\Model;
use Core\Database;

class Material extends Model {
    protected static $table = 'materiels';

    public static function getAll() {
        $db = Database::getInstance();
        $sql = "SELECT m.*, c.nom as nom_categorie FROM materiels as m JOIN categories as c ON c.id_categorie = m.id_categorie";
        return $db->fetchAll($sql);
    }

    public static function getById($id) {
        $db = Database::getInstance();
        return $db->fetch("SELECT * FROM materiels WHERE id_materiel = ?", [$id]);
    }

    public static function add($data) {
        $db = Database::getInstance();
        $query = "INSERT INTO materiels (nom, description, model, id_categorie) VALUES (?, ?, ?, ?)";
        $params = [
            $data['nom'],
            $data['description'],
            $data['model'],
            $data['id_categorie']
        ];
        return $db->query($query, $params);
    }

    public static function update($id, $data) {
        $db = Database::getInstance();
        $query = "UPDATE materiels SET nom = ?, description = ?, model = ?, id_categorie = ? WHERE id_materiel = ?";
        $params = [
            $data['nom'],
            $data['description'],
            $data['model'],
            $data['id_categorie'],
            $id
        ];
        return $db->query($query, $params);
    }

    public static function delete($id) {
        $db = Database::getInstance();
        return $db->query("DELETE FROM materiels WHERE id_materiel = ?", [$id]);
    }
}
?>
