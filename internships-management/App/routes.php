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
    
    // Routes pour la gestion des stagiaires
    '/dashboard/stagiaires' => [StagiaireController::class, 'index'],
    '/stagiaire/ajouter' => [StagiaireController::class, 'create'],
    '/stagiaire/store' => [StagiaireController::class, 'store'],
    '/stagiaire/modifier/{id}' => [StagiaireController::class, 'edit'],
    '/stagiaire/update/{id}' => [StagiaireController::class, 'update'],
    '/stagiaire/supprimer/{id}' => [StagiaireController::class, 'supprimer'],
    
    // Routes pour la gestion des tuteurs
    '/dashboard/tuteurs' => [TuteurController::class, 'index'],
    '/tuteur/ajouter' => [TuteurController::class, 'create'],
    '/tuteurs/store' => [TuteurController::class, 'store'],
    '/tuteur/modifier/{id}' => [TuteurController::class, 'edit'],
    '/tuteurs/update/{id}' => [TuteurController::class, 'update'],
    '/tuteur/supprimer/{id}' => [TuteurController::class, 'supprimer'],
    
    // Routes pour la gestion des tâches
    '/taches' => [TacheController::class, 'index'],
    '/tache/ajouter' => [TacheController::class, 'ajouter'],
    '/tache/modifier/{id}' => [TacheController::class, 'modifier'],
    '/tache/supprimer/{id}' => [TacheController::class, 'supprimer'],
    
    // Routes pour la gestion des documents
    '/documents' => [DocumentController::class, 'index'],
    '/document/ajouter' => [DocumentController::class, 'ajouter'],
    '/document/telecharger/{id}' => [DocumentController::class, 'telecharger'],
    '/document/modifier/{id}' => [DocumentController::class, 'modifier'],
    '/document/supprimer/{id}' => [DocumentController::class, 'supprimer'],
    
    // Routes pour la gestion des évaluations
    '/evaluations' => [EvaluationController::class, 'index'],
    '/evaluation/ajouter' => [EvaluationController::class, 'ajouter'],
    '/evaluation/modifier/{id}' => [EvaluationController::class, 'modifier'],
    '/evaluation/supprimer/{id}' => [EvaluationController::class, 'supprimer'],
    
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



$routes2 = [
    // Routes pour la page d'accueil
    '/' => [HomeController::class, 'index'],
    '/home' => [HomeController::class, 'index'],
    
    // Routes pour la gestion des stagiaires
    '/stagiaires' => [StagiaireController::class, 'index'],
    '/stagiaire/ajouter' => [StagiaireController::class, 'ajouter'],
    '/stagiaire/modifier/{id}' => [StagiaireController::class, 'modifier'],
    '/stagiaire/supprimer/{id}' => [StagiaireController::class, 'supprimer'],
    
    // Routes pour la gestion des tuteurs
    '/tuteurs' => [TuteurController::class, 'index'],
    '/tuteur/ajouter' => [TuteurController::class, 'ajouter'],
    '/tuteur/modifier/{id}' => [TuteurController::class, 'modifier'],
    '/tuteur/supprimer/{id}' => [TuteurController::class, 'supprimer'],
    
    // Routes pour la gestion des tâches
    '/taches' => [TacheController::class, 'index'],
    '/tache/ajouter' => [TacheController::class, 'ajouter'],
    '/tache/modifier/{id}' => [TacheController::class, 'modifier'],
    '/tache/supprimer/{id}' => [TacheController::class, 'supprimer'],
    
    // Routes pour la gestion des documents
    '/documents' => [DocumentController::class, 'index'],
    '/document/ajouter' => [DocumentController::class, 'ajouter'],
    '/document/telecharger/{id}' => [DocumentController::class, 'telecharger'],
    '/document/modifier/{id}' => [DocumentController::class, 'modifier'],
    '/document/supprimer/{id}' => [DocumentController::class, 'supprimer'],
    
    // Routes pour la gestion des évaluations
    '/evaluations' => [EvaluationController::class, 'index'],
    '/evaluation/ajouter' => [EvaluationController::class, 'ajouter'],
    '/evaluation/modifier/{id}' => [EvaluationController::class, 'modifier'],
    '/evaluation/supprimer/{id}' => [EvaluationController::class, 'supprimer'],
    
    // Routes pour l'authentification
    '/login' => [AuthController::class, 'login'],
    '/logout' => [AuthController::class, 'logout'],
    '/register' => [AuthController::class, 'register'],
    '/password/reset' => [AuthController::class, 'resetPassword'],
    
    // Routes pour le tableau de bord
    '/dashboard' => [DashboardController::class, 'index'],
    '/dashboard/retards' => [DashboardController::class, 'retards'],
];


return $routes;
