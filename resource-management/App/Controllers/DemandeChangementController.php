<?php

namespace App\Controllers;

use App\Models\Auth;
use App\Models\User;
use Core\Controller;
use App\Models\DemandeChangement;
use App\Models\Material;
use App\Models\Category;

class DemandeChangementController extends Controller
{
    public function index(): void
    {
        $demandes = DemandeChangement::getAll();
        if(Auth::isUtilisateur()) {
          $user = User::getById(Auth::id());
          $demandes = DemandeChangement::getByServiceId($user['id_utilisateur']);
        }
        $this->view('demandes/index', ['demandes' => $demandes], 'admin');
    }

    public function create(): void
    {
        $materials = Material::getAll();
        $categories = Category::getAll();
        $this->view('demandes/create', [
            'materials' => $materials,
            'categories' => $categories
        ], 'admin');
    }

    public function store(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'id_materiel' => $_POST['id_materiel'],
                'id_utilisateur' => Auth::id(),
                'nom' => $_POST['nom'],
                'description' => $_POST['description'],
                'model' => $_POST['model'],
                'raison' => $_POST['raison'],
                'id_categorie' => $_POST['id_categorie']
            ];

            if (DemandeChangement::create($data)) {
                flash('success', 'Demande de changement ajoutée avec succès.');
                $this->redirect('/demandes_changement');
            } else {
                flash('error', 'Erreur lors de l\'ajout de la demande.');
                $this->redirect('/demandes_changement/create');
            }
        }
    }

    public function edit(int $id): void
    {
        $demande = DemandeChangement::getById($id);
        $materials = Material::getAll();
        $categories = Category::getAll();
        $this->view('demandes/edit', [
            'demande' => $demande,
            'materials' => $materials,
            'categories' => $categories
        ], 'admin');
    }

    public function update(int $id): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'id_materiel' => $_POST['id_materiel'],
                'nom' => $_POST['nom'],
                'description' => $_POST['description'],
                'model' => $_POST['model'],
                'raison' => $_POST['raison'],
                'id_categorie' => $_POST['id_categorie']
            ];

            if (DemandeChangement::update($id, $data)) {
                flash('success', 'Demande mise à jour avec succès.');
                $this->redirect('/demandes_changement');
            } else {
                flash('error', 'Erreur lors de la mise à jour de la demande.');
                $this->redirect("/demandes_changement/edit/$id");
            }
        }
    }

    public function delete(int $id): void
    {
        if (DemandeChangement::delete($id)) {
            flash('success', 'Demande supprimée avec succès.');
        } else {
            flash('error', 'Erreur lors de la suppression de la demande.');
        }

        $this->redirect('/demandes_changement');
    }
}
