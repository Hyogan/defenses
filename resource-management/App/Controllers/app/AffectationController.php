<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Affectation;
use App\Models\Material;
use App\Models\Laboratory;
use App\Models\Service;

class AffectationController extends Controller {

    public function index() {
        $this->checkAuth();
        $affectations = Affectation::getAll();
        $this->view('affectations/index', ['affectations' => $affectations], 'admin');
    }

    public function create() {
        $this->checkAuth();
        $materials = Material::getAll();
        $laboratories = Laboratory::getAll();
        $services = Service::getAll();
        $this->view('affectations/create', ['materials' => $materials, 'laboratories' => $laboratories, 'services' => $services], 'admin');
    }

    public function store() {
        $this->checkAuth();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'id_materiel' => $_POST['id_materiel'],
                'id_laboratoire' => $_POST['id_laboratoire'] ?? null,
                'id_service' => $_POST['id_service'] ?? null,
                'date_fin_affectation' => $_POST['date_fin_affectation'] ?? null
            ];

            if (Affectation::add($data)) {
                $_SESSION['success'] = "Affectation créée avec succès.";
                $this->redirect('/affectations');
            } else {
                $_SESSION['error'] = "Erreur lors de la création de l'affectation.";
                $this->redirect('/affectations/create');
            }
        }
    }

    public function edit($id) {
        $this->checkAuth();
        $affectation = Affectation::getById($id);
        $materials = Material::getAll();
        $laboratories = Laboratory::getAll();
        $services = Service::getAll();
        $this->view('affectations/edit', ['affectation' => $affectation, 'materials' => $materials, 'laboratories' => $laboratories, 'services' => $services], 'admin');
    }

    public function update($id) {
        $this->checkAuth();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'id_materiel' => $_POST['id_materiel'],
                'id_laboratoire' => $_POST['id_laboratoire'] ?? null,
                'id_service' => $_POST['id_service'] ?? null,
                'date_fin_affectation' => $_POST['date_fin_affectation'] ?? null
            ];

            if (Affectation::update($id, $data)) {
                $_SESSION['success'] = "Affectation mise à jour avec succès.";
                $this->redirect('/affectations');
            } else {
                $_SESSION['error'] = "Erreur lors de la mise à jour de l'affectation.";
                $this->redirect("/affectations/edit/$id");
            }
        }
    }

    public function delete($id) {
        $this->checkAuth();
        if (Affectation::delete($id)) {
            $_SESSION['success'] = "Affectation supprimée avec succès.";
        } else {
            $_SESSION['error'] = "Erreur lors de la suppression de l'affectation.";
        }
        $this->redirect('/affectations');
    }
}
?>
