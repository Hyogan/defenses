<?php

use App\Controllers\AuthController;
use App\Controllers\DashboardController;
use App\Controllers\DemandeChangementController;
use App\Controllers\UserController;
use App\Controllers\CategoryController;
use App\Controllers\LaboratoryController;
use App\Controllers\ServiceController;
use App\Controllers\MaterialController;
use App\Controllers\RebusController;
use App\Controllers\AffectationController;

$routes = [
    // Routes pour la page d'accueil et l'authentification
    '/' => [DashboardController::class, 'home'],
    '/home' => [DashboardController::class, 'home'],
    '/auth/login' => [AuthController::class, 'login'],
    '/auth/authenticate' => [AuthController::class, 'authenticate'],
    '/auth/logout' => [AuthController::class, 'logout'],
    '/login' => [AuthController::class, 'login'],
    '/logout' => [AuthController::class, 'logout'],
    '/register' => [AuthController::class, 'register'],
    '/password/reset' => [AuthController::class, 'resetPassword'],

    // Routes pour la gestion des utilisateurs
    '/users' => [UserController::class, 'index'],
    '/users/create' => [UserController::class, 'create'],
    '/user/profile' => [UserController::class, 'profile'],
    '/user/changePassword' => [UserController::class, 'changePassword'],
    '/users/store' => [UserController::class, 'store'],
    '/users/edit/{id}' => [UserController::class, 'edit'],
    '/users/update/{id}' => [UserController::class, 'update'],
    '/users/delete/{id}' => [UserController::class, 'delete'],
    '/users/details/{id}' => [UserController::class, 'show'],

    // Routes pour la gestion des catégories
    '/categories' => [CategoryController::class, 'index'],
    '/categories/create' => [CategoryController::class, 'create'],
    '/categories/store' => [CategoryController::class, 'store'],
    '/categories/edit/{id}' => [CategoryController::class, 'edit'],
    '/categories/update/{id}' => [CategoryController::class, 'update'],
    '/categories/delete/{id}' => [CategoryController::class, 'delete'],

    // Routes pour la gestion des laboratoires
    '/laboratories' => [LaboratoryController::class, 'index'],
    '/laboratories/create' => [LaboratoryController::class, 'create'],
    '/laboratories/store' => [LaboratoryController::class, 'store'],
    '/laboratories/edit/{id}' => [LaboratoryController::class, 'edit'],
    '/laboratories/update/{id}' => [LaboratoryController::class, 'update'],
    '/laboratories/delete/{id}' => [LaboratoryController::class, 'delete'],

    // Routes pour la gestion des services
    '/services' => [ServiceController::class, 'index'],
    '/services/create' => [ServiceController::class, 'create'],
    '/services/store' => [ServiceController::class, 'store'],
    '/services/edit/{id}' => [ServiceController::class, 'edit'],
    '/services/update/{id}' => [ServiceController::class, 'update'],
    '/services/delete/{id}' => [ServiceController::class, 'delete'],

    // Routes pour la gestion des matériels
    '/materials' => [MaterialController::class, 'index'],
    '/materials/create' => [MaterialController::class, 'create'],
    '/materials/store' => [MaterialController::class, 'store'],
    '/materials/edit/{id}' => [MaterialController::class, 'edit'],
    '/materials/update/{id}' => [MaterialController::class, 'update'],
    '/materials/delete/{id}' => [MaterialController::class, 'delete'],
    '/materials/details/{id}' => [MaterialController::class, 'details'],
    '/materials/search' => [MaterialController::class, 'search'],

    // Routes pour la gestion des rebus
    '/rebus' => [RebusController::class, 'index'],
    '/rebus/create' => [RebusController::class, 'create'],
    '/rebus/store' => [RebusController::class, 'store'],
    '/rebus/edit/{id}' => [RebusController::class, 'edit'],
    '/rebus/update/{id}' => [RebusController::class, 'update'],
    '/rebus/delete/{id}' => [RebusController::class, 'delete'],

    // Routes pour la gestion des affectations
    '/affectations' => [AffectationController::class, 'index'],
    '/affectations/create' => [AffectationController::class, 'create'],
    '/affectations/store' => [AffectationController::class, 'store'],
    '/affectations/edit/{id}' => [AffectationController::class, 'edit'],
    '/affectations/update/{id}' => [AffectationController::class, 'update'],
    '/affectations/delete/{id}' => [AffectationController::class, 'delete'],
    '/affectations/filter' => [AffectationController::class, 'filter'],

    // Routes pour gerer les demandes 
    '/demandes_changement' => [DemandeChangementController::class, 'index'],
    '/demandes_changement/create' => [DemandeChangementController::class, 'create'],
    '/demandes_changement/store' => [DemandeChangementController::class, 'store'],
    '/demandes_changement/edit/{id}' => [DemandeChangementController::class, 'edit'],
    '/demandes_changement/update/{id}' => [DemandeChangementController::class, 'update'],
    '/demandes_changement/delete/{id}' => [DemandeChangementController::class, 'delete'],
    // Routes pour les tableaux de bord (selon le rôle)
    '/dashboard' => [DashboardController::class, 'index'],
    '/dashboard/responsable-laboratoire' => [DashboardController::class, 'responsableLabo'],
    '/dashboard/utilisateur' => [DashboardController::class, 'utilisateur'],
    '/dashboard/technicien' => [DashboardController::class, 'technicien'],
    // '/dashboard/logs' => [DashboardController::class, 'logs'],
];

return $routes;
