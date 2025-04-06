<?php
namespace App\Controllers;

use App\Models\Log;
use Core\Controller;
use App\Models\Auth;
use App\Models\Departement;
use App\Models\Employe;
use Exception;

class DepartementController extends Controller {
    
    public function index() {
        if (!Auth::isLoggedIn()) {
            $this->redirect('/auth/login');
        }
        
        $departements = Departement::getAll();
        return $this->view('departements/liste', [
            'title' => 'Liste des départements | Gestion technique',
            'pageTitle' => 'Liste des départements',
            'departements' => $departements,
        ], 'admin');
    }

    public function create() {
        if (!Auth::isLoggedIn()) {
            $this->redirect('/auth/login');
        }
        
        return $this->view('departements/ajouter', [
            'title' => 'Ajouter un département | Gestion technique',
            'pageTitle' => 'Ajouter un département'
        ], 'admin');
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return $this->redirect('/departements/create');
        }
        
        if (!Auth::isLoggedIn()) {
            $this->redirect('/auth/login');
        }

        $data = $_POST;
        $errors = [];

        // Validation des données
        if (empty($data['nom_departement'])) {
            $errors['nom_departement'] = "Le nom du département est requis.";
        }

        if (!empty($errors)) {
            return $this->view('departements/ajouter', [
                'title' => 'Ajouter un département | Gestion technique',
                'pageTitle' => 'Ajouter un département',
                'errors' => $errors, 
                'data' => $data
            ], 'admin');
        }

        $departementId = Departement::create($data);

        if (!$departementId) {
            error_log("Erreur lors de la création du département: " . $data['nom_departement']);
            $errors['creation'] = "Une erreur est survenue lors de la création du département.";
            
            return $this->view('departements/ajouter', [
                'title' => 'Ajouter un département | Gestion technique',
                'pageTitle' => 'Ajouter un département',
                'errors' => $errors, 
                'data' => $data
            ], 'admin');
        }

        return $this->redirect('/departements');
    }

    public function show($id) {
        if (!Auth::isLoggedIn()) {
            $this->redirect('/auth/login');
        }
        
        $departement = Departement::getById($id);
        if (!$departement) {
            $this->redirect('/departements');
        }
        
        // Récupérer les employés du département
        $employes = Departement::getWithEmployes($id);
        
        // Récupérer le matériel affecté au département
        $materiel = Departement::getWithMateriel($id);
        
        return $this->view('departements/details', [
            'title' => 'Détails du département | Gestion technique',
            'pageTitle' => 'Détails du département',
            'departement' => $departement,
            'employes' => $employes,
            'materiel' => $materiel
        ], 'admin');
    }

    public function edit($id) {
        if (!Auth::isLoggedIn()) {
            $this->redirect('/auth/login');
        }
        
        $departement = Departement::getById($id);
        if (!$departement) {
            $this->redirect('/departements');
        }
        
        return $this->view('departements/modifier', [
            'title' => 'Modifier le département | Gestion technique',
            'pageTitle' => 'Modifier le département',
            'departement' => $departement
        ], 'admin');
    }

    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return $this->redirect('/departements');
        }
        
        if (!Auth::isLoggedIn()) {
            $this->redirect('/auth/login');
        }

        $data = $_POST;
        $errors = [];

        // Validation des données
        if (empty($data['nom_departement'])) {
            $errors['nom_departement'] = "Le nom du département est requis.";
        }

        if (!empty($errors)) {
            $data['id_departement'] = $id;
            return $this->view('departements/modifier', [
                'title' => 'Modifier le département | Gestion technique',
                'pageTitle' => 'Modifier le département',
                'errors' => $errors, 
                'departement' => $data
            ], 'admin');
        }

        $updated = Departement::update($id, $data);

        if (!$updated) {
            error_log("Erreur lors de la mise à jour du département ID: " . $id);
            $errors['update'] = "Une erreur est survenue lors de la mise à jour du département.";
            
            $data['id_departement'] = $id;
            return $this->view('departements/modifier', [
                'title' => 'Modifier le département | Gestion technique',
                'pageTitle' => 'Modifier le département',
                'errors' => $errors, 
                'departement' => $data
            ], 'admin');
        }

        return $this->redirect('/departements/show/' . $id);
    }

    public function delete($id) {
        if (!Auth::isLoggedIn()) {
            $this->redirect('/auth/login');
        }

        // Vérifier si le département a des employés
        $nbEmployes = Departement::countEmployes($id);
        if ($nbEmployes > 0) {
            // Rediriger avec un message d'erreur
            $_SESSION['error_message'] = "Impossible de supprimer ce département car il contient des employés.";
            return $this->redirect('/departements');
        }

        // Vérifier si le département a du matériel affecté
        $materiel = Departement::getWithMateriel($id);
        if (!empty($materiel)) {
            // Rediriger avec un message d'erreur
            $_SESSION['error_message'] = "Impossible de supprimer ce département car il a du matériel affecté.";
            return $this->redirect('/departements');
        }

        $deleted = Departement::delete($id);

        if (!$deleted) {
            error_log("Erreur lors de la suppression du département ID: " . $id);
            $_SESSION['error_message'] = "Une erreur est survenue lors de la suppression du département.";
        } else {
            $_SESSION['success_message'] = "Département supprimé avec succès.";
        }

        return $this->redirect('/departements');
    }

    public function employes($id) {
        if (!Auth::isLoggedIn()) {
            $this->redirect('/auth/login');
        }
        
        $departement = Departement::getById($id);
        if (!$departement) {
            $this->redirect('/departements');
        }
        
        $employes = Employe::getByDepartement($id);
        
        return $this->view('departements/employes', [
            'title' => 'Employés du département | Gestion technique',
            'pageTitle' => 'Employés du département ' . $departement['nom_departement'],
            'departement' => $departement,
            'employes' => $employes
        ], 'admin');
    }

    public function search() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return $this->redirect('/departements');
        }
        
        if (!Auth::isLoggedIn()) {
            $this->redirect('/auth/login');
        }

        $searchTerm = $_POST['search'] ?? '';
        
        if (empty($searchTerm)) {
            return $this->redirect('/departements');
        }
        
        $db = \Core\Database::getInstance();
        $results = $db->fetchAll("SELECT * FROM departements WHERE nom_departement LIKE ? OR description LIKE ? ORDER BY nom_departement ASC", 
                                ["%{$searchTerm}%", "%{$searchTerm}%"]);
        
        return $this->view('departements/liste', [
            'title' => 'Résultats de recherche | Gestion technique',
            'pageTitle' => 'Résultats de recherche pour "' . $searchTerm . '"',
            'departements' => $results,
            'searchTerm' => $searchTerm
        ], 'admin');
    }
}
