<?php

namespace App\Controllers;

use Core\Controller;
use App\Models\Category;

class CategoryController extends Controller {

    public function index() {
        $this->checkAuth();
        $categories = Category::getAll();
        $this->view('categories/index', ['categories' => $categories], 'admin');
    }

    public function create() {
        $this->checkAuth();
        $this->view('categories/create', [], 'admin');
    }

    public function store() {
        $this->checkAuth();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nom' => $_POST['nom'],
                'description' => $_POST['description']
            ];

            if (Category::add($data)) {
                $_SESSION['success'] = "Catégorie ajoutée avec succès.";
                $this->redirect('/categories');
            } else {
                $_SESSION['error'] = "Erreur lors de l'ajout de la catégorie.";
                $this->redirect('/categories/create');
            }
        }
    }

    public function edit($id) {
        $this->checkAuth();
        $category = Category::getById($id);
        $this->view('categories/edit', ['category' => $category], 'admin');
    }

    public function update($id) {
        $this->checkAuth();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nom' => $_POST['nom'],
                'description' => $_POST['description']
            ];

            if (Category::update($id, $data)) {
                $_SESSION['success'] = "Catégorie mise à jour avec succès.";
                $this->redirect('/categories');
            } else {
                $_SESSION['error'] = "Erreur lors de la mise à jour de la catégorie.";
                $this->redirect("/categories/edit/$id");
            }
        }
    }

    public function delete($id) {
        $this->checkAuth();
        if (Category::delete($id)) {
            $_SESSION['success'] = "Catégorie supprimée avec succès.";
        } else {
            $_SESSION['error'] = "Erreur lors de la suppression de la catégorie.";
        }
        $this->redirect('/categories');
    }
}
?>
