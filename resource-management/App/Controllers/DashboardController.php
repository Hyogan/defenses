<?php
namespace App\Controllers;

use App\Models\Laboratory;
use App\Models\Material;
use App\Models\Service;
use App\Models\User;
use Core\Controller;
use App\Models\Auth;
use App\Models\DemandeChangement;

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
        } elseif (Auth::isUtilisateur()) {
            return $this->redirect('/dashboard/utilisateur');
        } elseif (Auth::isResponsableLabo()) {
            return $this->redirect('/dashboard/responsable-laboratoire');
        } else {
            // Fallback for users with no specific role
            return $this->view('/dashboard/nothing',[],'admin');
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
            ],
         'admin');
    }

    // Tableau de bord pour l'Admin (gestion complète)
    public function responsableLabo() {
        // Vérification du rôle de l'utilisateur (Admin)
        if (!Auth::isLoggedIn()) {
            return $this->redirect('/auth/login');
        }
        if (!Auth::isResponsableLabo()) {
            return $this->redirect('/dashboard');
        }
        // Logic spécifique à l'admin
        $allUsers = User::getAll();
        $userCount = User::count();
        $demandes = DemandeChangement::getAll();
        $materialCount = Material::count();
        $laboratoires = Laboratory::getAll();
        $services = Service::getAll();
        $materials = Material::getAll();
        // dd($demandes);

        $data = [
          'allUsers' => $allUsers,
          'userCount' => $userCount,
          'materials'  => $materials,
          'materialCount' => $materialCount,
          'demandes' => $demandes,
          'laboratoires' => $laboratoires,
          'services' => $services, // Ajouter les services aux données
      ];
      
        return $this->view('dashboard/responsable', 
        $data,
        'admin');
    }

    public function utilisateur() {
      if (!Auth::isLoggedIn()) {
          return $this->redirect('/auth/login');
      }
      if (!Auth::isUtilisateur()) {
          return $this->redirect('/dashboard');
      }
      // $user = User::getById(Auth::id());
      //     $demandes = DemandeChangement::getByServiceId($user['id_utilisateur']);
        
      $id = Auth::Id();
      $user = User::getById($id);
      $user['service']  = Service::getById($user['id_service']);
      $demandes = DemandeChangement::getAll();
      // $demandes = DemandeChangement::getByServiceId($user['id_service']) ?? [];
     return $this->view(
        'dashboard/utilisateur',
        [
          'user' => $user,
          'demandes' => $demandes,
          ],
       'admin');
  }


  public function technicien() {
    if (!Auth::isLoggedIn()) {
        return $this->redirect('/auth/login');
    }
    if (!Auth::isTechnicien()) {
        return $this->redirect('/dashboard');
    }
    $id = Auth::Id();
    $user = User::getById($id);
    $materiels = Material::getAll();
    $demandes = DemandeChangement::getAll();
    // dd($demandes);
   return $this->view(
      'dashboard/technicien',
      [
        'materiels' => $materiels,
        'demandes' => $demandes,
        ],
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
