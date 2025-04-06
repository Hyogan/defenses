<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Rebus;
use App\Models\Material;

class RebusController extends Controller {

    public function index() {
        $this->checkAuth();
        $rebus = Rebus::getAll();
        $this->view('rebus/index', ['rebus' => $rebus], 'admin');
    }

    public function create() {
        $this->checkAuth();
        $materials = Material::getAll();
        $this->view('rebus/create', ['materials' => $materials], 'admin');
    }

    public function store() {
        $this->checkAuth();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'reference' => $_POST['reference'],
                'id_materiel' => $_POST['id_materiel'],
                'panne' => $_POST['panne'],
                'description_panne' => $_POST['description_panne']
            ];

            if (Rebus::add($data)) {
                $_SESSION['success'] = "Matériel mis au rebut avec succès.";
                $this->redirect('/rebus');
            } else {
                $_SESSION['error'] = "Erreur lors de la mise au rebut du matériel.";
                $this->redirect('/rebus/create');
            }
        }
    }

    public function edit($id) {
        $this->checkAuth();
        $rebus = Rebus::getById($id);
        $materials = Material::getAll();
        $this->view('rebus/edit', ['rebus' => $rebus, 'materials' => $materials], 'admin');
    }

    public function update($id) {
        $this->checkAuth();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'reference' => $_POST['reference'],
                'id_materiel' => $_POST['id_materiel'],
                'panne' => $_POST['panne'],
                'description_panne' => $_POST['description_panne']
            ];

            if (Rebus::update($id, $data)) {
                $_SESSION['success'] = "Matériel mis au rebut mis à jour avec succès.";
                $this->redirect('/rebus');
            } else {
                $_SESSION['error'] = "Erreur lors de la mise à jour du matériel mis au rebut.";
                $this->redirect("/rebus/edit/$id");
            }
        }
    }

    public function delete($id) {
        $this->checkAuth();
        if (Rebus::delete($id)) {
            $_SESSION['success'] = "Matériel mis au rebut supprimé avec succès.";
        } else {
            $_SESSION['error'] = "Erreur lors de la suppression du matériel mis au rebut.";
        }
        $this->redirect('/rebus');
    }
}
?>
