<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Service;

class ServiceController extends Controller {

    public function index() {
        $this->checkAuth();
        $services = Service::getAll();
        $this->view('services/index', ['services' => $services], 'admin');
    }

    public function create() {
        $this->checkAuth();
        $this->view('services/create', [], 'admin');
    }

    public function store() {
        $this->checkAuth();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nom' => $_POST['nom'],
                'localisation' => $_POST['localisation'],
                'description' => $_POST['description']
            ];

            if (Service::add($data)) {
                $_SESSION['success'] = "Service ajouté avec succès.";
                $this->redirect('/services');
            } else {
                $_SESSION['error'] = "Erreur lors de l'ajout du service.";
                $this->redirect('/services/create');
            }
        }
    }

    public function edit($id) {
        $this->checkAuth();
        $service = Service::getById($id);
        $this->view('services/edit', ['service' => $service], 'admin');
    }

    public function update($id) {
        $this->checkAuth();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nom' => $_POST['nom'],
                'localisation' => $_POST['localisation'],
                'description' => $_POST['description']
            ];

            if (Service::update($id, $data)) {
                $_SESSION['success'] = "Service mis à jour avec succès.";
                $this->redirect('/services');
            } else {
                $_SESSION['error'] = "Erreur lors de la mise à jour du service.";
                $this->redirect("/services/edit/$id");
            }
        }
    }

    public function delete($id) {
        $this->checkAuth();
        if (Service::delete($id)) {
            $_SESSION['success'] = "Service supprimé avec succès.";
        } else {
            $_SESSION['error'] = "Erreur lors de la suppression du service.";
        }
        $this->redirect('/services');
    }
}
?>
