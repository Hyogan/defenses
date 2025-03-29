<?php 
namespace App\Controllers;

use Core\Controller;
use App\Models\Task;
use App\Models\Stagiaire;
use App\Models\Tuteur;
use App\Models\Tache;

class TacheController extends Controller{

    // Affectation d'une tâche à un stagiaire
    public function assign($stagiaireId) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $_POST;
            // Valider et affecter la tâche
            Tache::assignTaskToStagiaire($stagiaireId, $data);
            // Rediriger ou afficher un message
            header("Location: /stagiaires/{$stagiaireId}/tasks");
        }
        // Afficher le formulaire d'affectation de tâche
        require_once('views/missions/assign.php');
    }

    // Mise à jour du statut d'une tâche
    public function updateStatus($taskId) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $status = $_POST['status'];
            // Mettre à jour le statut de la tâche
            Tache::updateTaskStatus($taskId, $status);
            // Rediriger ou afficher un message
            header("Location: /missions/{$taskId}");
        }
        // Afficher le formulaire pour changer le statut de la tâche
        $task = Tache::getById($taskId);
        require_once('views/missions/update_status.php');
    }

    // Afficher l'historique des tâches d'un stagiaire
    public function history($stagiaireId) {
        $tasks = Tache::getByStagiaire($stagiaireId);
        require_once('views/missions/history.php');
    }
    
    // Afficher la liste des tâches
    public function index() {
        $taches = Tache::getAllWithDetails();
        $this->view('taches/index', ['taches' => $taches],"admin");
    }
    
    // Afficher le formulaire de création d'une tâche
    public function create() {
        // Récupérer la liste des stagiaires pour le formulaire
        $stagiaires = Stagiaire::getAllStagiaires();
        $tuteurs = Tuteur::getAll();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'titre' => $_POST['titre'],
                'description' => $_POST['description'],
                'stagiaire_id' => $_POST['stagiaire_id'],
                'tuteur_id' => $_POST['tuteur_id'] ?? 0,
                'date_limite' => $_POST['date_echeance'],
                'statut' => 'en cours',
                'pourcentage' => 0
            ];
            
            // Créer la tâche
            $tacheId = Tache::assignTaskToStagiaire($data['stagiaire_id'], $data);
            
            if ($tacheId) {
                $this->redirect('/taches');
            }
        }
        
        $this->view('taches/create', ['stagiaires' => $stagiaires]);
    }
    
    // Afficher le formulaire d'édition d'une tâche
    public function edit($id) {
        $tache = Tache::getById($id);
        
        if (!$tache) {
            // Rediriger si la tâche n'existe pas
            $this->redirect('/taches');
        }
        
        $stagiaires = Stagiaire::getAllStagiaires();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'titre' => $_POST['titre'],
                'description' => $_POST['description'],
                'stagiaire_id' => $_POST['stagiaire_id'],
                'tuteur_id' => $_POST['tuteur_id'] ?? $tache['tuteur_id'],
                'statut' => $_POST['statut'],
                'date_echeance' => $_POST['date_echeance'],
                'pourcentage' => $_POST['pourcentage'] ?? $tache['pourcentage']
            ];
            
            // Mettre à jour la tâche
            $db = \Core\Database::getInstance();
            $query = "UPDATE taches SET 
                      titre = ?, 
                      description = ?, 
                      stagiaire_id = ?, 
                      tuteur_id = ?, 
                      statut = ?, 
                      date_echeance = ?, 
                      pourcentage = ? 
                      WHERE id = ?";
            $params = [
                $data['titre'],
                $data['description'],
                $data['stagiaire_id'],
                $data['tuteur_id'],
                $data['statut'],
                $data['date_echeance'],
                $data['pourcentage'],
                $id
            ];
            
            $result = $db->query($query, $params);
            
            if ($result) {
                $this->redirect('/taches');
            }
        }
        
        $this->view('taches/edit', ['tache' => $tache, 'stagiaires' => $stagiaires]);
    }
    
    // Afficher les détails d'une tâche
    public function show($id) {
        $tache = Tache::getById($id);
        
        if (!$tache) {
            $this->redirect('/taches');
        }
        
        $this->view('taches/show', ['tache' => $tache]);
    }
    
    // Supprimer une tâche
    public function delete($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $db = \Core\Database::getInstance();
            $result = $db->query("DELETE FROM taches WHERE id = ?", [$id]);
            
            if ($result) {
                $this->redirect('/taches');
            }
        }
        
        $tache = Tache::getById($id);
        $this->view('taches/delete', ['tache' => $tache]);
    }
}
