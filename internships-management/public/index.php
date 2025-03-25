<?php
require_once '../App/bootstrap.php';
// Démarrer la session
session_start();
use Core\Router;
Router::dispatch();
