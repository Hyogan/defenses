<?php 
namespace App\Controllers;

use Core\Controller;
use App\Models\Document;

class DocumentController extends Controller{

    // Téléchargement de documents
    public function upload() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $file = $_FILES['document'];
            // Valider et télécharger le document
            Document::uploadDocument($file);
            // Rediriger ou afficher un message
            header("Location: /documents");
        }
        require_once('views/documents/upload.php');
    }

    // Afficher la liste des documents
    public function index() {
        $documents = Document::getAll();
        require_once('views/documents/index.php');
    }

    // Supprimer un document
    public function delete($documentId) {
        Document::deleteDocument($documentId);
        // Rediriger ou afficher un message
        header("Location: /documents");
    }
}
