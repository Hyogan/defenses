<?php 
namespace App\Controllers;

use Core\Controller;
use App\Models\Tuteur;
use App\Models\User;
use App\Models\Stagiaire;

class TuteurController extends Controller{
    // Afficher la liste des tuteurs
    public function index() 
    {
      $tuteurs = Tuteur::getAll();
      return $this->view('tuteurs/index',['tuteurs' => $tuteurs],'admin');
    }

    // Afficher le formulaire de création
    public function create() 
    {
      return $this->view("tuteurs/create",[],"admin");
    }

    // Traiter la création d'un tuteur
    public function store() {
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = $_POST;
        $errors = [];
        
        // Validation des données
        if (empty($data['nom'])) {
          $errors[] = "Le nom est obligatoire";
        }
        
        if (empty($data['prenom'])) {
          $errors[] = "Le prénom est obligatoire";
        }
        
        if (empty($data['email'])) {
          $errors[] = "L'email est obligatoire";
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
          $errors[] = "L'email n'est pas valide";
        } elseif (User::getByEmail($data['email'])) {
          $errors[] = "Cet email est déjà utilisé";
        }
        
        if (empty($data['mot_de_passe'])) {
          $errors[] = "Le mot de passe est obligatoire";
        } elseif (strlen($data['mot_de_passe']) < 6) {
          $errors[] = "Le mot de passe doit contenir au moins 6 caractères";
        }
        
        if (empty($data['departement'])) {
          $errors[] = "Le département est obligatoire";
        }
        
        if (empty($data['poste'])) {
          $errors[] = "Le poste est obligatoire";
        }
        
        // Si le rôle n'est pas défini, on le définit comme tuteur
        if(!isset($data['role']) || empty($data['role'])) {
          $data['role'] = 'tuteur';
        }
        
        // Si le statut n'est pas défini, on le définit comme actif
        if(!isset($data['statut']) || empty($data['statut'])) {
          $data['statut'] = 'actif';
        }
        
        // S'il y a des erreurs, on les affiche
        if (!empty($errors)) {
          return $this->view("tuteurs/create", [
            'errors' => $errors,
            'data' => $data
          ], "admin");
        }
        
        // Création de l'utilisateur
        try {
          $userId = User::create($data);
          
          // Redirection avec message de succès
          $_SESSION['success'] = "Le tuteur a été créé avec succès";
          header("Location: /tuteurs");
          exit;
        } catch (\Exception $e) {
          // En cas d'erreur, on affiche un message
          return $this->view("tuteurs/create", [
            'errors' => ["Une erreur est survenue lors de la création du tuteur: " . $e->getMessage()],
            'data' => $data
          ], "admin");
        }
      }
      
      // Si ce n'est pas une requête POST, on redirige vers le formulaire
      header("Location: /tuteurs/create");
      exit;
    }

    // Afficher le formulaire de modification
    public function edit($id) {
      $tuteur = User::getById($id);
      // dd($tuteur);
      if (!$tuteur) {
        $_SESSION['error'] = "Ce tuteur n'existe pas";
        $this->redirect("/dashboard/tuteurs");
      }
      
      return $this->view("tuteurs/edit", ['tuteur' => $tuteur], "admin");
    }

    // Traiter la modification d'un tuteur
    public function update($id) {
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = $_POST;
        $errors = [];
        $tuteur = User::getById($id);
      
        if (!$tuteur) {
          $_SESSION['error'] = "Ce tuteur n'existe pas";
          $this->redirect("dashboard/tuteurs");
        }
        
        // Validation des données
        if (empty($data['nom'])) {
          $errors[] = "Le nom est obligatoire";
        }
        
        if (empty($data['prenom'])) {
          $errors[] = "Le prénom est obligatoire";
        }
        
        if (empty($data['email'])) {
          $errors[] = "L'email est obligatoire";
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
          $errors[] = "L'email n'est pas valide";
        } elseif ($data['email'] !== $tuteur['email'] && User::getByEmail($data['email'])) {
          $errors[] = "Cet email est déjà utilisé";
        }
        
        // Vérification du mot de passe uniquement s'il est fourni
        if (!empty($data['mot_de_passe']) && strlen($data['mot_de_passe']) < 6) {
          $errors[] = "Le mot de passe doit contenir au moins 6 caractères";
        }
        
        if (empty($data['departement'])) {
          $errors[] = "Le département est obligatoire";
        }
        
        if (empty($data['poste'])) {
          $errors[] = "Le poste est obligatoire";
        }
        
        // S'il y a des erreurs, on les affiche
        if (!empty($errors)) {
          return $this->view("tuteurs/edit", [
            'errors' => $errors,
            'tuteur' => (object) array_merge((array) $tuteur, $data)
          ], "admin");
        }
        
        // Si le mot de passe est vide, on le supprime pour ne pas le mettre à jour
        if (empty($data['mot_de_passe'])) {
          unset($data['mot_de_passe']);
        }
        
        // Mise à jour de l'utilisateur
        try {
          User::update($id, $data);
                // Redirection avec message de succès
          $_SESSION['success'] = "Le tuteur a été mis à jour avec succès";
          // header("Location: /tuteurs");
          $this->redirect("/dashboard/tuteurs");
        } catch (\Exception $e) {
          // En cas d'erreur, on affiche un message
          return $this->view("tuteurs/edit", [
            'errors' => ["Une erreur est survenue lors de la mise à jour du tuteur: " . $e->getMessage()],
            'tuteur' => (object) array_merge((array) $tuteur, $data)
          ], "admin");
        }
      }
      
      // Si ce n'est pas une requête POST, on redirige vers le formulaire d'édition
      header("Location: /tuteurs/edit/{$id}");
      exit;
    }

    // Afficher les détails d'un tuteur
    public function show($id) {
      $tuteur = Tuteur::getById($id);
      
      if (!$tuteur) {
        $_SESSION['error'] = "Ce tuteur n'existe pas";
        header("Location: /tuteurs");
        exit;
      }
      
      return $this->view("tuteurs/show", ['tuteur' => $tuteur], "admin");
    }

    // Affectation d'un tuteur à un stagiaire
    public function assign($stagiaireId) {
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $tuteurIds = $_POST['tuteurs'];
        // Affecter les tuteurs
        Tuteur::assignToStagiaire($stagiaireId, $tuteurIds);
        // Rediriger ou afficher un message
        $_SESSION['success'] = "Les tuteurs ont été affectés avec succès";
        header("Location: /stagiaires/{$stagiaireId}");
        exit;
      }
      
      $tuteurs = Tuteur::getAll();
      $stagiaire = Stagiaire::getById($stagiaireId);
      
      if (!$stagiaire) {
        $_SESSION['error'] = "Ce stagiaire n'existe pas";
        header("Location: /stagiaires");
        exit;
      }
      
      $assignedTuteurs = Tuteur::getByStagiaire($stagiaireId);
      
      return $this->view("stagiaires/assign_tuteurs", [
        'tuteurs' => $tuteurs,
        'stagiaire' => $stagiaire,
        'assignedTuteurs' => $assignedTuteurs
      ], "admin");
    }
}
