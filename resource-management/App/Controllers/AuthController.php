<?php 
namespace App\Controllers;

use App\Models\User;
use Core\Controller;
use App\Models\Auth;

class AuthController extends Controller{
    public function login() {
        if (Auth::isLoggedIn()) {
            $this->redirect('/dashboard');
        }
        $this->view('auth/login',[
            'title' => 'Connexion | Gestion de Composants et de rebus',
            'pageTitle' => 'Connexion'
        ],'auth');
    }

    public function authenticate() {
      if (Auth::isLoggedIn()) {
          $this->redirect('/dashboard');
      }

      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          $email = $_POST['email'] ?? '';
          $password = $_POST['password'] ?? '';
          $errors = [];

          if (empty($email)) {
              $errors['email'] = 'L\'adresse mail est obligatoire';
          }
          if (empty($password)) {
              $errors['password'] = 'Le mot de passe est obligatoire';
          }

          if (!empty($errors)) {
              return $this->view('auth/login', [
                  'title' => 'Connexion | Gestion de Composants et de rebus',
                  'pageTitle' => 'Connexion',
                  'email' => $email,
                  'errors' => $errors
              ], 'auth');
          }

          $user = User::getByEmail($email); // Get user by email from the database

          if (!$user) {
              return $this->view('auth/login', [
                  'title' => 'Connexion  | Gestion de Composants et de rebus',
                  'pageTitle' => 'Connexion',
                  'email' => $email,
                  'error' => 'Identifiants incorrects'
              ], 'auth');
          }

          // Check if the account is active FIRST
          // if ($user['statut'] !== 'actif') {
          //      return $this->view('auth/login', [
          //         'title' => 'Connexion | Gestion de composants et de rebus',
          //         'pageTitle' => 'Connexion',
          //         'email' => $email,
          //         'error' => 'Votre compte est désactivé'
          //     ],'auth');
          // }

          // THEN, authenticate the user
           if (!Auth::authenticate($email, $password)) {
              return $this->view('auth/login', [
                  'title' => 'Connexion | Gestion de Composants et de rebus',
                  'pageTitle' => 'Connexion',
                  'email' => $email,
                  'error' => 'Identifiants incorrects'
              ], 'auth');
          }

          // Connect the user
          $_SESSION['user_id'] = $user['id_utilisateur'];
          $_SESSION['user_name'] = $user['nom_complet'];
          $_SESSION['user_email'] = $user['email'];
          $_SESSION['logged_in'] = true;
          $_SESSION['user_role'] = $user['role'];

          // Redirect to the dashboard
          $this->redirect('/dashboard');
      }
  
    // die($user);

    // var_dump('fsdfsd');
    
    // Si "Se souvenir de moi" est coché, créer un cookie
    // if ($remember) {
    //     $token = bin2hex(random_bytes(32));
    //     $expiry = time() + (30 * 24 * 60 * 60); // 30 jours
        
    //     // Enregistrer le token en base de données
    //     User::saveRememberToken($user['id'], $token, $expiry);
        
    //     // Créer le cookie
    //     setcookie('remember_token', $token, $expiry, '/', '', false, true);
    // }
    
    // Rediriger vers le tableau de bord
  
}
    // Réinitialisation du mot de passe
    public function resetPassword() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['user_id'];
            $newPassword = $_POST['new_password'];
            Auth::resetPassword($id, $newPassword);
            // Rediriger ou afficher un message
            $this->redirect('/login');
            exit;
        }
        
        $this->view('auth/reset_password', [
            'title' => 'Réinitialisation du mot de passe | Gestion de Composants et de rebuss',
            'pageTitle' => 'Réinitialisation du mot de passe'
        ],'auth');
    }




    public function logout() {
        // Supprimer le token "Se souvenir de moi" s'il existe
        session_start();
        session_unset();
        session_destroy();
        // Supprimer le cookie de session
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        
        // Rediriger vers la page de connexion
        $this->redirect('/auth/login');
        exit;
    }
}
