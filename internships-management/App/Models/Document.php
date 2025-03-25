<?php
namespace App\Models;

use Core\Model;
use Core\Database;

class Document extends Model {
    protected static $table = 'documents';


    // Ajouter un document
    public static function uploadDocument($file) {
        $db = Database::getInstance();
        $targetDirectory = 'uploads/documents/';
        $fileName = basename($file['name']);
        $targetFile = $targetDirectory . $fileName;

        if (move_uploaded_file($file['tmp_name'], $targetFile)) {
            $query = "INSERT INTO documents (nom, chemin, date_creation) VALUES (?, ?, NOW())";
            $params = [$fileName, $targetFile];
            return $db->query($query, $params);
        }
        return false;
    }

    // Obtenir tous les documents
    public static function getAll() {
        $db = Database::getInstance();
        return $db->fetchAll("SELECT * FROM documents ORDER BY date_creation DESC");
    }

    // Supprimer un document
    public static function deleteDocument($id) {
        $db = Database::getInstance();
        $document = $db->fetch("SELECT * FROM documents WHERE id = ?", [$id]);
        if ($document) {
            unlink($document['chemin']); // Supprimer le fichier physique
            $db->query("DELETE FROM documents WHERE id = ?", [$id]);
            return true;
        }
        return false;
    }
}
