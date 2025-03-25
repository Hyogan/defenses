<?php
namespace App\Controllers;

use App\Models\Tache;
use App\Models\User;
use Core\Controller;
use App\Models\Stagiaire;
use App\Models\Auth;

class DashboardController extends Controller {
    
    // Méthode générique pour l'index
    public function index() {
        // Check if user is logged in, redirect to auth/login (not /login) to match routes.php
        if(!Auth::isLoggedIn()) {
            return $this->redirect('/auth/login');
        }
        
        // Redirect based on role
        // dd(Auth::isStagiaire());
        if (Auth::isAdmin()) {
            return $this->redirect('/dashboard/admin');
        } elseif (Auth::isSuperviseur()) {
            return $this->redirect('/dashboard/superviseur');
        } elseif (Auth::isTuteur()) {
            return $this->redirect('/dashboard/tuteur');
        } elseif (Auth::isStagiaire()) {
            return $this->redirect('/dashboard/stagiaire');
        } else {
            // Fallback for users with no specific role
            return $this->view('/', [], 'admin');
        }
    }

    // Tableau de bord pour les Superviseurs
    public function superviseur() {
        // Vérification du rôle de l'utilisateur (Superviseur)
        if (!Auth::isLoggedIn()) {
            return $this->redirect('/auth/login');
        }
        
        if (!Auth::isSuperviseur()) {
            return $this->redirect('/dashboard');
        }
        
        // Logic spécifique au superviseur
        $stagiairesEnRetard = Stagiaire::getAllStagiaires();
        return $this->view('dashboard/superviseur', 
                ['stagiairesEnRetard' => $stagiairesEnRetard],
              'admin');
    }

    // Tableau de bord pour les Tuteurs
    public function tuteur() {
        // Vérification du rôle de l'utilisateur (Tuteur)
        if (!Auth::isLoggedIn()) {
            return $this->redirect('/auth/login');
        }
        
        if (!Auth::isTuteur()) {
            return $this->redirect('/dashboard');
        }
        
        // Logic spécifique au tuteur
        $tachesAssignées = [];// récupérer les tâches assignées au tuteur
        return $this->view('dashboard/tuteur', 
        ['tachesAssignées' => $tachesAssignées]
        , 'admin');
    }

    // Tableau de bord pour les Stagiaires
    public function stagiaire() {
        if (!Auth::isLoggedIn()) {
            return $this->redirect('/auth/login');
        }
        
        if (!Auth::isStagiaire()) {
            return $this->redirect('/dashboard');
        }
        
        $stagiaireId = Stagiaire::getByUserId(Auth::id()); 
        $tachesEnCours = Tache::getByStagiaire($stagiaireId);// récupérer les tâches en cours du stagiaire
        return $this->view(
          'dashboard/stagiaire',
          [
            'tachesEnCours' => $tachesEnCours,
            'pageTitle' => 'Dashboard stagiaire'
            ],
         'admin');
    }

    // Tableau de bord pour l'Admin (gestion complète)
    public function admin() {
        // Vérification du rôle de l'utilisateur (Admin)
        if (!Auth::isLoggedIn()) {
            return $this->redirect('/auth/login');
        }
        
        if (!Auth::isAdmin()) {
            return $this->redirect('/dashboard');
        }
        
        // Logic spécifique à l'admin
        $allUsers = User::getAll(); // Exemple pour récupérer tous les utilisateurs
        return $this->view('dashboard/admin', ['allUsers' => $allUsers],'admin');
    }

    // Méthode pour afficher les stagiaires en retard
    public function retards() {
        if (!Auth::isLoggedIn()) {
            return $this->redirect('/auth/login');
        }
        
        // Vérification du rôle de l'utilisateur (admin, superviseur, tuteur)
        $user = User::getById($_SESSION['user_id']);
        
        if ($user['role'] === 'admin' || $user['role'] === 'superviseur') {
            $stagiairesEnRetard = []; // récupérer les stagiaires en retard
            return $this->view('retards_dashboard', ['stagiairesEnRetard' => $stagiairesEnRetard]);
        } else {
            return $this->redirect('/dashboard');
        }
    }
}
