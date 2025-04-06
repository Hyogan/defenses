<?php
namespace App\Controllers;

use App\Models\Log;
use Core\Controller;
use App\Models\Auth;
use App\Models\Poste;
use App\Models\Departement;
use App\Models\Employe;
use Exception;

class PosteController extends Controller {
    
    public function index() {
        if (!Auth::isLoggedIn()) {
            $this->redirect('/auth/login');
        }
        
        $postes = Poste::getAll();
        return $this->view('postes/liste', [
            'title' => 'Liste des postes | Gestion technique',
            'pageTitle' => 'Liste des postes',
            'postes' => $postes,
        ], 'admin');
    }

    public function create() {
        if (!Auth::isLoggedIn()) {
            $this->redirect('/auth/login');
        }
        
        // Récupérer les départements pour le formulaire
        $departements = Departement::getAll();
        
        return $this->view('postes/ajouter', [
            'title' => 'Ajouter un poste | Gestion technique',
            'pageTitle' => 'Ajouter un poste',
            'departements' => $departements
        ], 'admin');
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return $this->redirect('/postes/create');
        }
        
        if (!Auth::isLoggedIn()) {
            $this->redirect('/auth/login');
        }

        $data = $_POST;
        $errors = [];

        // Validation des données
        if (empty($data['titre_poste'])) {
            $errors['titre_poste'] = "Le titre du poste est requis.";
        }
        
        if (!empty($data['niveau_hierarchique']) && !is_numeric($data['niveau_hierarchique'])) {
            $errors['niveau_hierarchique'] = "Le niveau hiérarchique doit être un nombre.";
        }
        
        if (!empty($data['salaire_min']) && !is_numeric($data['salaire_min'])) {
            $errors['salaire_min'] = "Le salaire minimum doit être un nombre.";
        }
        
        if (!empty($data['salaire_max']) && !is_numeric($data['salaire_max'])) {
            $errors['salaire_max'] = "Le salaire maximum doit être un nombre.";
        }
        
        if (!empty($data['salaire_min']) && !empty($data['salaire_max']) && 
            $data['salaire_min'] > $data['salaire_max']) {
            $errors['salaire_max'] = "Le salaire maximum doit être supérieur au salaire minimum.";
        }

        if (!empty($errors)) {
            // Récupérer les départements pour le formulaire
            $departements = Departement::getAll();
            
            return $this->view('postes/ajouter', [
                'title' => 'Ajouter un poste | Gestion technique',
                'pageTitle' => 'Ajouter un poste',
                'errors' => $errors, 
                'data' => $data,
                'departements' => $departements
            ], 'admin');
        }

        $posteId = Poste::create($data);

        if (!$posteId) {
            error_log("Erreur lors de la création du poste: " . $data['titre_poste']);
            $errors['creation'] = "Une erreur est survenue lors de la création du poste.";
            
            // Récupérer les départements pour le formulaire
            $departements = Departement::getAll();
            
            return $this->view('postes/ajouter', [
                'title' => 'Ajouter un poste | Gestion technique',
                'pageTitle' => 'Ajouter un poste',
                'errors' => $errors, 
                'data' => $data,
                'departements' => $departements
            ], 'admin');
        }

        return $this->redirect('/postes');
    }

    public function show($id) {
        if (!Auth::isLoggedIn()) {
            $this->redirect('/auth/login');
        }
        
        $poste = Poste::getById($id);
        if (!$poste) {
            $this->redirect('/postes');
        }
        
        // Récupérer les employés ayant ce poste
        $employes = Poste::getWithEmployes($id);
        
        return $this->view('postes/details', [
            'title' => 'Détails du poste | Gestion technique',
            'pageTitle' => 'Détails du poste',
            'poste' => $poste,
            'employes' => $employes
        ], 'admin');
    }

    public function edit($id) {
        if (!Auth::isLoggedIn()) {
            $this->redirect('/auth/login');
        }
        
        $poste = Poste::getById($id);
        if (!$poste) {
            $this->redirect('/postes');
        }
        
        // Récupérer les départements pour le formulaire
        $departements = Departement::getAll();
        
        return $this->view('postes/modifier', [
            'title' => 'Modifier le poste | Gestion technique',
            'pageTitle' => 'Modifier le poste',
            'poste' => $poste,
            'departements' => $departements
        ], 'admin');
    }

    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return $this->redirect('/postes');
        }
        
        if (!Auth::isLoggedIn()) {
            $this->redirect('/auth/login');
        }

        $data = $_POST;
        $errors = [];

        // Validation des données
        if (empty($data['titre_poste'])) {
            $errors['titre_poste'] = "Le titre du poste est requis.";
        }
        
        if (!empty($data['niveau_hierarchique']) && !is_numeric($data['niveau_hierarchique'])) {
            $errors['niveau_hierarchique'] = "Le niveau hiérarchique doit être un nombre.";
        }
        
        if (!empty($data['salaire_min']) && !is_numeric($data['salaire_min'])) {
            $errors['salaire_min'] = "Le salaire minimum doit être un nombre.";
        }
        
        if (!empty($data['salaire_max']) && !is_numeric($data['salaire_max'])) {
            $errors['salaire_max'] = "Le salaire maximum doit être un nombre.";
        }
        
        if (!empty($data['salaire_min']) && !empty($data['salaire_max']) && 
            $data['salaire_min'] > $data['salaire_max']) {
            $errors['salaire_max'] = "Le salaire maximum doit être supérieur au salaire minimum.";
        }

        if (!empty($errors)) {
            // Récupérer les départements pour le formulaire
            $departements = Departement::getAll();
            
            $data['id_poste'] = $id;
            return $this->view('postes/modifier', [
                'title' => 'Modifier le poste | Gestion technique',
                'pageTitle' => 'Modifier le poste',
                'errors' => $errors, 
                'poste' => $data,
                'departements' => $departements
            ], 'admin');
        }

        $updated = Poste::update($id, $data);

        if (!$updated) {
            error_log("Erreur lors de la mise à jour du poste ID: " . $id);
            $errors['update'] = "Une erreur est survenue lors de la mise à jour du poste.";
            
            // Récupérer les départements pour le formulaire
            $departements = Departement::getAll();
            
            $data['id_poste'] = $id;
            return $this->view('postes/modifier', [
                'title' => 'Modifier le poste | Gestion technique',
                'pageTitle' => 'Modifier le poste',
                'errors' => $errors, 
                'poste' => $data,
                'departements' => $departements
            ], 'admin');
        }

        return $this->redirect('/postes/show/' . $id);
    }

    public function delete($id) {
        if (!Auth::isLoggedIn()) {
            $this->redirect('/auth/login');
        }

        // Vérifier si le poste a des employés
        $nbEmployes = Poste::countEmployes($id);
        if ($nbEmployes > 0) {
            // Rediriger avec un message d'erreur
            $_SESSION['error_message'] = "Impossible de supprimer ce poste car il est attribué à des employés.";
            return $this->redirect('/postes');
        }

        $deleted = Poste::delete($id);

        if (!$deleted) {
            error_log("Erreur lors de la suppression du poste ID: " . $id);
            $_SESSION['error_message'] = "Une erreur est survenue lors de la suppression du poste.";
        } else {
            $_SESSION['success_message'] = "Poste supprimé avec succès.";
        }

        return $this->redirect('/postes');
    }

    public function employes($id) {
        if (!Auth::isLoggedIn()) {
            $this->redirect('/auth/login');
        }
        
        $poste = Poste::getById($id);
        if (!$poste) {
            $this->redirect('/postes');
        }
        
        $employes = Employe::getByPoste($id);
        
        return $this->view('postes/employes', [
            'title' => 'Employés au poste | Gestion technique',
            'pageTitle' => 'Employés au poste de ' . $poste['titre_poste'],
            'poste' => $poste,
            'employes' => $employes
        ], 'admin');
    }

    public function search() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return $this->redirect('/postes');
        }
        
        if (!Auth::isLoggedIn()) {
            $this->redirect('/auth/login');
        }

        $searchTerm = $_POST['search'] ?? '';
        
        if (empty($searchTerm)) {
            return $this->redirect('/postes');
        }
        
        $db = \Core\Database::getInstance();
        $results = $db->fetchAll("SELECT p.*, d.nom_departement FROM postes p 
                                 LEFT JOIN departements d ON p.id_departement = d.id_departement 
                                 WHERE p.titre_poste LIKE ? OR p.description LIKE ? 
                                 ORDER BY p.titre_poste ASC", 
                                ["%{$searchTerm}%", "%{$searchTerm}%"]);
        
        return $this->view('postes/liste', [
            'title' => 'Résultats de recherche | Gestion technique',
            'pageTitle' => 'Résultats de recherche pour "' . $searchTerm . '"',
            'postes' => $results,
            'searchTerm' => $searchTerm
        ], 'admin');
    }

    public function byDepartement($departementId) {
        if (!Auth::isLoggedIn()) {
            $this->redirect('/auth/login');
        }
        
        $departement = Departement::getById($departementId);
        if (!$departement) {
            $this->redirect('/departements');
        }
        
        $postes = Poste::getByDepartement($departementId);
        
        return $this->view('postes/liste', [
            'title' => 'Postes du département | Gestion technique',
            'pageTitle' => 'Postes du département ' . $departement['nom_departement'],
            'postes' => $postes,
            'departement' => $departement
        ], 'admin');
    }
}
