<?php 

use App\Controllers\HomeController;
use App\Controllers\StagiaireController;
use App\Controllers\TuteurController;
use App\Controllers\TacheController;
use App\Controllers\DocumentController;
use App\Controllers\EvaluationController;
use App\Controllers\AuthController;
use App\Controllers\DashboardController;
use App\Controllers\UserController;

$routes = [
    // Routes pour la page d'accueil
    '/' => [HomeController::class, 'index'],
    '/home' => [HomeController::class, 'index'],
    '/auth/login' => [AuthController::class, 'login'],
    '/auth/authenticate' => [AuthController::class, 'authenticate'],
    '/auth/register' => [AuthController::class, 'register'],
    '/auth/logout' => [AuthController::class, 'logout'],
    '/user/store' => [UserController::class, 'store'],
    '/utilisateur/modifier/{id}' => [UserController::class, 'modifier'],
    
    // Routes pour la gestion des stagiaires
    '/dashboard/stagiaires' => [StagiaireController::class, 'index'],
    '/dashboard/stagiaire/taches' => [StagiaireController::class, 'taches'],
    '/dashboard/affectations' => [StagiaireController::class, 'affectations'],
    '/stagiaire/ajouter' => [StagiaireController::class, 'create'],
    '/stagiaire/store' => [StagiaireController::class, 'store'],
    '/stagiaire/evaluations' => [EvaluationController::class, 'index'],
    '/stagiaire/modifier/{id}' => [StagiaireController::class, 'edit'],
    '/stagiaire/update/{id}' => [StagiaireController::class, 'update'],
    '/stagiaire/show/{userId}' => [StagiaireController::class, 'show'],
    '/stagiaire/supprimer/{id}' => [StagiaireController::class, 'delete'],
    '/stagiaire/assign-tuteurs/{id}' => [StagiaireController::class, 'assignTuteurs'],
    '/stagiaire/process-assign-tuteurs/{id}' => [StagiaireController::class, 'processAssignTuteurs'],
    '/stagiaires/remove-tuteur/{stagiaireId}/{tuteurId}' => [StagiaireController::class, 'removeTuteur'],
    
    // Routes pour la gestion des tuteurs
    '/dashboard/tuteurs' => [TuteurController::class, 'index'],
    '/tuteur/stagiaires' => [TuteurController::class, 'stagiaires'],
    '/tuteur/ajouter' => [TuteurController::class, 'create'],
    '/tuteurs/store' => [TuteurController::class, 'store'],
    '/tuteur/modifier/{id}' => [TuteurController::class, 'edit'],
    '/tuteurs/update/{id}' => [TuteurController::class, 'update'],
    '/tuteur/supprimer/{id}' => [TuteurController::class, 'supprimer'],
    '/tuteurs/assign' => [TuteurController::class, 'assignView'],
    
    // Routes pour la gestion des tâches
    '/taches' => [TacheController::class, 'index'],
    '/tache/ajouter' => [TacheController::class, 'create'],
    '/tache/store' => [TacheController::class, 'store'],
    '/tache/modifier/{id}' => [TacheController::class, 'modifier'],
    '/tache/supprimer/{id}' => [TacheController::class, 'supprimer'],
    '/tache/update_status/{id}' => [TacheController::class, 'updateStatus'],
    '/tache/update_percentage/{id}' => [TacheController::class, 'updatePercentage'],
    
    // Routes pour la gestion des documents
    '/documents' => [DocumentController::class, 'index'],
    '/document/ajouter' => [DocumentController::class, 'ajouter'],
    '/document/telecharger/{id}' => [DocumentController::class, 'telecharger'],
    '/document/modifier/{id}' => [DocumentController::class, 'modifier'],
    '/document/supprimer/{id}' => [DocumentController::class, 'supprimer'],

    
    
    // Routes pour la gestion des évaluations
    '/dashboard/evaluations' => [EvaluationController::class, 'allEvaluations'],
    // '/evaluations' => [EvaluationController::class, 'index'],
    '/evaluations/tuteur' => [EvaluationController::class, 'tuteur'],
    '/evaluation/ajouter/{id}' => [EvaluationController::class, 'ajouter'],
    '/evaluation/modifier/{id}' => [EvaluationController::class, 'modifier'],
    '/evaluation/update/{id}' => [EvaluationController::class, 'update'],
    '/evaluation/supprimer/{id}' => [EvaluationController::class, 'supprimer'],
    '/stagiaire/{id}/evaluation/store' => [EvaluationController::class, 'store'],
    
    // Routes pour l'authentification
    '/login' => [AuthController::class, 'login'],
    '/logout' => [AuthController::class, 'logout'],
    '/register' => [AuthController::class, 'register'],
    '/password/reset' => [AuthController::class, 'resetPassword'],
    
    // Routes pour les tableaux de bord (selon le rôle)
    '/dashboard' => [DashboardController::class, 'index'],
    // Tableau de bord spécifique pour les Superviseurs
    '/dashboard/superviseur' => [DashboardController::class, 'superviseur'],
    // Tableau de bord spécifique pour les Tuteurs
    '/dashboard/tuteur' => [DashboardController::class, 'tuteur'],
    // Tableau de bord spécifique pour les Stagiaires
    '/dashboard/stagiaire' => [DashboardController::class, 'stagiaire'],
    // Tableau de bord pour l'admin (gestion complète)
    '/dashboard/admin' => [DashboardController::class, 'admin'],
    // Affichage des stagiaires en retard (utilisé pour tous les rôles, mais filtré selon le rôle)
    '/dashboard/retards' => [DashboardController::class, 'retards'],
];

return $routes;
