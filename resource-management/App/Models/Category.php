<?php

namespace App\Models;

use Core\Model;
use Core\Database;

class Category extends Model {
    protected static $table = 'categories';

    public static function getAll() {
        $db = Database::getInstance();
        return $db->fetchAll("SELECT * FROM categories");
    }

    public static function getById($id) {
        $db = Database::getInstance();
        return $db->fetch("SELECT * FROM categories WHERE id_categorie = ?", [$id]);
    }

    public static function add($data) {
        $db = Database::getInstance();
        $query = "INSERT INTO categories (nom, description) VALUES (?, ?)";
        $params = [
            $data['nom'],
            $data['description']
        ];
        return $db->query($query, $params);
    }

    public static function update($id, $data) {
        $db = Database::getInstance();
        $query = "UPDATE categories SET nom = ?, description = ? WHERE id_categorie = ?";
        $params = [
            $data['nom'],
            $data['description'],
            $id
        ];
        return $db->query($query, $params);
    }

    public static function delete($id) {
        $db = Database::getInstance();
        return $db->query("DELETE FROM categories WHERE id_categorie = ?", [$id]);
    }
}
?>
