<?php

namespace App\Controllers;

use App\Models\Stagiaire;
use App\Models\Tuteur;
use App\Models\Affectation;
use Core\Controller;
use App\Models\User;

class StagiaireController extends Controller {
  // Afficher la liste des stagiaires
    public function index() 
    {
      $stagiaires = Stagiaire::getAllStagiaires();
      return $this->view("stagiaires/index",
      [
        "stagiaires" => $stagiaires
      ],"admin");
  }

    // Création d'un stagiaire
    public function create() 
    {
      return $this->view("stagiaires/create",[],"admin");
    }
    public function store() 
    {
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          $data = $_POST;
          $nom = trim($data['nom']);
          $prenom = trim($data['prenom']);
          $email = filter_var($data['email'], FILTER_VALIDATE_EMAIL);
          $mot_de_passe = $data['mot_de_passe'];
          $formation = trim($data['formation']);
          $date_debut = $data['date_debut'];
          $date_fin = $data['date_fin'];
  
          $errors = []; // Initialisation du tableau d'erreurs
  
          if (empty($nom)) {
              $errors['nom'] = "Le nom est requis.";
          }
          if (empty($prenom)) {
              $errors['prenom'] = "Le prénom est requis.";
          }
          if (!$email) {
              $errors['email'] = "L'email est invalide.";
          }
          if (empty($mot_de_passe)) {
              $errors['mot_de_passe'] = "Le mot de passe est requis.";
          }
          if (empty($formation)) {
              $errors['formation'] = "La formation est requise.";
          }
          if (empty($date_debut)) {
              $errors['date_debut'] = "La date de début est requise.";
          }
          if (empty($date_fin)) {
              $errors['date_fin'] = "La date de fin est requise.";
          }
  
          if (User::getByEmail($email)) {
              $errors['email'] = "Cet email est déjà utilisé.";
          }
  
          if (!empty($errors)) {
              // Retourne à la vue avec les erreurs et les données du formulaire
              return $this->view("stagiaires/create", ['errors' => $errors, 'data' => $data], "admin");
          }
  
          $data['role'] = 'stagiaire';
          $stagiaireId = User::create($data, 'stagiaire');
  
          if ($stagiaireId !== null) {
              flash("success", "Stagiaire créé avec succès.");
              return $this->redirect("/dashboard/stagiaires");
          } else {
              $errors['general'] = "Erreur lors de la création du stagiaire.";
              return $this->view("stagiaires/create", ['errors' => $errors, 'data' => $data], "admin");
          }
      }
    }

    // Mise à jour des informations d'un stagiaire
    public function edit($userId) {
      // $stagiaire = Stagiaire::getByUserId($userId);
      // dd($stagiaire);
      $stagiaire = User::getById($userId);
        // dd($stagiaire);
        $stagiaire["formation"] = $stagiaire["stagiaire"]["formation"];
        $stagiaire["date_debut"] = $stagiaire["stagiaire"]["date_debut"];
        $stagiaire["date_fin"] = $stagiaire["stagiaire"]["date_fin"];
        // dd($stagiaire);
        return $this->view("stagiaires/edit",["data" => $stagiaire],"admin");
    }
    public function update($id) {
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          $data = $_POST;
          $nom = trim($data['nom']);
          $prenom = trim($data['prenom']);
          $email = filter_var($data['email'], FILTER_VALIDATE_EMAIL);
          $formation = trim($data['formation']);
          $date_debut = $data['date_debut'];
          $date_fin = $data['date_fin'];
  
          $errors = [];
  
          if (empty($nom)) {
              $errors['nom'] = "Le nom est requis.";
          }
          if (empty($prenom)) {
              $errors['prenom'] = "Le prénom est requis.";
          }
          if (!$email) {
              $errors['email'] = "L'email est invalide.";
          }
          if (empty($formation)) {
              $errors['formation'] = "La formation est requise.";
          }
          if (empty($date_debut)) {
              $errors['date_debut'] = "La date de début est requise.";
          }
          if (empty($date_fin)) {
              $errors['date_fin'] = "La date de fin est requise.";
          }
  
          // Vérification de l'email existant (sauf si c'est le même email que celui actuel)
          $stagiaire = User::getById($id);
          if ($stagiaire['email'] !== $email && User::getByEmail($email)) {
              $errors['email'] = "Cet email est déjà utilisé.";
          }
  
          if (!empty($errors)) {
              $data['id'] = $id;
              return $this->view("stagiaires/edit", ['errors' => $errors, 'data' => $data, 'id'=>$id], "admin");
          }
          $data["role"] = "stagiaire";
          $result = User::update($id, $data);
  
          if ($result) {
              flash("success", "Stagiaire mis à jour avec succès.");
              return $this->redirect("/dashboard/stagiaires", );
          } else {
              $errors['general'] = "Erreur lors de la mise à jour du stagiaire.";
              return $this->view("stagiaires/edit", ['errors' => $errors, 'data' => $data, 'id'=>$id], "admin");
          }
      } else {
          $stagiaire = User::getById($id);
          if (!$stagiaire) {
              flash("error", "Stagiaire non trouvé.");
              return $this->view("/dashboard/stagiaires", [], "admin");
          }
          return $this->view("stagiaire/edit", ['data' => $stagiaire, 'id' => $id], "admin");
      }
  }

    // Suppression d'un stagiaire
    public function delete($userId) {
        User::delete($userId);
        // Rediriger vers la liste des stagiaires
        header("Location: /stagiaires");
    }

    // Afficher les détails d'un stagiaire
    public function show($userId) {
        $user = User::getById($userId);
        $stagiaire = Stagiaire::getAllWithDetails($user['stagiaire']['id']);
        // dd($stagiaire);
        return $this->view("stagiaires/show",
         ['stagiaire' => $stagiaire], 
         "admin");
    }

    public function affectations() 
    {
      $affectations  = Affectation::getAllWithDetails();
      // dd($stagiairesTuteurs);
      return $this->view("stagiaires/affectations", 
      ["affectations" => $affectations],
      "admin");
    }

    /**
     * Affiche la page d'assignation des tuteurs à un stagiaire spécifique
     */
    public function assignTuteurs($stagiaireId) {
        // Récupérer les informations du stagiaire
        $stagiaire = Stagiaire::getById($stagiaireId);
        
        if (!$stagiaire) {
            flash("error", "Stagiaire non trouvé.");
            return $this->redirect("/dashboard/stagiaires");
        }
        
        // Récupérer tous les tuteurs disponibles
        $tuteurs = Tuteur::getAll();
        // Récupérer les tuteurs déjà assignés à ce stagiaire
        $assignedTuteurs = Tuteur::getByStagiaire($stagiaireId);
        
        // Préparer les IDs des tuteurs assignés pour faciliter la vérification dans la vue
        $assignedTuteurIds = [];
        foreach ($assignedTuteurs as $tuteur) {
            $assignedTuteurIds[] = $tuteur['id'];
        }
        // dd($assignedTuteurIds);
        $pageTitle = 'Assigner des tuteurs';
        return $this->view("stagiaires/assign_tuteurs", [
            'stagiaire' => $stagiaire,
            'tuteurs' => $tuteurs,
            'pageTitle' => $pageTitle,
            'assignedTuteurs' => $assignedTuteurs,
            'assignedTuteurIds' => $assignedTuteurIds
        ], "admin");
    }
    
    /**
     * Traite la soumission du formulaire d'assignation des tuteurs
     */
    public function processAssignTuteurs($stagiaireId) {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return $this->redirect("/stagiaire/assign-tuteurs/{$stagiaireId}");
        }
        
        $tuteurIds = $_POST['tuteur_ids'] ?? [];
        $replaceExisting = isset($_POST['replace_existing']) && $_POST['replace_existing'] == '1';
        
        try {
            // Si on remplace les assignations existantes, supprimer les anciennes
            if ($replaceExisting) {
                Tuteur::removeAllAssignments($stagiaireId);
            }
            
            // Ajouter les nouvelles assignations
            foreach ($tuteurIds as $tuteurId) {
                if (!Affectation::getByStagiareAndTuteur($stagiaireId, $tuteurId)) {
                    Affectation::add($stagiaireId, $tuteurId);
                }
            }
            
            flash("success", "Les tuteurs ont été assignés avec succès.");
        } catch (\Exception $e) {
            flash("error", "Erreur lors de l'assignation des tuteurs: " . $e->getMessage());
        }
        
        return $this->redirect("/stagiaire/assign-tuteurs/{$stagiaireId}");
    }
    
    /**
     * Supprime l'assignation d'un tuteur à un stagiaire
     */
    public function removeTuteur($stagiaireId, $tuteurId) {
        try {
            Tuteur::removeAssignment($stagiaireId, $tuteurId);
            flash("success", "Le tuteur a été retiré avec succès.");
        } catch (\Exception $e) {
            flash("error", "Erreur lors du retrait du tuteur: " . $e->getMessage());
        }
        
        return $this->redirect("/stagiaire/assign-tuteurs/{$stagiaireId}");
    }
}
