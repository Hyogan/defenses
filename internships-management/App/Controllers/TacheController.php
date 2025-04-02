<?php 
namespace App\Controllers;

use App\Models\Auth;
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
            return $this->redirect("/stagiaires/{$stagiaireId}/tasks");
        }
        // Afficher le formulaire d'affectation de tâche
        return $this->redirect('taches/');
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
        $role = Auth::getUserType();
        $tuteur = ($role == 'tuteur' ?  Tuteur::getByUserId(Auth::id()) : null);
        $tuteur_id = $tuteur['id'];
        $stagiaires = $role == 'tuteur'
                            ? $stagiaires = Stagiaire::getByTuteurId( $tuteur_id)
                            : $stagiaires = Stagiaire::getAllStagiaires();
        // dd($taches);
        $this->view('taches/index', 
        ['taches' => $taches,'stagiaires' => $stagiaires],
        "admin");
    }

    public function create() 
    {
        $role = Auth::getUserType();
        $tuteurs = Tuteur::getAll();
        $role = Auth::getUserType();
        $tuteur = ($role == 'tuteur' ?  Tuteur::getByUserId(Auth::id()) : null);
        $tuteur_id = $tuteur['id'];
        $stagiaires = $role == 'tuteur'
                            ? $stagiaires = Stagiaire::getByTuteurId(tuteurId: $tuteur_id)
                            : $stagiaires = Stagiaire::getAllStagiaires();
        // dd($tuteur);
        return $this->view('taches/create',[
          'stagiaires' => $stagiaires,
          'tuteurs' => $tuteurs,
          'role' => $role,
          'tuteur_id' => $tuteur_id
        ],'admin');
    }
    
    // Afficher le formulaire de création d'une tâche
    public function store() {
      // Récupérer la liste des stagiaires pour le formulaire
      $stagiaires = Stagiaire::getAllStagiaires();
      $tuteurs = Tuteur::getAll();
      $role = Auth::getUserType();
      $tuteur_id = $role == 'tuteur' ?  Tuteur::getByUserId(Auth::id()) : null;
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          $data = [
              'titre' => $_POST['titre'],
              'description' => $_POST['description'],
              'stagiaire_id' => $_POST['stagiaire_id'],
              'tuteur_id' => $_POST['tuteur_id'] ?? 0,
              'date_limite' => $_POST['date_limite'],
              'statut' => 'en cours',
              'pourcentage' => 0
          ];
          // dd($data);
          // Validation des données (comme précédemment)
          $erreurs = [];
          foreach ($data as $key => $valeur) {
              if (empty($valeur) && $key != 'pourcentage') {
                  $erreurs[] = "Le champ '$key' est obligatoire.";
              }
          }
  
          if (!empty($erreurs)) {
              return $this->view("taches/create",
                  [
                      "erreurs" => $erreurs,
                      'stagiaires' => $stagiaires,
                      'tuteurs' => $tuteurs,
                      'role' => $role,
                      'tuteur_id' => $tuteur_id
                  ], "admin"
              );
          }
          // Créer la tâche
          $tacheId = Tache::assignTaskToStagiaire($data['stagiaire_id'], $data);
          if ($tacheId) {
              $this->redirect('/taches');
          }
      }
      $this->view('taches/create', ['stagiaires' => $stagiaires, 'tuteurs' => $tuteurs]);
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
