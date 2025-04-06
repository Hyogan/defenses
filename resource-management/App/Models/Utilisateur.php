<?php

class Utilisateur {
    public $id;
    public $nom;
    public $email;
    public $mot_de_passe;
    public $role;

    public function __construct($id = null) {
        if ($id) {
            $this->id = $id;
            $this->trouver($id);
        }
    }

    public function ajouter() {
        global $db;
        $stmt = $db->prepare("INSERT INTO utilisateurs (nom, email, mot_de_passe, role) VALUES (?, ?, ?, ?)");
        $stmt->execute([$this->nom, $this->email, password_hash($this->mot_de_passe, PASSWORD_DEFAULT), $this->role]);
    }

    public function modifier() {
        global $db;
        $stmt = $db->prepare("UPDATE utilisateurs SET nom = ?, email = ?, mot_de_passe = ?, role = ? WHERE id = ?");
        $stmt->execute([$this->nom, $this->email, password_hash($this->mot_de_passe, PASSWORD_DEFAULT), $this->role, $this->id]);
    }

    public function supprimer() {
        global $db;
        $stmt = $db->prepare("DELETE FROM utilisateurs WHERE id = ?");
        $stmt->execute([$this->id]);
    }

    public function trouver($id) {
        global $db;
        $stmt = $db->prepare("SELECT * FROM utilisateurs WHERE id = ?");
        $stmt->execute([$id]);
        $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($utilisateur) {
            foreach ($utilisateur as $key => $value) {
                $this->$key = $value;
            }
        }
    }

    public static function tous() {
        global $db;
        $stmt = $db->query("SELECT * FROM utilisateurs");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}