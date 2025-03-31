<?php 
namespace App\Models;

use Core\Database;

class Auth {

    private $db;
    public function __construct() {
        $this->db = Database::getInstance();
    }
    

    // Authentifier un utilisateur
    public static function authenticate($email, $password) 
    {
        $db = Database::getInstance();
        $user = $db->fetch("SELECT * FROM utilisateurs WHERE email = ?", [$email]);

        if ($user && password_verify($password, $user['mot_de_passe'])) {
            return $user;
        }
        return false;
    }

    // Réinitialiser le mot de passe d'un utilisateur
    public static function resetPassword($id, $newPassword) {
        $db = Database::getInstance();
        $query = "UPDATE utilisateurs SET mot_de_passe = ? WHERE id = ?";
        $params = [password_hash($newPassword, PASSWORD_DEFAULT), $id];
        return $db->query($query, $params);
    }


    public static function login($username, $password)
    {
      $db =  Database::getInstance();
       $user = $db->fetch("SELECT * FROM utilisateur WHERE nom = ?", [$username]);
       
       if ($user && password_verify($password, $user['mot_de_passe'])) {
           // Stocker les informations de l'utilisateur en session
           $_SESSION['user_id'] = $user['id'];
           $_SESSION['username'] = $user['nom'];
           $_SESSION['user_role'] = $user['role'];
           $_SESSION['logged_in'] = true;
           return true;
       }
       
       return false;
   }

   /**
    *Get user id 
    */
   
    public static function id() 
    {
      return $_SESSION['user_id'] ?? null ;
    }
   /**
    * Déconnecter l'utilisateur
    */
   public function logout() {
       // Détruire toutes les variables de session
       $_SESSION = [];
       
       // Détruire la session
       session_destroy();
       
       // Rediriger vers la page de connexion
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
   
   /**
    * Obtenir l'ID de l'utilisateur connecté
    */
   public function getUserId() {
       return $_SESSION['user_id'] ?? null;
   }
   
   /**
    * Obtenir le type d'utilisateur connecté
    */
   public static function getUserType() {
       return $_SESSION['user_role'] ?? null;
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


   public static function isAdmin(){
    if (!self::isLoggedIn()) {
        return false;
    }
    return $_SESSION['user_role'] === 'admin';
   }

   public static function isTuteur(){
    if (!self::isLoggedIn()) {
        return false;
    }
    return $_SESSION['user_role'] === 'tuteur';
   }

   public static function isStagiaire(){
    if (!self::isLoggedIn()) {
        return false;
    }
    // dd(self::getUserType());
    return $_SESSION['user_role'] === 'stagiaire';
   }

   public static function isSuperviseur(){
    if (!self::isLoggedIn()) {
        return false;
    }
    return $_SESSION['user_role'] === 'superviseur';
   }
}
