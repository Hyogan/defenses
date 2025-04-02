<?php 
namespace App\Models;

use Exception;
use Core\Model;
use Core\Database;
use App\Models\Stagiaire;
use App\Models\Tuteur;

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

    /**
     * Récupérer un utilisateur par ID
     */
    public static function getById($id) 
    {
        $db = Database::getInstance();
        $user = $db->fetch("SELECT * FROM utilisateurs WHERE id = ?", [$id]);
    
        if ($user) {
            // Charger les données spécifiques en fonction du rôle
            if ($user['role'] === 'stagiaire') {
                $user['stagiaire'] = Stagiaire::getByUserId($user['id']);
            } elseif ($user['role'] === 'tuteur') {
                $user['tuteur'] = Tuteur::getByUserId($user['id']);
            }
        }
    
        return $user;
    }
    

    /**
     * Ajouter un nouvel utilisateur
     */
    public static function create($data, $role = 'stagiaire') {
        $db = Database::getInstance();
        $query = "INSERT INTO utilisateurs (nom, prenom, email, mot_de_passe, role, statut, date_creation) 
                   VALUES (?, ?, ?, ?, ?, ?, NOW())";
        
        $params = [
            $data['nom'],
            $data['prenom'],
            $data['email'],
            password_hash($data['mot_de_passe'], PASSWORD_DEFAULT),
            $data['role'] ?? $role,
            $data['statut'] ?? 'active'
        ];
        
        $db->query($query, $params);
        $userId = $db->getConnection()->lastInsertId();

        // Ajouter des données spécifiques selon le rôle de l'utilisateur
        if ($data['role'] === 'stagiaire') {
            Stagiaire::add([
                'utilisateur_id' => $userId, 
                'formation' => $data['formation'], 
                'date_debut' => $data['date_debut'], 
                'date_fin' => $data['date_fin']
              ]);
        } elseif ($data['role'] === 'tuteur') {
            Tuteur::add([
              'utilisateur_id' => $userId, 
              'departement' => $data['departement'], 
              'poste' => $data['poste'], 
              'experience' => $data['experience']]
            );
        }

        return $userId;
    }

    /**
     * Récupérer un utilisateur par email
     */
    public static function getByEmail($email) {
        $db = Database::getInstance();
        return $db->fetch("SELECT * FROM utilisateurs WHERE email = ?", [$email]);
    }

    // Autres méthodes (update, delete, etc.)

    /**
     * Vérifier si un utilisateur est un stagiaire
     */
    public static function isStagiaire($id) {
        $user = self::getById($id);
        return $user && $user['role'] === 'stagiaire';
    }

    /**
     * Vérifier si un utilisateur est un tuteur
     */
    public static function isTuteur($id) {
        $user = self::getById($id);
        return $user && $user['role'] === 'tuteur';
    }

    /**
     * Authentifier un utilisateur
     */
    public static function authenticate($email, $password) {
        $user = self::getByEmail($email);
        if ($user && password_verify($password, $user['mot_de_passe'])) {
            return $user;
        }
        return false;
    }

    /**
     * Changer le mot de passe d'un utilisateur
     */
    public static function updatePassword($id, $newPassword) {
        $db = Database::getInstance();
        return $db->query("UPDATE utilisateurs SET mot_de_passe = ?, date_modification = NOW() WHERE id = ?", 
                           [password_hash($newPassword, PASSWORD_DEFAULT), $id]);
    }


    public static function update($id, $data) {
        $db = Database::getInstance();
        
        // Mettre à jour les informations de base de l'utilisateur
        $query = "UPDATE utilisateurs 
                   SET nom = ?, prenom = ?, email = ?, role = ?,mot_de_passe = ?, statut = ?, date_modification = NOW() 
                   WHERE id = ?";
        
        $params = [
            $data['nom'],
            $data['prenom'],
            $data['email'],
            $data['role'],
            password_hash($data['mot_de_passe'], PASSWORD_DEFAULT),
            $data['statut'] ?? 'active',
            $id
        ];
        
        $db->query($query, $params);
    
        // Mettre à jour les informations spécifiques selon le rôle
        if ($data['role'] === 'stagiaire') {
            Stagiaire::update($id, $data);  // Mettre à jour les données spécifiques du stagiaire
        } elseif ($data['role'] === 'tuteur') {
            Tuteur::update($id, $data);  // Mettre à jour les données spécifiques du tuteur
        }
    
        return true;
    }


    public static function delete($id) {
        $db = Database::getInstance();
    
        // Vérifier le rôle avant de supprimer
        $user = self::getById($id);
    
        if ($user['role'] === 'stagiaire') {
            Stagiaire::deleteByUserId($id);  // Supprimer les données spécifiques du stagiaire
        } elseif ($user['role'] === 'tuteur') {
            Tuteur::deleteByUserId($id);  // Supprimer les données spécifiques du tuteur
        }
    
        // Supprimer l'utilisateur de la table principale
        return $db->query("DELETE FROM utilisateurs WHERE id = ?", [$id]);
    }
    
}
