<?php
namespace App\Models;

use Exception;
use Core\Model;
use Core\Database;
use App\Models\Log;  // Include the Log model

class User extends Model {
    protected static $table = 'utilisateurs';

    /**
     * Récupérer tous les utilisateurs
     */
    public static function getAll() 
    {
        $db = Database::getInstance();
        return $db->fetchAll("SELECT * FROM utilisateurs ORDER BY nom, prenom ASC");
    }

    public static function getWithLogs($userId)
    {
      $sql = "SELECT 
          u.*,
          l.date AS log_date,
          l.action AS log_action,
          l.message AS log_message
      FROM 
          utilisateurs u
      LEFT JOIN 
          logs l ON u.id = l.id_utilisateur
      WHERE 
          u.id = ?"; 
          $db = Database::getInstance();
          $user = $db->fetch($sql,[$userId]);
      return $user;
    }

    /**
     * Récupérer un utilisateur par ID
     */
    public static function getById($id) 
    {
        $db = Database::getInstance();
        $user = $db->fetch("SELECT * FROM utilisateurs WHERE id = ?", [$id]);
        return $user;
    }

    /**
     * Ajouter un nouvel utilisateur
     */
    public static function create($data, $role = 'classic') {
        $db = Database::getInstance();
        $query = "INSERT INTO utilisateurs (nom, prenom, email, mot_de_passe, role, statut, date_creation) 
                   VALUES (?, ?, ?, ?, ?, ?, NOW())";
        $params = [
            $data['nom'],
            $data['prenom'],
            $data['email'],
            password_hash($data['mot_de_passe'], PASSWORD_DEFAULT),
            $data['role'] ?? $role,
            $data['statut'] ?? 'actif'
        ];      
        $db->query($query, $params);
        $userId = $db->getConnection()->lastInsertId();

        // Log the user creation action
        Log::create([
            'userId' => Auth::id(),  // Get the authenticated user's ID
            'action' => 'Création d\'utilisateur',
            'message' => 'Utilisateur créé avec l\'email : ' . $data['email']
        ]);

        return $userId;
    }

    /**
     * Récupérer un utilisateur par email
     */
    public static function getByEmail($email) {
        $db = Database::getInstance();
        return $db->fetch("SELECT * FROM utilisateurs WHERE email = ?", [$email]);
    }

    /**
     * Vérifier si un utilisateur est un tuteur
     */
    public static function isAdmin($id) {
        $user = self::getById($id);
        return $user && $user['role'] === 'admin';
    }

    /**
     * Authentifier un utilisateur
     */
    public static function authenticate($email, $password) {
        $user = self::getByEmail($email);
        if ($user && password_verify($password, $user['mot_de_passe'])) {
            // Log the authentication attempt (successful or failed)
            Log::create([
                'userId' => Auth::id(),  // Get the authenticated user's ID
                'action' => 'Authentification utilisateur',
                'message' => 'Tentative de connexion réussie pour l\'utilisateur : ' . $email
            ]);
            return $user;
        }

        // Log the failed authentication attempt
        Log::create([
            'userId' => null,  // Failed login attempt does not have an authenticated user ID
            'action' => 'Authentification utilisateur',
            'message' => 'Tentative de connexion échouée pour l\'email : ' . $email
        ]);

        return false;
    }

    /**
     * Changer le mot de passe d'un utilisateur
     */
    public static function updatePassword($id, $newPassword) {
        $db = Database::getInstance();
        $db->query("UPDATE utilisateurs SET mot_de_passe = ?, date_modification = NOW() WHERE id = ?", 
                   [password_hash($newPassword, PASSWORD_DEFAULT), $id]);

        // Log the password change action
        Log::create([
            'userId' => Auth::id(),  // Get the authenticated user's ID
            'action' => 'Changement de mot de passe',
            'message' => 'Mot de passe mis à jour pour l\'utilisateur avec l\'ID : ' . $id
        ]);
    }

    /**
     * Mettre à jour les informations de l'utilisateur
     */
    public static function update($id, $data) {
        $db = Database::getInstance();
        
        // Mettre à jour les informations de base de l'utilisateur
        $query = "UPDATE utilisateurs 
                   SET nom = ?, prenom = ?, email = ?, role = ?, mot_de_passe = ?, statut = ?, date_modification = NOW() 
                   WHERE id = ?";
        
        $params = [
            $data['nom'],
            $data['prenom'],
            $data['email'],
            $data['role'],
            password_hash($data['mot_de_passe'], PASSWORD_DEFAULT),
            $data['statut'] ?? 'actif',
            $id
        ];
        $queryResult =  $db->query($query, $params);

        // Log the user update action
        Log::create([
            'userId' => Auth::id(),  // Get the authenticated user's ID
            'action' => 'Mise à jour d\'utilisateur',
            'message' => 'Informations de l\'utilisateur avec l\'ID : ' . $id . ' mises à jour.'
        ]);
        return $queryResult;
    }

    /**
     * Supprimer un utilisateur
     */
    public static function delete($id) {
        $db = Database::getInstance();
        
        // Get the user data for logging purposes before deletion
        $user = self::getById($id);
        if (!$user) {
            return false;  // User not found
        }

        // Delete the user
        $db->query("DELETE FROM utilisateurs WHERE id = ?", [$id]);

        // Log the user deletion action
        Log::create([
            'userId' => Auth::id(),  // Get the authenticated user's ID
            'action' => 'Suppression d\'utilisateur',
            'message' => 'Utilisateur avec l\'email ' . $user['email'] . ' supprimé.'
        ]);
    }
}
