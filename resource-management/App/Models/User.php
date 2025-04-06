<?php

namespace App\Models;

use Core\Model;
use Core\Database;

class User extends Model {
    protected static $table = 'utilisateurs';

    public static function getAll() {
        $db = Database::getInstance();
        return $db->fetchAll("SELECT * FROM utilisateurs");
    }

    public static function getById($id) {
        $db = Database::getInstance();
        return $db->fetch("SELECT * FROM utilisateurs WHERE id_utilisateur = ?", [$id]);
    }

    public static function add($data) {
        $db = Database::getInstance();
        $query = "INSERT INTO utilisateurs (nom_complet, email, mot_de_passe, role) VALUES (?, ?, ?, ?)";
        $params = [
            $data['nom_complet'],
            $data['email'],
            $data['mot_de_passe'],
            $data['role']
        ];
        return $db->query($query, $params);
    }

    public static function update($id, $data) {
        $db = Database::getInstance();
        $query = "UPDATE utilisateurs SET nom_complet = ?, email = ?, mot_de_passe = ?, role = ? WHERE id_utilisateur = ?";
        $params = [
            $data['nom_complet'],
            $data['email'],
            $data['mot_de_passe'],
            $data['role'],
            $id
        ];
        return $db->query($query, $params);
    }

    public static function delete($id) {
        $db = Database::getInstance();
        return $db->query("DELETE FROM utilisateurs WHERE id_utilisateur = ?", [$id]);
    }

     /**
     * Récupérer un utilisateur par email
     */
    public static function getByEmail($email) {
      $db = Database::getInstance();
      return $db->fetch("SELECT * FROM utilisateurs WHERE email = ?", [$email]);
  }

    public static function isTechnicien($id) {
      $user = self::getById($id);
      return $user && $user['role'] === 'technicien';
  }

  public static function updatePassword($id, $newPassword) {
    $db = Database::getInstance();
    $db->query("UPDATE utilisateurs SET mot_de_passe = ?, date_modification = NOW() WHERE id = ?", 
              [password_hash($newPassword, PASSWORD_DEFAULT), $id]);

  }

}
