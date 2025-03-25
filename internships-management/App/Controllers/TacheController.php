<?php 
namespace App\Controllers;

use Core\Controller;
use App\Models\Task;
use App\Models\Stagiaire;
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
}
