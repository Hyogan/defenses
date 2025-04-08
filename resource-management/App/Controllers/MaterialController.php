<?php

namespace App\Controllers;

use Core\Controller;
use App\Models\Material;
use App\Models\Category;

class MaterialController extends Controller {

    public function index() {
        $this->checkAuth();
        $materials = Material::getAll();
        // dd($materials);
        $this->view('materials/index', ['materials' => $materials], 'admin');
    }

    public function create() {
        $this->checkAuth();
        $categories = Category::getAll();
        $this->view('materials/create', ['categories' => $categories], 'admin');
    }

    public function store() {
        $this->checkAuth();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nom' => $_POST['nom'],
                'description' => $_POST['description'],
                'model' => $_POST['model'],
                'id_categorie' => $_POST['id_categorie']
            ];

            if (Material::add($data)) {
                $_SESSION['success'] = "Matériel ajouté avec succès.";
                $this->redirect('/materials');
            } else {
                $_SESSION['error'] = "Erreur lors de l'ajout du matériel.";
                $this->redirect('/materials/create');
            }
        }
    }

    public function edit($id) {
        $this->checkAuth();
        $material = Material::getById($id);
        $categories = Category::getAll();
        $this->view('materials/edit', ['material' => $material, 'categories' => $categories], 'admin');
    }

    public function update($id) {
        $this->checkAuth();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nom' => $_POST['nom'],
                'description' => $_POST['description'],
                'model' => $_POST['model'],
                'id_categorie' => $_POST['id_categorie']
            ];

            if (Material::update($id, $data)) {
                $_SESSION['success'] = "Matériel mis à jour avec succès.";
                $this->redirect('/materials');
            } else {
                $_SESSION['error'] = "Erreur lors de la mise à jour du matériel.";
                $this->redirect("/materials/edit/$id");
            }
        }
    }

    public function delete($id) {
        $this->checkAuth();
        if (Material::delete($id)) {
            $_SESSION['success'] = "Matériel supprimé avec succès.";
        } else {
            $_SESSION['error'] = "Erreur lors de la suppression du matériel.";
        }
        $this->redirect('/materials');
    }
}
?>
