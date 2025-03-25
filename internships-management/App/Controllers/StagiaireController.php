<?php

namespace App\Controllers;

use App\Models\Stagiaire;
use Core\Controller;
use App\Models\User;

class StagiaireController extends Controller {
    // Création d'un stagiaire
    public function add() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $_POST;
            // Valider les données si nécessaire
            $stagiaireId = User::add($data);
            header("Location: /stagiaires");
        }
    }

    // Mise à jour des informations d'un stagiaire
    public function update($userId) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $_POST;
            // Mettre à jour les données
            User::update($userId, $data);
            // Rediriger ou afficher un message
            header("Location: /stagiaires/{$userId}");
        }
        // Afficher le formulaire de mise à jour avec les données existantes
        $stagiaire = User::getById($userId);
        require_once('views/stagiaires/edit.php');
    }

    // Suppression d'un stagiaire
    public function delete($userId) {
        User::delete($userId);
        // Rediriger vers la liste des stagiaires
        header("Location: /stagiaires");
    }

    // Afficher la liste des stagiaires
    public function index() {
        $stagiaires = Stagiaire::getAllStagiaires();
        require_once('views/stagiaires/index.php');
    }

    // Afficher les détails d'un stagiaire
    public function show($userId) {
        $user = User::getById($userId);
        $tasks = Stagiaire::getTaskHistory($user['stagiaire']['id']);
        require_once('views/stagiaires/show.php');
    }

}
