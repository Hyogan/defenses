<?php

namespace App\Controllers;

use App\Models\Evaluation;
use App\Models\User;
use App\Models\Stagiaire;
use Core\Controller;

class EvaluationController extends Controller {
    
    // Affiche la liste des évaluations pour un stagiaire
    public function index($stagiaireId) {
        $evaluations = Evaluation::getByStagiaire($stagiaireId);
        
        // On récupère les stagiaires pour afficher leurs informations dans la vue
        $stagiaire = Stagiaire::getById($stagiaireId);
        
        // On charge la vue avec les évaluations et les informations du stagiaire
        return $this->view('evaluations/index', [
            'stagiaire' => $stagiaire,
            'evaluations' => $evaluations
        ]);
    }

    // Affiche le formulaire pour ajouter une nouvelle évaluation
    public function ajouter($stagiaireId) {
        // Vérifie si l'utilisateur est un tuteur ou un superviseur pour ajouter une évaluation
        if ($_SESSION['role'] !== 'tuteur' && $_SESSION['role'] !== 'superviseur') {
            return $this->redirect('/login');
        }

        // Récupère le stagiaire pour pré-remplir le formulaire si nécessaire
        $stagiaire = Stagiaire::getById($stagiaireId);

        // Affiche la vue du formulaire d'ajout
        return $this->view('evaluations/ajouter', [
            'stagiaire' => $stagiaire
        ]);
    }

    // Enregistre une nouvelle évaluation pour un stagiaire
    public function store($stagiaireId) {
        // Vérifie si l'utilisateur est un tuteur ou un superviseur
        if ($_SESSION['role'] !== 'tuteur' && $_SESSION['role'] !== 'superviseur') {
            return $this->redirect('/login');
        }

        // Récupère les données envoyées via le formulaire
        $data = $_POST;
        $data['stagiaire_id'] = $stagiaireId;
        $data['tuteur_id'] = $_SESSION['user_id'];
        
        // Validation simple des données
        if (empty($data['note']) || empty($data['commentaire'])) {
            return $this->view('evaluations/ajouter', [
                'error' => 'Tous les champs doivent être remplis.',
                'stagiaire' => Stagiaire::getById($stagiaireId)
            ]);
        }

        // Crée l'évaluation et l'enregistre dans la base de données
        $evaluation = Evaluation::add($data);
        // $evaluation->save();
        
        // Redirige vers la liste des évaluations après enregistrement
        return $this->redirect("/stagiaire/{$stagiaireId}/evaluations");
    }

    // Affiche le formulaire pour modifier une évaluation existante
    public function modifier($evaluationId) {
        // Récupère l'évaluation existante
        $evaluation = Evaluation::getById($evaluationId);
        $stagiaire = Stagiaire::getById($evaluation['stagiaire_id']);

        // Vérifie si l'utilisateur est autorisé à modifier l'évaluation (tuteur ou superviseur)
        if ($_SESSION['role'] !== 'tuteur' && $_SESSION['role'] !== 'superviseur') {
            return $this->redirect('/login');
        }

        // Charge la vue du formulaire de modification
        return $this->view('evaluations/modifier', [
            'evaluation' => $evaluation,
            'stagiaire' => $stagiaire
        ]);
    }

    // Met à jour une évaluation existante
    // public function update($evaluationId) {
    //     // Récupère l'évaluation à modifier
    //     $evaluation = Evaluation::getById($evaluationId);

    //     // Vérifie si l'utilisateur est un tuteur ou un superviseur
    //     if ($_SESSION['role'] !== 'tuteur' && $_SESSION['role'] !== 'superviseur') {
    //         return $this->redirect('/login');
    //     }

    //     // Récupère les données du formulaire de modification
    //     $data = $_POST;
    //     $evaluation = Evaluation::updateEvaluation($data['id'],$data);

    //     // Redirige vers la page des évaluations du stagiaire
    //     return $this->redirect("/stagiaire/{$evaluation['stagiaire_id']}/evaluations");
    // }

    // Met à jour une évaluation existante
    public function update2($evaluationId) {
    // Vérifie si l'utilisateur est un tuteur ou un superviseur
    if ($_SESSION['role'] !== 'tuteur' && $_SESSION['role'] !== 'superviseur') {
        return $this->redirect('/login');
    }

    // Récupère les données du formulaire de modification
    $data = $_POST;
    $data['id'] = $evaluationId; // Ajout de l'ID de l'évaluation à mettre à jour

    // Appelle la méthode de mise à jour
    $updateResult = Evaluation::updateEvaluation($data['id'], $data);

    // Vérifie si la mise à jour a réussi
    if ($updateResult) {
        // Redirige vers la page des évaluations du stagiaire
        $stagiaireId = $data['stagiaire_id']; // Récupère l'ID du stagiaire
        return $this->redirect("/stagiaire/{$stagiaireId}/evaluations");
    } else {
        // En cas d'erreur, affiche un message d'erreur
        return $this->view('evaluations/modifier', [
            'error' => 'Une erreur est survenue lors de la mise à jour de l\'évaluation.',
            'evaluation' => $data,
            'stagiaire' => Stagiaire::getById($data['stagiaire_id'])
        ]);
    }
}


    // Supprime une évaluation
    public function supprimer($evaluationId) {
        // Récupère l'évaluation à supprimer
        $evaluation = Evaluation::getById($evaluationId);
        
        // Vérifie si l'utilisateur est autorisé à supprimer l'évaluation
        if ($_SESSION['role'] !== 'tuteur' && $_SESSION['role'] !== 'superviseur') {
            return $this->redirect('/login');
        }

        // Supprime l'évaluation
        Evaluation::delete($evaluationId);
        
        // Redirige vers la liste des évaluations du stagiaire
        return $this->redirect("/stagiaire/{$evaluation['stagiaire_id']}/evaluations");
    }
}
