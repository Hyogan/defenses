<?php
namespace App\Controllers;

use Core\Controller;

class HomeController extends Controller{
    public function index() {
        require_once __DIR__ . '/../Views/home.php';
    }
}


