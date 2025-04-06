<?php 

use App\Controllers\AuthController;
use App\Controllers\DashboardController;
use App\Controllers\UserController;
use App\Controllers\LignesController;

$routes = [
    // Routes pour la page d'accueil
    '/' => [DashboardController::class, 'home'],
    '/home' => [DashboardController::class, 'home'],
    '/auth/login' => [AuthController::class, 'login'],
    '/auth/authenticate' => [AuthController::class, 'authenticate'],
    '/auth/logout' => [AuthController::class, 'logout'],
  
    // Routes pour l'authentification
    '/login' => [AuthController::class, 'login'],
    '/logout' => [AuthController::class, 'logout'],
    '/register' => [AuthController::class, 'register'],
    '/password/reset' => [AuthController::class, 'resetPassword'],

    '/lignes' => [LignesController::class, 'liste'],
    '/lignes/ajouter' => [LignesController::class, 'ajouter'],
    '/lignes/store' => [LignesController::class, 'store'],
    '/lignes/modifier/{id}' => [LignesController::class, 'edit'],
    '/lignes/update/{id}' => [LignesController::class, 'update'],
    '/lignes/supprimer/{id}' => [LignesController::class, 'supprimer'],
    '/lignes/details/{id}' => [LignesController::class, 'details'],
    '/lignes/imprimer' => [LignesController::class, 'imprimer'],
    '/lignes/export' => [LignesController::class, 'exportPdf'],
    '/ligne/export/{id}' => [LignesController::class, 'imprimer'],
    

    '/user/management' => [UserController::class, 'index'],
    '/user/create' => [UserController::class, 'create'],
    '/user/store' => [UserController::class, 'store'],
    '/user/details/{id}' => [UserController::class, 'show'],
    '/user/edit/{id}' => [UserController::class, 'edit'],
    '/user/update/{id}' => [UserController::class, 'update'],
    '/user/profile' => [UserController::class, 'profile'],
    '/user/changePassword' => [UserController::class, 'changePassword'],


    // Routes pour les tableaux de bord (selon le rôle)
    '/dashboard' => [DashboardController::class, 'index'],
    '/dashboard/classic' => [DashboardController::class, 'classic'],
    '/dashboard/admin' => [DashboardController::class, 'admin'],
    '/dashboard/logs' => [DashboardController::class, 'logs'],
];



return $routes;
