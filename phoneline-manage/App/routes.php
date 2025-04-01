<?php 

use App\Controllers\AuthController;
use App\Controllers\DashboardController;
use App\Controllers\UserController;

$routes = [
    // Routes pour la page d'accueil
    '/' => [DashboardController::class, 'home'],
    '/home' => [DashboardController::class, 'home'],
    '/auth/login' => [AuthController::class, 'login'],
    '/auth/authenticate' => [AuthController::class, 'authenticate'],
    '/auth/register' => [AuthController::class, 'register'],
    '/auth/logout' => [AuthController::class, 'logout'],
    '/user/store' => [UserController::class, 'store'],
  
    // Routes pour l'authentification
    '/login' => [AuthController::class, 'login'],
    '/logout' => [AuthController::class, 'logout'],
    '/register' => [AuthController::class, 'register'],
    '/password/reset' => [AuthController::class, 'resetPassword'],

    '/lignes' => [LignesController::class, 'liste'],
    '/lignes/ajouter' => [LignesController::class, 'ajouter'],
    '/lignes/store' => [LignesController::class, 'store'],
    '/lignes/modifier' => [LignesController::class, 'modifier'],
    '/lignes/supprimer' => [LignesController::class, 'supprimer'],
    '/lignes/details' => [LignesController::class, 'details'],
    '/lignes/imprimer' => [LignesController::class, 'imprimer'],
    
    // Routes pour les tableaux de bord (selon le rôle)
    '/dashboard' => [DashboardController::class, 'index'],
    '/dashboard/utilisateur' => [DashboardController::class, 'superviseur'],
    '/dashboard/admin' => [DashboardController::class, 'admin'],
];



return $routes;
