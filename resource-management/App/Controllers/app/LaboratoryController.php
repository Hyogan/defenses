<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Laboratory;

class LaboratoryController extends Controller {

    public function index() {
        $this->checkAuth();
        $laboratories = Laboratory::getAll();
        $this->view('laboratories/index', ['laboratories' => $laboratories], 'admin');
    }

    public function create() {
        $this->checkAuth();
        $this->view('laboratories/create', [], 'admin');
    }

    public function store() {
        $this->checkAuth();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nom' => $_POST['nom'],
                'numero' => $_POST['numero'],
                'localisation' => $_POST['localisation'],
                'description' => $_POST['description']
            ];

            if (Laboratory::add($data)) {
                $_SESSION['success'] = "Laboratoire ajouté avec succès.";
                $this->redirect('/laboratories');
            } else {
                $_SESSION['error'] = "Erreur lors de l'ajout du laboratoire.";
                $this->redirect('/laboratories/create');
            }
        }
    }

    public function edit($id) {
        $this->checkAuth();
        $laboratory = Laboratory::getById($id);
        $this->view('laboratories/edit', ['laboratory' => $laboratory], 'admin');
    }

    public function update($id) {
        $this->checkAuth();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nom' => $_POST['nom'],
                'numero' => $_POST['numero'],
                'localisation' => $_POST['localisation'],
                'description' => $_POST['description']
            ];

            if (Laboratory::update($id, $data)) {
                $_SESSION['success'] = "Laboratoire mis à jour avec succès.";
                $this->redirect('/laboratories');
            } else {
                $_SESSION['error'] = "Erreur lors de la mise à jour du laboratoire.";
                $this->redirect("/laboratories/edit/$id");
            }
        }
    }

    public function delete($id) {
        $this->checkAuth();
        if (Laboratory::delete($id)) {
            $_SESSION['success'] = "Laboratoire supprimé avec succès.";
        } else {
            $_SESSION['error'] = "Erreur lors de la suppression du laboratoire.";
        }
        $this->redirect('/laboratories');
    }
}
?>
