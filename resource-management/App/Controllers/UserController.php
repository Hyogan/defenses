<?php

namespace App\Controllers;

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
        $this->view('users/create', [], 'admin');
    }

    public function store() {
        $this->checkAuth();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nom_complet' => $_POST['nom_complet'],
                'email' => $_POST['email'],
                'mot_de_passe' => password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT),
                'role' => $_POST['role']
            ];

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
        $this->view('users/edit', ['user' => $user], 'admin');
    }

    public function update($id) {
        $this->checkAuth();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nom_complet' => $_POST['nom_complet'],
                'email' => $_POST['email'],
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
}
?>
