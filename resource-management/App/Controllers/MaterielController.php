<?php
namespace App\Controllers;

use App\Models\Log;
use Core\Controller;
use App\Models\Auth;
use App\Models\Materiel;
use App\Models\Employe;
use App\Models\Departement;
use Exception;

class MaterielController extends Controller {
    
    public function index() {
        if (!Auth::isLoggedIn()) {
            $this->redirect('/auth/login');
        }
        
        $allMateriel = Materiel::getAll();
        return $this->view('materiel/liste', [
            'title' => 'Liste du matériel | Gestion technique',
            'pageTitle' => 'Liste du matériel',
            'materiel' => $allMateriel,
        ], 'admin');
    }

    public function create() {
        if (!Auth::isLoggedIn()) {
            $this->redirect('/auth/login');
        }
        
        // Récupérer les catégories pour le formulaire
        $db = \Core\Database::getInstance();
        $categories = $db->fetchAll("SELECT * FROM categories_materiel ORDER BY nom_categorie ASC");
        
        return $this->view('materiel/ajouter', [
            'title' => 'Ajouter du matériel | Gestion technique',
            'pageTitle' => 'Ajouter du matériel',
            'categories' => $categories
        ], 'admin');
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return $this->redirect('/materiel/create');
        }
        
        if (!Auth::isLoggedIn()) {
            $this->redirect('/auth/login');
        }

        $data = $_POST;
        $errors = [];

        // Validation des données
        if (empty($data['nom_materiel'])) {
            $errors['nom_materiel'] = "Le nom du matériel est requis.";
        }
        
        if (!empty($data['numero_serie'])) {
            // Vérifier si le numéro de série existe déjà
            $existingMateriel = Materiel::getByNumeroSerie($data['numero_serie']);
            if ($existingMateriel) {
                $errors['numero_serie'] = "Ce numéro de série existe déjà.";
            }
        }
        
        if (!empty($data['etat']) && !in_array($data['etat'], ['neuf', 'bon', 'moyen', 'mauvais', 'hors service'])) {
            $errors['etat'] = "État invalide.";
        }
        
        if (!empty($data['valeur_achat']) && !is_numeric($data['valeur_achat'])) {
            $errors['valeur_achat'] = "La valeur d'achat doit être un nombre.";
        }

        if (!empty($errors)) {
            // Récupérer les catégories pour le formulaire
            $db = \Core\Database::getInstance();
            $categories = $db->fetchAll("SELECT * FROM categories_materiel ORDER BY nom_categorie ASC");
            
            return $this->view('materiel/ajouter', [
                'title' => 'Ajouter du matériel | Gestion technique',
                'pageTitle' => 'Ajouter du matériel',
                'errors' => $errors, 
                'data' => $data,
                'categories' => $categories
            ], 'admin');
        }

        $materielId = Materiel::create($data);

        if (!$materielId) {
            error_log("Erreur lors de la création du matériel: " . $data['nom_materiel']);
            $errors['creation'] = "Une erreur est survenue lors de la création du matériel.";
            
            // Récupérer les catégories pour le formulaire
            $db = \Core\Database::getInstance();
            $categories = $db->fetchAll("SELECT * FROM categories_materiel ORDER BY nom_categorie ASC");
            
            return $this->view('materiel/ajouter', [
                'title' => 'Ajouter du matériel | Gestion technique',
                'pageTitle' => 'Ajouter du matériel',
                'errors' => $errors, 
                'data' => $data,
                'categories' => $categories
            ], 'admin');
        }

        return $this->redirect('/materiel');
    }

    public function show($id) {
        if (!Auth::isLoggedIn()) {
            $this->redirect('/auth/login');
        }
        
        $materiel = Materiel::getWithAffectation($id);
        if (!$materiel) {
            $this->redirect('/materiel');
        }
        
        // Récupérer l'historique du matériel
        $historique = Materiel::getHistorique($id);
        
        // Récupérer l'historique de maintenance
        $maintenances = Materiel::getMaintenanceHistory($id);
        
        return $this->view('materiel/details', [
            'title' => 'Détails du matériel | Gestion technique',
            'pageTitle' => 'Détails du matériel',
            'materiel' => $materiel,
            'historique' => $historique,
            'maintenances' => $maintenances
        ], 'admin');
    }

    public function edit($id) {
        if (!Auth::isLoggedIn()) {
            $this->redirect('/auth/login');
        }
        
        $materiel = Materiel::getById($id);
        if (!$materiel) {
            $this->redirect('/materiel');
        }
        
        // Récupérer les catégories pour le formulaire
        $db = \Core\Database::getInstance();
        $categories = $db->fetchAll("SELECT * FROM categories_materiel ORDER BY nom_categorie ASC");
        
        return $this->view('materiel/modifier', [
            'title' => 'Modifier le matériel | Gestion technique',
            'pageTitle' => 'Modifier le matériel',
            'materiel' => $materiel,
            'categories' => $categories
        ], 'admin');
    }

    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return $this->redirect('/materiel');
        }
        
        if (!Auth::isLoggedIn()) {
            $this->redirect('/auth/login');
        }

        $data = $_POST;
        $errors = [];

        // Validation des données
        if (empty($data['nom_materiel'])) {
            $errors['nom_materiel'] = "Le nom du matériel est requis.";
        }
        
        if (!empty($data['numero_serie'])) {
            // Vérifier si le numéro de série existe déjà (sauf pour ce matériel)
            $existingMateriel = Materiel::getByNumeroSerie($data['numero_serie']);
            if ($existingMateriel && $existingMateriel['id_materiel'] != $id) {
                $errors['numero_serie'] = "Ce numéro de série existe déjà.";
            }
        }
        
        if (!empty($data['etat']) && !in_array($data['etat'], ['neuf', 'bon', 'moyen', 'mauvais', 'hors service'])) {
            $errors['etat'] = "État invalide.";
        }
        
        if (!empty($data['valeur_achat']) && !is_numeric($data['valeur_achat'])) {
            $errors['valeur_achat'] = "La valeur d'achat doit être un nombre.";
        }

        if (!empty($errors)) {
            // Récupérer les catégories pour le formulaire
            $db = \Core\Database::getInstance();
            $categories = $db->fetchAll("SELECT * FROM categories_materiel ORDER BY nom_categorie ASC");
            
            $data['id_materiel'] = $id;
            return $this->view('materiel/modifier', [
                'title' => 'Modifier le matériel | Gestion technique',
                'pageTitle' => 'Modifier le matériel',
                'errors' => $errors, 
                'materiel' => $data,
                'categories' => $categories
            ], 'admin');
        }

        $updated = Materiel::update($id, $data);

        if (!$updated) {
            error_log("Erreur lors de la mise à jour du matériel ID: " . $id);
            $errors['update'] = "Une erreur est survenue lors de la mise à jour du matériel.";
            
            // Récupérer les catégories pour le formulaire
            $db = \Core\Database::getInstance();
            $categories = $db->fetchAll("SELECT * FROM categories_materiel ORDER BY nom_categorie ASC");
            
            $data['id_materiel'] = $id;
            return $this->view('materiel/modifier', [
                'title' => 'Modifier le matériel | Gestion technique',
                'pageTitle' => 'Modifier le matériel',
                'errors' => $errors, 
                'materiel' => $data,
                'categories' => $categories
            ], 'admin');
        }

        return $this->redirect('/materiel/show/' . $id);
    }

    public function delete($id) {
        if (!Auth::isLoggedIn()) {
            $this->redirect('/auth/login');
        }

        // Vérifier si le matériel est actuellement affecté
        $materiel = Materiel::getWithAffectation($id);
        if ($materiel && isset($materiel['id_affectation'])) {
            // Rediriger avec un message d'erreur
            $_SESSION['error_message'] = "Impossible de supprimer ce matériel car il est actuellement affecté.";
            return $this->redirect('/materiel');
        }

        $deleted = Materiel::delete($id);

        if (!$deleted) {
            error_log("Erreur lors de la suppression du matériel ID: " . $id);
            $_SESSION['error_message'] = "Une erreur est survenue lors de la suppression du matériel.";
        } else {
            $_SESSION['success_message'] = "Matériel supprimé avec succès.";
        }

        return $this->redirect('/materiel');
    }

    public function search() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return $this->redirect('/materiel');
        }
        
        if (!Auth::isLoggedIn()) {
            $this->redirect('/auth/login');
        }

        $criteria = $_POST;
        $results = Materiel::search($criteria);
        
        // Récupérer les catégories pour le formulaire de recherche
        $db = \Core\Database::getInstance();
        $categories = $db->fetchAll("SELECT * FROM categories_materiel ORDER BY nom_categorie ASC");
        
        return $this->view('materiel/liste', [
            'title' => 'Résultats de recherche | Gestion technique',
            'pageTitle' => 'Résultats de recherche',
            'materiel' => $results,
            'searchCriteria' => $criteria,
            'categories' => $categories
        ], 'admin');
    }

    public function affecterForm($id) {
        if (!Auth::isLoggedIn()) {
            $this->redirect('/auth/login');
        }
        
        $materiel = Materiel::getById($id);
        if (!$materiel) {
            $this->redirect('/materiel');
        }
        
        // Vérifier si le matériel est déjà affecté
        $affectation = Materiel::getWithAffectation($id);
        if ($affectation && isset($affectation['id_affectation'])) {
            $_SESSION['error_message'] = "Ce matériel est déjà affecté.";
            return $this->redirect('/materiel/show/' . $id);
        }
        
        // Récupérer la liste des employés et départements pour le formulaire
        $employes = Employe::getAll();
        $departements = Departement::getAll();
        
        return $this->view('materiel/affecter', [
            'title' => 'Affecter le matériel | Gestion technique',
            'pageTitle' => 'Affecter le matériel',
            'materiel' => $materiel,
            'employes' => $employes,
            'departements' => $departements
        ], 'admin');
    }

    public function affecter($id) {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return $this->redirect('/materiel/show/' . $id);
        }
        
        if (!Auth::isLoggedIn()) {
            $this->redirect('/auth/login');
        }

        $data = $_POST;
        $errors = [];

        // Validation des données
        if (empty($data['type_affectation'])) {
            $errors['type_affectation'] = "Veuillez sélectionner un type d'affectation.";
        } elseif ($data['type_affectation'] == 'employe' && empty($data['id_employe'])) {
            $errors['id_employe'] = "Veuillez sélectionner un employé.";
        } elseif ($data['type_affectation'] == 'departement' && empty($data['id_departement'])) {
            $errors['id_departement'] = "Veuillez sélectionner un département.";
        }

        if (!empty($errors)) {
            // Récupérer la liste des employés et départements pour le formulaire
            $employes = Employe::getAll();
            $departements = Departement::getAll();
            $materiel = Materiel::getById($id);
            
            return $this->view('materiel/affecter', [
                'title' => 'Affecter le matériel | Gestion technique',
                'pageTitle' => 'Affecter le matériel',
                'errors' => $errors, 
                'data' => $data,
                'materiel' => $materiel,
                'employes' => $employes,
                'departements' => $departements
            ], 'admin');
        }

        // Préparer les données d'affectation
        $affectationData = [
            'commentaires' => $data['commentaires'] ?? null
        ];
        
        if ($data['type_affectation'] == 'employe') {
            $affectationData['id_employe'] = $data['id_employe'];
            $affectationData['id_departement'] = null;
        } else {
            $affectationData['id_employe'] = null;
            $affectationData['id_departement'] = $data['id_departement'];
        }

        try {
            $affectationId = Materiel::affecter($id, $affectationData);
            $_SESSION['success_message'] = "Matériel affecté avec succès.";
            return $this->redirect('/materiel/show/' . $id);
        } catch (Exception $e) {
            error_log("Erreur lors de l'affectation du matériel ID: " . $id . " - " . $e->getMessage());
            
            // Récupérer la liste des employés et départements pour le formulaire
            $employes = Employe::getAll();
            $departements = Departement::getAll();
            $materiel = Materiel::getById($id);
            
            return $this->view('materiel/affecter', [
                'title' => 'Affecter le matériel | Gestion technique',
                'pageTitle' => 'Affecter le matériel',
                'errors' => ['affectation' => $e->getMessage()], 
                'data' => $data,
                'materiel' => $materiel,
                'employes' => $employes,
                'departements' => $departements
            ], 'admin');
        }
    }

    public function retourner($affectationId) {
        if (!Auth::isLoggedIn()) {
            $this->redirect('/auth/login');
        }

        // Récupérer les informations de l'affectation
        $db = \Core\Database::getInstance();
        $affectation = $db->fetch("SELECT * FROM affectations_materiel WHERE id_affectation = ?", [$affectationId]);
        
        if (!$affectation) {
            $_SESSION['error_message'] = "Affectation non trouvée.";
            return $this->redirect('/materiel');
        }
        
        $materielId = $affectation['id_materiel'];
        
        // Si c'est une requête POST, traiter le retour
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $commentaires = $_POST['commentaires'] ?? null;
            
            try {
                Materiel::retourner($affectationId, $commentaires);
                $_SESSION['success_message'] = "Matériel retourné avec succès.";
            } catch (Exception $e) {
                error_log("Erreur lors du retour du matériel - Affectation ID: " . $affectationId . " - " . $e->getMessage());
                $_SESSION['error_message'] = $e->getMessage();
            }
            
            return $this->redirect('/materiel/show/' . $materielId);
        }
        
        // Sinon, afficher le formulaire de retour
        $materiel = Materiel::getById($materielId);
        
        return $this->view('materiel/retourner', [
            'title' => 'Retourner le matériel | Gestion technique',
            'pageTitle' => 'Retourner le matériel',
            'materiel' => $materiel,
            'affectation' => $affectation
        ], 'admin');
    }

    public function planifierMaintenanceForm($id) {
        if (!Auth::isLoggedIn()) {
            $this->redirect('/auth/login');
        }
        
        $materiel = Materiel::getById($id);
        if (!$materiel) {
            $this->redirect('/materiel');
        }
        
        return $this->view('materiel/planifier_maintenance', [
            'title' => 'Planifier une maintenance | Gestion technique',
            'pageTitle' => 'Planifier une maintenance',
            'materiel' => $materiel
        ], 'admin');
    }

    public function planifierMaintenance($id) {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return $this->redirect('/materiel/show/' . $id);
        }
        
        if (!Auth::isLoggedIn()) {
            $this->redirect('/auth/login');
        }

        $data = $_POST;
        $errors = [];

        // Validation des données
        if (empty($data['type_maintenance']) || !in_array($data['type_maintenance'], ['preventive', 'corrective', 'mise a jour'])) {
            $errors['type_maintenance'] = "Type de maintenance invalide.";
        }
        
        if (empty($data['date_maintenance'])) {
            $errors['date_maintenance'] = "La date de maintenance est requise.";
        }
        
        if (!empty($data['cout']) && !is_numeric($data['cout'])) {
            $errors['cout'] = "Le coût doit être un nombre.";
        }

        if (!empty($errors)) {
            $materiel = Materiel::getById($id);
            
            return $this->view('materiel/planifier_maintenance', [
                'title' => 'Planifier une maintenance | Gestion technique',
                'pageTitle' => 'Planifier une maintenance',
                'errors' => $errors, 
                'data' => $data,
                'materiel' => $materiel
            ], 'admin');
        }

        try {
            $maintenanceId = Materiel::planifierMaintenance($id, $data);
            $_SESSION['success_message'] = "Maintenance planifiée avec succès.";
            return $this->redirect('/materiel/show/' . $id);
        } catch (Exception $e) {
            error_log("Erreur lors de la planification de maintenance - Matériel ID: " . $id . " - " . $e->getMessage());
            
            $materiel = Materiel::getById($id);
            
            return $this->view('materiel/planifier_maintenance', [
                'title' => 'Planifier une maintenance | Gestion technique',
                'pageTitle' => 'Planifier une maintenance',
                'errors' => ['maintenance' => $e->getMessage()], 
                'data' => $data,
                'materiel' => $materiel
            ], 'admin');
        }
    }

    public function updateMaintenanceStatus($maintenanceId) {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return $this->redirect('/materiel');
        }
        
        if (!Auth::isLoggedIn()) {
            $this->redirect('/auth/login');
        }

        $data = $_POST;
        
        // Récupérer les informations de la maintenance
        $db = \Core\Database::getInstance();
        $maintenance = $db->fetch("SELECT * FROM maintenance_materiel WHERE id_maintenance = ?", [$maintenanceId]);
        
        if (!$maintenance) {
            $_SESSION['error_message'] = "Maintenance non trouvée.";
            return $this->redirect('/materiel');
        }
        
        $materielId = $maintenance['id_materiel'];
        
        // Validation des données
        if (empty($data['statut']) || !in_array($data['statut'], ['planifiee', 'en cours', 'terminee', 'annulee'])) {
            $_SESSION['error_message'] = "Statut de maintenance invalide.";
            return $this->redirect('/materiel/show/' . $materielId);
        }

        try {
            Materiel::updateMaintenanceStatus($maintenanceId, $data['statut'], $data['commentaires'] ?? null);
            $_SESSION['success_message'] = "Statut de maintenance mis à jour avec succès.";
        } catch (Exception $e) {
            error_log("Erreur lors de la mise à jour du statut de maintenance - ID: " . $maintenanceId . " - " . $e->getMessage());
            $_SESSION['error_message'] = $e->getMessage();
        }
        
        return $this->redirect('/materiel/show/' . $materielId);
    }

    public function disponible() {
        if (!Auth::isLoggedIn()) {
            $this->redirect('/auth/login');
        }
        
        $materielDisponible = Materiel::getDisponible();
        
        return $this->view('materiel/disponible', [
            'title' => 'Matériel disponible | Gestion technique',
            'pageTitle' => 'Matériel disponible',
            'materiel' => $materielDisponible
        ], 'admin');
    }

    public function statistiques() {
        if (!Auth::isLoggedIn()) {
            $this->redirect('/auth/login');
        }
        
        $statsByCategorie = Materiel::countByCategorie();
        $statsByEtat = Materiel::countByEtat();
        $totalValue = Materiel::getTotalValue();
        
        // Récupérer le nombre total de matériel
        $db = \Core\Database::getInstance();
        $totalMateriel = $db->fetch("SELECT COUNT(*) as total FROM materiel")['total'];
        
        // Récupérer le nombre de matériel affecté
        $materielAffecte = $db->fetch("SELECT COUNT(DISTINCT id_materiel) as total FROM affectations_materiel WHERE statut = 'en cours'")['total'];
        
        return $this->view('materiel/statistiques', [
            'title' => 'Statistiques du matériel | Gestion technique',
            'pageTitle' => 'Statistiques du matériel',
            'statsByCategorie' => $statsByCategorie,
            'statsByEtat' => $statsByEtat,
            'totalValue' => $totalValue,
            'totalMateriel' => $totalMateriel,
            'materielAffecte' => $materielAffecte,
            'materielDisponible' => $totalMateriel - $materielAffecte
        ], 'admin');
    }
}
