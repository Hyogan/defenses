<?php

class Ligne {
    public $id;
    public $type_ligne;
    public $numero_ligne;
    public $marque_poste;
    public $nom_proprietaire;
    public $numero_port;
    public $numero_bandeau;
    public $numero_fusible;
    public $numero_jarretiere;

    public function __construct($id = null) {
        if ($id) {
            $this->id = $id;
            $this->trouver($id);
        }
    }

    public function ajouter() {
        global $db;
        $stmt = $db->prepare("INSERT INTO lignes (type_ligne, numero_ligne, marque_poste, nom_proprietaire, numero_port, numero_bandeau, numero_fusible, numero_jarretiere) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$this->type_ligne, $this->numero_ligne, $this->marque_poste, $this->nom_proprietaire, $this->numero_port, $this->numero_bandeau, $this->numero_fusible, $this->numero_jarretiere]);
    }

    public function modifier() {
        global $db;
        $stmt = $db->prepare("UPDATE lignes SET type_ligne = ?, numero_ligne = ?, marque_poste = ?, nom_proprietaire = ?, numero_port = ?, numero_bandeau = ?, numero_fusible = ?, numero_jarretiere = ? WHERE id = ?");
        $stmt->execute([$this->type_ligne, $this->numero_ligne, $this->marque_poste, $this->nom_proprietaire, $this->numero_port, $this->numero_bandeau, $this->numero_fusible, $this->numero_jarretiere, $this->id]);
    }

    public function supprimer() {
        global $db;
        $stmt = $db->prepare("DELETE FROM lignes WHERE id = ?");
        $stmt->execute([$this->id]);
    }

    public function trouver($id) {
        global $db;
        $stmt = $db->prepare("SELECT * FROM lignes WHERE id = ?");
        $stmt->execute([$id]);
        $ligne = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($ligne) {
            foreach ($ligne as $key => $value) {
                $this->$key = $value;
            }
        }
    }

    public static function tous() {
        global $db;
        $stmt = $db->query("SELECT * FROM lignes");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}