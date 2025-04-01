<?php 
namespace App\Controllers;

use App\Models\Log;
use Core\Controller;
use App\Models\Auth;
use App\Models\User;
use DateInterval;
class UserController extends Controller{
      public function index() {
        if (!Auth::isAdmin()) {
            $this->redirect('/dashboard');
        }
        $allUsers = User::getAll();
        return $this->view('utilisateurs/liste', [
            'title' => 'Liste des utilisateurs | Gestion de lignes',
            'pageTitle' => 'Liste des utilisateurs',
            'utilisateurs' => $allUsers,
        ], 'admin');
    }

    public function create() {
        if (!Auth::isAdmin()) {
            $this->redirect('/dashboard');
        }
        return $this->view('utilisateurs/ajouter', [], 'admin');
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return $this->redirect('/user/create');
        }
        // dd()

        $data = $_POST;
        $errors = [];

        // Basic input checks (replace with more robust checks as needed)
        if (empty($data['nom'])) {
            $errors['nom'] = "Le nom est requis.";
        }
        if (empty($data['prenom'])) {
            $errors['prenom'] = "Le prénom est requis.";
        }
        if (empty($data['email'])) {
            $errors['email'] = "L'email est requis.";
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "L'email n'est pas valide.";
        }
        if (empty($data['mot_de_passe'])) {
            $errors['mot_de_passe'] = "Le mot de passe est requis.";
        } elseif (strlen($data['mot_de_passe']) < 6) {
            $errors['mot_de_passe'] = "Le mot de passe doit contenir au moins 6 caractères.";
        }
        if (!in_array($data['role'], ['admin', 'classic'])) {
            $errors['role'] = "Role invalide.";
        }
        if (!in_array($data['statut'], ['actif', 'inactif'])) {
            $errors['statut'] = "Statut invalide.";
        }
        if (!empty($errors)) {
            return $this->view('utilisateurs/ajouter', ['errors' => $errors, 'data' => $data], 'admin');
        }

        if (User::getByEmail($data['email'])) {
            $errors['email'] = "L'email choisi est déjà utilisé.";
            return $this->view('utilisateurs/ajouter', ['errors' => $errors, 'data' => $data], 'admin');
        }

        $userId = User::create($data, $data['role']);

        if (!$userId) {
            error_log("User creation failed for email: " . $data['email']);
            $errors['creation'] = "Une erreur est survenue lors de la création de l'utilisateur.";
            return $this->view('utilisateurs/ajouter', ['errors' => $errors, 'data' => $data], 'admin');
        }

        return $this->redirect('/user/management');
    }

    public function edit($id) {
        if (!Auth::isAdmin()) {
            $this->redirect('/dashboard');
        }
        $user = User::getById($id);
        if (!$user) {
            $this->redirect('/user/management');
        }
        return $this->view('utilisateurs/modifier', ['user' => $user], 'admin');
    }

    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return $this->redirect('/user/management');
        }

        $data = $_POST;
        $errors = [];

        if (empty($data['nom'])) {
            $errors['nom'] = "Le nom est requis.";
        }
        if (empty($data['prenom'])) {
            $errors['prenom'] = "Le prénom est requis.";
        }
        if (empty($data['email'])) {
            $errors['email'] = "L'email est requis.";
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "L'email n'est pas valide.";
        }
        if (!empty($data['mot_de_passe']) && strlen($data['mot_de_passe']) < 6) {
            $errors['mot_de_passe'] = "Le mot de passe doit contenir au moins 6 caractères.";
        }
        if (!in_array($data['role'], ['admin', 'classic'])) {
            $errors['role'] = "Role invalide.";
        }
        if (!in_array($data['statut'], ['actif', 'inactif'])) {
            $errors['statut'] = "Statut invalide.";
        }

        if (!empty($errors)) {
            $data['id'] = $id;
            return $this->view('utilisateurs/modifier', ['errors' => $errors, 'user' => $data], 'admin');
        }

        if (User::getByEmail($data['email'])) {
            $errors['email'] = "L'email choisi est déjà utilisé.";
            $data['id'] = $id;
            return $this->view('utilisateurs/modifier', ['errors' => $errors, 'user' => $data], 'admin');
        }

        $updated = User::update($id, $data);

        if (!$updated) {
            error_log("User update failed for ID: " . $id);
            $errors['update'] = "Une erreur est survenue lors de la mise à jour de l'utilisateur.";
            $data['id'] = $id;
            return $this->view('utilisateurs/modifier', ['errors' => $errors, 'user' => $data], 'admin');
        }

        return $this->redirect('/user/management');
    }
    public function show($id)
    {
      $user = User::getById($id);
        if (!$user) {
            $this->redirect('/user/management');
        }
        $userInfos = $user; 
        $userInfos['logs'] = Log::getByUserId($id);
        // dd($userInfos);
        return $this->view('utilisateurs/details', ['userInfo' => $userInfos], 'admin');
    }

    public function delete($id) {
        if (!Auth::isAdmin()) {
            $this->redirect('/dashboard');
        }

        $deleted = User::delete($id);

        if (!$deleted) {
            error_log("User deletion failed for ID: " . $id);
        }

        return $this->redirect('/user/management');
    }
}
