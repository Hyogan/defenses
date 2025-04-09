<?php

namespace App\Controllers;

use App\Models\Auth;
use App\Models\Service;
use Core\Controller;
use App\Models\User;

class UserController extends Controller {

    public function index() {
        $this->checkAuth();
        $users = User::getAll();
        $this->view('users/index', ['users' => $users], 'admin');
    }

    public function create() {
        $this->checkAuth();
        $services = Service::getAll();
        $this->view('users/create', ['services' => $services], 'admin');
    }

    public function store() {
        $this->checkAuth();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nom_complet' => $_POST['nom_complet'],
                'email' => $_POST['email'],
                'id_service' => $_POST['id_service'],
                'mot_de_passe' => password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT),
                'role' => $_POST['role']
            ];
            // dd($data);
            if (User::add($data)) {
                $_SESSION['success'] = "Utilisateur ajouté avec succès.";
                $this->redirect('/users');
            } else {
                $_SESSION['error'] = "Erreur lors de l'ajout de l'utilisateur.";
                $this->redirect('/users/create');
            }
        }
    }
    public function show($id) 
    {
      $user = User::getById($id);
      return $this->view('users/details',['userInfo' => $user], 'admin');
    }

    public function edit($id) {
        $this->checkAuth();
        $user = User::getById($id);
        $services = Service::getAll();
        $this->view('users/edit', ['user' => $user,'services' => $services], 'admin');
    }

    public function update($id) {
        $this->checkAuth();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nom_complet' => $_POST['nom_complet'],
                'email' => $_POST['email'],
                'id_service' => $_POST['id_service'],
                'role' => $_POST['role']
            ];

            if (!empty($_POST['mot_de_passe'])) {
                $data['mot_de_passe'] = password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT);
            }

            if (User::update($id, $data)) {
                $_SESSION['success'] = "Utilisateur mis à jour avec succès.";
                $this->redirect('/users');
            } else {
                $_SESSION['error'] = "Erreur lors de la mise à jour de l'utilisateur.";
                $this->redirect("/users/edit/$id");
            }
        }
    }

    public function delete($id) {
        $this->checkAuth();
        if (User::delete($id)) {
            $_SESSION['success'] = "Utilisateur supprimé avec succès.";
        } else {
            $_SESSION['error'] = "Erreur lors de la suppression de l'utilisateur.";
        }
        $this->redirect('/users');
    }

    public function profile() {
      // dd('fhsdf');
      if(!Auth::isLoggedIn()) 
      {
        $this->redirect('/');
      }
      $user = User::getById(Auth::id());
      $userInfos = $user;
      return $this->view('dashboard/profile',['userInfo' => $userInfos],'admin');
    }

    public function changePassword() {
      if (!Auth::isLoggedIn()) {
          return $this->redirect('/auth/login');
      }
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          $currentPassword = $_POST['current_password'];
          $newPassword = $_POST['new_password'];
          $confirmPassword = $_POST['confirm_password'];
          $user = User::getById(Auth::id());
          if (!password_verify($currentPassword, $user['mot_de_passe'])) {
              $message = ['type' => 'danger', 'text' => 'Mot de passe actuel incorrect.'];
          } elseif ($newPassword !== $confirmPassword) {
              $message = ['type' => 'danger', 'text' => 'Les nouveaux mots de passe ne correspondent pas.'];
          } elseif (strlen($newPassword) < 8) {
              $message = ['type' => 'danger', 'text' => 'Le nouveau mot de passe doit contenir au moins 8 caractères.'];
          } else {
              User::updatePassword(Auth::id(), $newPassword);
              $message = ['type' => 'success', 'text' => 'Mot de passe modifié avec succès.'];
          }

          return $this->view('dashboard/profile', 
          ['message' => $message,'userInfo' => $user],
          'admin'
        );
      }
      return $this->redirect('user/profile');
  }
}
