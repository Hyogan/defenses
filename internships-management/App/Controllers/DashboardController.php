<?php
namespace App\Controllers;

use App\Models\Tache;
use App\Models\Tuteur;
use App\Models\User;
use Core\Controller;
use App\Models\Stagiaire;
use App\Models\Auth;
use App\Models\Evaluation;

class DashboardController extends Controller {
    
    // Méthode générique pour l'index
    public function index() {
        // Check if user is logged in, redirect to auth/login (not /login) to match routes.php
        if(!Auth::isLoggedIn()) {
            return $this->redirect('/auth/login');
        }
        
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
    public function superviseur() 
    {
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
        $tuteur = User::getById(Auth::id());
        $id = $tuteur['tuteur']['id'];
        $taches = Tache::getByTuteur($id);
        $evaluations = Evaluation::getByTuteur($id);
        $stagiaires = Stagiaire::getByTuteurId($id);
        // dd($taches);
        // dd([
        //   'taches' => $taches,
        //   'evaluations' => $evaluations,
        //   'stagiaires' => $stagiaires
        // ]);
        return $this->view('dashboard/tuteur', 
        [
          'taches' => $taches,
          'evaluations' => $evaluations,
          'stagiaires' => $stagiaires
        ]
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
        $user = User::getById(Auth::id());
        $stagiaireId = $user['stagiaire']['id'];
        $tachesEnCours = Tache::getByStagiaire($stagiaireId);// récupérer les tâches en cours du stagiaire
        // $tachesCount = count($tachesEnCours);
        $tuteurCount  = count(Tuteur::getByStagiaire($stagiaireId));
        $evaluationCount = count(Evaluation::getByStagiaire($stagiaireId));
        // dd(Tuteur::getByStagiaire($stagiaireId));
        return $this->view(
          'dashboard/stagiaire',
          [
            'tuteurCount' => $tuteurCount,
            'evaluationCount' => $evaluationCount,
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
        $allUsers = User::getAll();
        $data = [
          'allUsers' => $allUsers,
          'userCount' => User::count(),
          'stagiaireCount' => Stagiaire::count(),
          'tuteurCount' => Tuteur::count(),
          'tacheCount' => Tache::count(),
          'evaluationCount' => Evaluation::count(),
          'latestStagiaires' => Stagiaire::getAllStagiaires(10),
          'recentTaches' => Tache::getAllTask(10),
        ];
        return $this->view('dashboard/admin', 
        $data,
        'admin');
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
