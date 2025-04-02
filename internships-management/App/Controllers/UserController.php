<?php 
namespace App\Controllers;

use Core\Controller;
use App\Models\Auth;
use App\Models\Stagiaire;
use App\Models\Tuteur;
use App\Models\User;
use DateInterval;
class UserController extends Controller{

  public function modifier($id)
  {
      if(Auth::isAdmin()) {
        $user = User::getById($id);
        if($user['role'] == 'stagiaire') {
          $stagiaire = Stagiaire::getByUserId($id);
          return $this->redirect('/stagiaire/modifier/'.$id);
        }
        if($user['role'] == 'tuteur') {
          $tuteur = Tuteur::getByUserId($id);
          return $this->redirect('/tuteur/modifier/'.$tuteur['id']);
        }
      }
     
      dd($user);
  }

  public function store() 
  {

    $data = [
      'nom' => 'nelson',
      'prenom' => 'arsene',
      'email' => 'nelson@gmail.com',
      'role' => 'stagiaire',
      'statut' => 'active',
      'mot_de_passe' => '123',
      'formation' => 'licence',
      'date_debut' => date_create('now')
                    ->format('Y-m-d H:i:s'),
      'date_fin' => date_create('now')
          ->add(new DateInterval('P3M'))
          ->format('Y-m-d H:i:s')
  ];
  // dd($data);
  
  // Accessing and formatting the dates
  // $dateDebut = $data['date_debut']->format('Y-m-d H:i:s');
  // $dateFin = $data['date_fin']->format('Y-m-d H:i:s');


    $data2 = [
      'nom' => 'nelson',
      'prenom' => 'arsene',
      'email' => 'tuteur@gmail.com',
      'role' => 'tuteur',
      'statut' => 'active',
      'mot_de_passe' => '123',
      'departement' => 'informatique',
      'poste' => 'dev backend',
      'experience' => 5
    ];

    User::create($data, $role='stagiaire');
      if (!Auth::isLoggedIn()) {
            $this->redirect('/auth/login');
        }
      
      // Vérifier si le formulaire a été soumis
      // if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      //     $email = $_POST['email'] ?? '';
      //     $password = $_POST['password'] ?? '';
      //     $remember = isset($_POST['remember']) ? true : false;
      //     $errors = [];
          
      //     if (empty($email)) {
      //         $errors['email'] = 'L\'adresse mail est obligatoire';
      //     }
      //     if (empty($password)) {
      //         $errors['password'] = 'Le mot de passe est obligatoire';
      //     }
          
      //     if (!empty($errors)) {
      //       return $this->view('auth/login', [
      //         'title' => 'Connexion | Internships Management',
      //         'pageTitle' => 'Connexion',
      //         'email' => $email,
      //         'errors' => $errors
      //       ],'auth');
      //     }
      //     // $user = User::getByEmail($email);
      //     $user = Auth::authenticate($email, $password);
      //     if (!$user) {
      //       return $this->view('auth/login', [
      //             'title' => 'Connexion | Internships Management',
      //             'pageTitle' => 'Connexion',
      //             'email' => $email,
      //             'error' => 'Identifiants incorrects'
      //         ],'auth');
      //     }
          
      //     // Vérifier si le compte est actif
      //     if ($user['statut'] !== 'actif') {
      //         $this->view('auth/login', [
      //             'title' => 'Connexion | Internships Management',
      //             'pageTitle' => 'Connexion',
      //             'email' => $email,
      //             'error' => 'Votre compte est désactivé'
      //         ],'auth');
      //     }

      // }
  }
}
