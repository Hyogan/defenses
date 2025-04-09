<?php 
namespace App\Models;

use Core\Database;
use App\Models\Log;  
use Core\Model;// Include the Log model

class Auth{

    private $db;
    
    public function __construct() {
        $this->db = Database::getInstance();
    }
    
    // Authentifier un utilisateur
    public static function authenticate($email, $password) 
    {
        $db = Database::getInstance();
        $user = $db->fetch("SELECT * FROM utilisateurs WHERE email = ?", [$email]);
        // dd([$user, $password]);
        if ($user && password_verify($password,$user['mot_de_passe'])) {
            // Store user information in the session
            // dd($user);
            $_SESSION['user_id'] = $user['id_utilisateur'];
            $_SESSION['username'] = $user['nom_complet'];
            $_SESSION['user_role'] = $user['role'];
            $_SESSION['logged_in'] = true;
            return $user;
        }

        return null;
    }

    // Réinitialiser le mot de passe d'un utilisateur
    public static function resetPassword($id, $newPassword) {
        $db = Database::getInstance();
        $query = "UPDATE utilisateurs SET mot_de_passe = ? WHERE id = ?";
        $params = [password_hash($newPassword, PASSWORD_DEFAULT), $id];
        return $db->query($query, $params);
    }

    // Authentifier et démarrer une session utilisateur
    // public static function login($username, $password)
    // {
    //     $db = Database::getInstance();
    //     $user = $db->fetch("SELECT * FROM utilisateurs WHERE nom = ?", [$username]);
        
    //     if ($user && password_verify($password, $user['mot_de_passe'])) {
    //         // Log the successful login action
    //         Log::create([
    //             'userId' => $user['id'],  // Logged-in user's ID
    //             'action' => 'Authentification utilisateur',
    //             'message' => 'Connexion réussie pour l\'utilisateur avec le nom : ' . $username
    //         ]);
            
    //         // Start user session
    //         $_SESSION['user_id'] = $user['id'];
    //         $_SESSION['username'] = $user['nom'];
    //         $_SESSION['user_role'] = $user['role'];
    //         $_SESSION['logged_in'] = true;

    //         return true;
    //     }
        
    //     // Log the failed login attempt
    //     Log::create([
    //         'userId' => null,  // No authenticated user for failed login
    //         'action' => 'Authentification utilisateur',
    //         'message' => 'Tentative de connexion échouée pour l\'utilisateur : ' . $username
    //     ]);

    //     return false;
    // }

    /**
     * Obtenir l'ID de l'utilisateur connecté
     */
    public static function id() 
    {
        return $_SESSION['user_id'] ?? null;
    }
   
    /**
     * Déconnecter l'utilisateur
     */
    public function logout() {
        // Destroy all session variables
        $_SESSION = [];
        
        // Destroy the session
        session_destroy();
        
        // Redirect to the login page
        header('Location: ' . APP_URL . '/index.php');
        exit;
    }
   
    /**
     * Vérifier si l'utilisateur est connecté
     */
   public static function isLoggedIn() 
   {
     return isset($_SESSION['user_id']);
   }

   public static function getUserType() 
   {
    return  $_SESSION['user_role'];
   }

   /**
    * Vérifier si l'utilisateur a un rôle spécifique
    */
   public function hasRole($role) {
       return $this->isLoggedIn() && $_SESSION['user_role'] === $role;
   }

   /**
    * Vérifier si l'utilisateur est autorisé à accéder à une page
    */
   public static function requireRole($roles) 
   {
       if (self::isLoggedIn()) {
           header('Location: ' . APP_URL . '/views/auth/login.php');
           exit;
       }
       $roles = (array) $roles;
       if (!in_array(self::getUserType(), $roles)) {
           header('Location: ' . APP_URL . '/views/errors/unauthorized.php');
           exit;
       }
       
       return true;
   }

   public static function isTechnicien(){
        if (!self::isLoggedIn()) {
            return false;
        }
        return $_SESSION['user_role'] === 'technicien';
   }

    public static function isResponsableLabo(){
      if (!self::isLoggedIn()) {
          return false;
      }
      return $_SESSION['user_role'] === 'responsable_laboratoire';
  }

  public static function isUtilisateur(){
    if (!self::isLoggedIn()) {
        return false;
    }
    return $_SESSION['user_role'] === 'utilisateur';
  }

   public static function isClassic(){
        if (!self::isLoggedIn()) {
            return false;
        }
        return $_SESSION['user_role'] === 'classic';
   }
}
