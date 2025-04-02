<?php

namespace App\Controllers;

use App\Models\Auth;
use App\Models\Evaluation;
use App\Models\User;
use App\Models\Stagiaire;
use App\Models\Tuteur;
use Core\Controller;

class EvaluationController extends Controller {
    
    // Affiche la liste des évaluations pour un stagiaire

    public function allEvaluations() 
    {
      $evaluations = Evaluation::getAllWithDetails();
      // dd($evaluations);
      return $this->view('evaluations/index',['evaluations' =>$evaluations],'admin');
    }

    public function index($stagiaireId = null) 
    {
      if($stagiaireId == null) {
        $user = User::getById(Auth::id());
        $stagiaire = Stagiaire::getById($user['stagiaire']['id'])[0];
        $evaluations = Evaluation::getByStagiaire($stagiaire['id']);
        // dd([ 'stagiaire' => $stagiaire,
        // 'evaluations' => $evaluations]);  
        return $this->view('evaluations/index', [
            'stagiaire' => $stagiaire,
            'evaluations' => $evaluations
        ],'admin');
      }
        $evaluations = Evaluation::getByStagiaire($stagiaireId);
        // On récupère les stagiaires pour afficher leurs informations dans la vue
        $stagiaire = Stagiaire::getById($stagiaireId);
        // On charge la vue avec les évaluations et les informations du stagiaire
        return $this->view('evaluations/index', [
            'stagiaire' => $stagiaire,
            'evaluations' => $evaluations
        ],'admin');
    }

    // Affiche le formulaire pour ajouter une nouvelle évaluation
    public function ajouter($stagiaireId) {
        // Vérifie si l'utilisateur est un tuteur ou un superviseur pour ajouter une évaluation
        if (Auth::getUserType() !== 'tuteur' && Auth::getUserType() !== 'superviseur') {
            return $this->redirect('/login');
        }

        // Récupère le stagiaire pour pré-remplir le formulaire si nécessaire
        $stagiaire = Stagiaire::getById($stagiaireId);
        // Affiche la vue du formulaire d'ajout
        return $this->view('evaluations/create', [
            'stagiaire' => $stagiaire[0]
        ],'admin');
    }

    // Enregistre une nouvelle évaluation pour un stagiaire
    public function store($stagiaireId) {
        // Vérifie si l'utilisateur est un tuteur ou un superviseur
        if (Auth::getUserType() !== 'tuteur' && Auth::getUserType() !== 'superviseur') {
            return $this->redirect('/login');
        }

        // Récupère les données envoyées via le formulaire
        $data = $_POST;
        $data['stagiaire_id'] = $stagiaireId;
        $data['tuteur_id'] = Auth::id();
        $data['tuteur_id'] = User::getById(Auth::id())['tuteur']['id'];

        // Validation simple des données
        if (empty($data['note']) || empty($data['commentaires'])) {
          // $stagiare = Stagiaire::getById($stagiaireId);
            return $this->view('evaluations/create', [
                'error' => 'Tous les champs doivent être remplis.',
                'stagiaire' => Stagiaire::getById($stagiaireId)[0]
            ],'admin');
        }
                // dd($data);
        $evaluation = Evaluation::add($data);
        // Redirige vers la liste des évaluations après enregistrement
        return $this->redirect("/evaluations/tuteur");
    }

    // Affiche le formulaire pour modifier une évaluation existante
    public function modifier($evaluationId) {
        // Récupère l'évaluation existante
        $evaluation = Evaluation::getById($evaluationId);
        $stagiaire = Stagiaire::getById($evaluation['stagiaire_id']);
        // Vérifie si l'utilisateur est autorisé à modifier l'évaluation (tuteur ou superviseur)
        if ($_SESSION['user_role'] !== 'tuteur') {
            return $this->redirect('/login');
        }

        // Charge la vue du formulaire de modification
        // dd($stagiaire);
        return $this->view('evaluations/edit', [
            'evaluation' => $evaluation,
            'stagiaire' => $stagiaire[0]
        ],'admin');
    }

    // Met à jour une évaluation existante
    // public function update($evaluationId) {
    //     // Récupère l'évaluation à modifier
    //     $evaluation = Evaluation::getById($evaluationId);

    //     // Vérifie si l'utilisateur est un tuteur ou un superviseur
    //     if ($_SESSION['user_role'] !== 'tuteur' && $_SESSION['user_role'] !== 'superviseur') {
    //         return $this->redirect('/login');
    //     }

    //     // Récupère les données du formulaire de modification
    //     $data = $_POST;
    //     $evaluation = Evaluation::updateEvaluation($data['id'],$data);

    //     // Redirige vers la page des évaluations du stagiaire
    //     return $this->redirect("/stagiaire/{$evaluation['stagiaire_id']}/evaluations");
    // }

    // Met à jour une évaluation existante
    public function update($evaluationId) {
    // Vérifie si l'utilisateur est un tuteur ou un superviseur
    if ($_SESSION['user_role'] !== 'tuteur' && $_SESSION['user_role'] !== 'superviseur') {
        return $this->redirect('/login');
    }

    // Récupère les données du formulaire de modification
    $data = $_POST;
    $data['id'] = $evaluationId; // Ajout de l'ID de l'évaluation à mettre à jour
    // Appelle la éthode de mise à jour
    $updateResult = Evaluation::updateEvaluation($data['id'], $data);
    // Vérifie si la mise à jour a réussi
    if ($updateResult) {
        // Redirige vers la page des évaluations du stagiaire
        $stagiaireId = $data['stagiaire_id']; // Récupère l'ID du stagiaire
        return $this->redirect("/evaluations/tuteur");
    } else {
        // En cas d'erreur, affiche un message d'erreur
        return $this->view('evaluations/edit', [
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
        if ($_SESSION['user_role'] !== 'tuteur' && $_SESSION['user_role'] !== 'superviseur') {
            return $this->redirect('/login');
        }

        // Supprime l'évaluation
        Evaluation::delete($evaluationId);
        
        // Redirige vers la liste des évaluations du stagiaire
        return $this->redirect("/stagiaire/{$evaluation['stagiaire_id']}/evaluations");
    }

    public function tuteur() {
        $id = Auth::id();
        $role = Auth::getUserType(); 
        if($role == 'tuteur') {
            $user = Tuteur::getByUserId($id);
            $evaluations = Evaluation::getByTuteur($user['id']);
          //  dd($evaluations);
            return $this->view('evaluations/index',[
              'evaluations' => $evaluations
            ],'admin');
        }
    }



}
