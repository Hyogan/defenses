<?php

namespace App\Models;
use PDO;
use Core\Database;

class DemandeChangement
{
  public static function create(array $data): int
  {
      $db = Database::getInstance();
      $stmt = $db->prepare("
          INSERT INTO demandes_changement 
          (id_materiel,id_utilisateur, nom, description, model, raison, id_categorie) 
          VALUES (:id_materiel,:id_utilisateur, :nom, :description, :model, :raison, :id_categorie)
      ");
      
      $stmt->execute([
          ':id_materiel' => $data['id_materiel'],
          ':id_utilisateur' => $data['id_utilisateur'],
          ':nom' => $data['nom'],
          ':description' => $data['description'] ?? null,
          ':model' => $data['model'] ?? null,
          ':raison' => $data['raison'],
          ':id_categorie' => $data['id_categorie'],
      ]);
  
      return $db->lastInsertId();
  }
  

    public static function getById(int $id): ?array
    {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT * FROM demandes_changement WHERE id_demande = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public static function getAll(): array
    {
        $db = Database::getInstance();
        $sql = "SELECT dc.*, m.nom as nom_materiel_actuel FROM demandes_changement dc
                JOIN materiels m  ON dc.id_materiel=m.id_materiel" ;
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function update(int $id, array $data): bool
    {
        $db = Database::getInstance();
        $stmt = $db->prepare("
            UPDATE demandes_changement 
            SET id_materiel = :id_materiel, 
                nom = :nom, 
                description = :description, 
                model = :model, 
                raison = :raison, 
                id_categorie = :id_categorie 
            WHERE id_demande = :id
        ");
    
        return $stmt->execute([
            ':id_materiel' => $data['id_materiel'],
            ':nom' => $data['nom'],
            ':description' => $data['description'] ?? null,
            ':model' => $data['model'] ?? null,
            ':raison' => $data['raison'],
            ':id_categorie' => $data['id_categorie'],
            ':id' => $id,
        ]);
    }
    public static function delete(int $id): bool
    {
        $db = Database::getInstance();
        $stmt = $db->prepare("DELETE FROM demandes_changement WHERE id_demande = ?");
        return $stmt->execute([$id]);
    }

    public static function getByMaterielId(int $materielId): array
    {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT dc.*, m.nom AS materiel_nom, m.description AS materiel_description, m.model AS materiel_model, c.nom AS categorie_nom FROM demandes_changement dc LEFT JOIN materiels m ON dc.id_materiel = m.id_materiel LEFT JOIN categories c ON dc.id_categorie = c.id_categorie WHERE dc.id_materiel = ?");
        $stmt->execute([$materielId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getByCategoryId(int $categoryId): array
    {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT dc.*, m.nom AS materiel_nom, m.description AS materiel_description, m.model AS materiel_model, c.nom AS categorie_nom FROM demandes_changement dc LEFT JOIN materiels m ON dc.id_materiel = m.id_materiel LEFT JOIN categories c ON dc.id_categorie = c.id_categorie WHERE dc.id_categorie = ?");
        $stmt->execute([$categoryId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getByServiceId(int $serviceId): array
    {
        $db = Database::getInstance();
        $sql = "SELECT dc.*, 
            m.nom AS materiel_nom, m.description AS materiel_description, 
            m.model AS materiel_model, c.nom AS categorie_nom 
            FROM demandes_changement dc 
            LEFT JOIN materiels m ON dc.id_materiel = m.id_materiel
            LEFT JOIN categories c ON dc.id_categorie = c.id_categorie
            LEFT JOIN utilisateurs u ON dc.id_utilisateur = u.id_utilisateur
            WHERE u.id_service = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute([$serviceId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
