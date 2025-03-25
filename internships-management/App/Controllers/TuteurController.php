<?php 
namespace App\Controllers;

use Core\Controller;
use App\Models\Tuteur;
use App\Models\User;

class TuteurController extends Controller{

    // Création d'un tuteur
    public function add() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $_POST;
            // Valider les données si nécessaire
            if(!$data['role']) {
                $data = 'tuteur';
            }
            $tuteurId = User::add($data);
            // Rediriger ou afficher un message
            header("Location: /tuteurs");
        }
    }

    // Mise à jour des informations d'un tuteur
    public function update($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $_POST;
            // Mettre à jour les données
            User::update($id, $data);
            // Rediriger ou afficher un message
            header("Location: /tuteurs/{$id}");
        }
        // Afficher le formulaire de mise à jour avec les données existantes
        $tuteur = User::getById($id);
        require_once('views/tuteurs/edit.php');
    }

    // Affectation d'un tuteur à un stagiaire
    public function assign($stagiaireId) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tuteurIds = $_POST['tuteurs'];
            // Affecter les tuteurs
            Tuteur::assignToStagiaire($stagiaireId, $tuteurIds);
            // Rediriger ou afficher un message
            header("Location: /stagiaires/{$stagiaireId}");
        }
        $tuteurs = Tuteur::getAll();
        require_once('views/stagiaires/assign_tuteurs.php');
    }

    // Afficher la liste des tuteurs
    public function index() {
        $tuteurs = Tuteur::getAll();
        require_once('views/tuteurs/index.php');
    }

    // Afficher les détails d'un tuteur
    public function show($userId) {
        $tuteur = User::getById($userId);
        require_once('views/tuteurs/show.php');
    }
}
