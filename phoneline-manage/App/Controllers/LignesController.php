<?php

include 'models/Ligne.php';

class LignesController {
    public function ajouter() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ligne = new Ligne();
            $ligne->type_ligne = $_POST['type_ligne'];
            $ligne->numero_ligne = $_POST['numero_ligne'];
            $ligne->marque_poste = $_POST['marque_poste'];
            $ligne->nom_proprietaire = $_POST['nom_proprietaire'];
            $ligne->numero_port = $_POST['numero_port'];
            $ligne->numero_bandeau = $_POST['numero_bandeau'];
            $ligne->numero_fusible = $_POST['numero_fusible'];
            $ligne->numero_jarretiere = $_POST['numero_jarretiere'];
            $ligne->ajouter();
            header('Location: index.php?action=liste');
            exit;
        }
        include 'views/lignes/ajouter.php';
    }

    public function modifier($id) {
        $ligne = new Ligne($id);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ligne->type_ligne = $_POST['type_ligne'];
            $ligne->numero_ligne = $_POST['numero_ligne'];
            $ligne->marque_poste = $_POST['marque_poste'];
            $ligne->nom_proprietaire = $_POST['nom_proprietaire'];
            $ligne->numero_port = $_POST['numero_port'];
            $ligne->numero_bandeau = $_POST['numero_bandeau'];
            $ligne->numero_fusible = $_POST['numero_fusible'];
            $ligne->numero_jarretiere = $_POST['numero_jarretiere'];
            $ligne->modifier();
            header('Location: index.php?action=liste');
            exit;
        }
        include 'views/lignes/modifier.php';
    }

    public function supprimer($id) {
        $ligne = new Ligne($id);
        $ligne->supprimer();
        header('Location: index.php?action=liste');
        exit;
    }

    public function liste() {
        $lignes = Ligne::tous();
        include 'views/lignes/liste.php';
    }

    public function details($id) {
        $ligne = new Ligne($id);
        include 'views/lignes/details.php';
    }
}