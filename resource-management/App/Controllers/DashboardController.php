<?php
namespace App\Controllers;

use App\Models\Material;
use App\Models\User;
use Core\Controller;
use App\Models\Auth;

class DashboardController extends Controller {
  public function home()
  {
    return $this->view('home',[],'base');
  }
    
    // Méthode générique pour l'index
    public function index() {
        // Check if user is logged in, redirect to auth/login (not /login) to match routes.php
        if(!Auth::isLoggedIn()) {
            return $this->redirect('/auth/login');
        }
        if (Auth::isTechnicien()) {
            return $this->redirect('/dashboard/technicien');
        } elseif (Auth::isClassic()) {
            return $this->redirect('/dashboard/classic');
        } else {
            // Fallback for users with no specific role
            return $this->view('/', [], 'admin');
        }
    }
    // Tableau de bord pour les Stagiaires
    public function classic() {
        if (!Auth::isLoggedIn()) {
            return $this->redirect('/auth/login');
        }
        if (!Auth::isClassic()) {
            return $this->redirect('/dashboard');
        }
       return $this->view(
          'dashboard/classic',
          [
            'userCount' => User::count(),
            // 'lignesCount' => Ligne::count(),
            // 'lignesRecentes' => Ligne::getAll(10)
            ],
         'admin');
    }

    // Tableau de bord pour l'Admin (gestion complète)
    public function technicien() {
        // Vérification du rôle de l'utilisateur (Admin)
        if (!Auth::isLoggedIn()) {
            return $this->redirect('/auth/login');
        }
        if (!Auth::isTechnicien()) {
            return $this->redirect('/dashboard');
        }
        // Logic spécifique à l'admin
        $allUsers = User::getAll();
        $userCount = User::count();
        $materialCount = Material::count();
        // $activiteRecente = Log::getAll(5);

        $data = [
          'allUsers' => $allUsers,
          'userCount' => $userCount,
          'materialCount' => $materialCount,
          'activiteRecente' => [],
      ];
      
        return $this->view('dashboard/technicien', 
        $data,
        'admin');
    }

    // public function logs()
    // {
    //   if (!Auth::isLoggedIn()) {
    //       return $this->redirect('/auth/login');
    //   }
    //   if (!Auth::isAdmin()) {
    //       return $this->redirect('/dashboard');
    //   }
    //   // $logs = Log::getAll();
    //   // dd($logs  );
    //   return $this->view('dashboard/logs',
    //   ['logsData' => []],
    //   'admin');
    // }
  }
