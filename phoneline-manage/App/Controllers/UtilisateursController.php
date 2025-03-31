<?php

include 'models/Utilisateur.php';

class UtilisateursController {
    public function ajouter() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $utilisateur = new Utilisateur();
            $utilisateur->nom = $_POST['nom'];
            $utilisateur->email = $_POST['email'];
            $utilisateur->mot_de_passe = $_POST['mot_de_passe'];
            $utilisateur->role = $_POST['role'];
            $utilisateur->ajouter();
            header('Location: index.php?action=liste');
            exit;
        }
        include 'views/utilisateurs/ajouter.php';
    }

    public function modifier($id) {
        $utilisateur = new Utilisateur($id);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $utilisateur->nom = $_POST['nom'];
            $utilisateur->email = $_POST['email'];
            $utilisateur->mot_de_passe = $_POST['mot_de_passe'];
            $utilisateur->role = $_POST['role'];
            $utilisateur->modifier();
            header('Location: index.php?action=liste');
            exit;
        }
        include 'views/utilisateurs/modifier.php';
    }

    public function supprimer($id) {
        $utilisateur = new Utilisateur($id);
        $utilisateur->supprimer();
        header('Location: index.php?action=liste');
        exit;
    }

    public function liste() {
        $utilisateurs = Utilisateur::tous();
        include 'views/utilisateurs/liste.php';
    }

    public function details($id) {
        $utilisateur = new Utilisateur($id);
        include 'views/utilisateurs/details.php';
    }
}