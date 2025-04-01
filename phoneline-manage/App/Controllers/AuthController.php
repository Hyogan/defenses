<?php 
namespace App\Controllers;

use Core\Controller;
use App\Models\Auth;

class AuthController extends Controller{
    public function login() {
        if (Auth::isLoggedIn()) {
            $this->redirect('/dashboard');
        }
        $this->view('auth/login',[
            'title' => 'Connexion | Internships Management',
            'pageTitle' => 'Connexion'
        ],'auth');
    }


    public function register() 
    {
        // Si l'utilisateur est déjà connecté, rediriger vers le tableau de bord
        if (Auth::isLoggedIn()) {
            $this->redirect('/dashboard');
            exit;
        }
        $this->view('auth/register',
        [
          'title' => 'Inscription | Internships Management',
          'pageTitle' => 'Inscription'
        ],'auth'
      );
    }



    public function authenticate() 
    {
      // dd('fds');
        // Si l'utilisateur est déjà connecté, rediriger vers le tableau de bord
        if (Auth::isLoggedIn()) {
            $this->redirect('/dashboard');
        }
        
        // Vérifier si le formulaire a été soumis
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
        -    $remember = isset($_POST['remember']) ? true : false;
            $errors = [];
            
            if (empty($email)) {
                $errors['email'] = 'L\'adresse mail est obligatoire';
            }
            if (empty($password)) {
                $errors['password'] = 'Le mot de passe est obligatoire';
            }
            
            if (!empty($errors)) {
              return $this->view('auth/login', [
                'title' => 'Connexion | Internships Management',
                'pageTitle' => 'Connexion',
                'email' => $email,
                'errors' => $errors
              ],'auth');
            }
            // $user = User::getByEmail($email);
            $user = Auth::authenticate($email, $password);
            if (!$user) {
               return $this->view('auth/login', [
                    'title' => 'Connexion | Internships Management',
                    'pageTitle' => 'Connexion',
                    'email' => $email,
                    'error' => 'Identifiants incorrects'
                ],'auth');
            }
            
            // Vérifier si le compte est actif
            if ($user['statut'] !== 'actif') {
                $this->view('auth/login', [
                    'title' => 'Connexion | Internships Management',
                    'pageTitle' => 'Connexion',
                    'email' => $email,
                    'error' => 'Votre compte est désactivé'
                ],'auth');
            }
    
    // Connecter l'utilisateur
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_name'] = $user['prenom'] . ' ' . $user['nom'];
    $_SESSION['user_email'] = $user['email'];
    $_SESSION['logged_in'] = true;
    $_SESSION['user_role'] = $user['role'];
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
    $this->redirect('/dashboard');
  }
}

    // Connexion des utilisateurs
    // public function login() {
    //     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //         $email = $_POST['email'];
    //         $password = $_POST['password'];
    //         $user = User::authenticate($email, $password);
            
    //         if ($user) {
    //             // Authentification réussie, rediriger vers la page d'accueil ou tableau de bord
    //             header("Location: /dashboard");
    //         } else {
    //             // Échec de l'authentification, afficher un message d'erreur
    //             echo "Email ou mot de passe incorrect";
    //         }
    //     }
    //     require_once('views/auth/login.php');
    // }

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
            'title' => 'Réinitialisation du mot de passe | Internships Management',
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
