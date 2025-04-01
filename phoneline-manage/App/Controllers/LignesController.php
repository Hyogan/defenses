<?php
namespace App\Controllers;
use App\Models\Ligne;
use Core\Controller;
class LignesController extends Controller{
  public function ajouter()
  {
    return $this->view('lignes/ajouter',[],'admin');
  }
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ligne = [];
            $ligne['type_ligne'] = $_POST['type_ligne'];
            $ligne['numero_ligne'] = $_POST['numero_ligne'];
            $ligne['marque_poste'] = $_POST['marque_poste'];
            $ligne['nom_proprietaire'] = $_POST['nom_proprietaire'];
            $ligne['numero_port'] = $_POST['numero_port'];
            $ligne['numero_bandeau'] = $_POST['numero_bandeau'];
            $ligne['numero_fusible'] = $_POST['numero_fusible'];
            $ligne['numero_jarretiere'] = $_POST['numero_jarretiere'];
            Ligne::create($ligne);
            $this->redirect('/dashboard');
          }
    }
    public function edit($id)
    {
      $ligne = Ligne::getById($id);
      // dd($ligne);
      if(!$ligne) {
        return $this->redirect('/lignes');
      }
      return $this->view('lignes/modifier',['ligne' => $ligne],'admin');
    }
    public function update($id) 
    {
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $ligne = [];
        $ligne['type_ligne'] = $_POST['type_ligne'];
        $ligne['numero_ligne'] = $_POST['numero_ligne'];
        $ligne['marque_poste'] = $_POST['marque_poste'];
        $ligne['nom_proprietaire'] = $_POST['nom_proprietaire'];
        $ligne['numero_port'] = $_POST['numero_port'];
        $ligne['numero_bandeau'] = $_POST['numero_bandeau'];
        $ligne['numero_fusible'] = $_POST['numero_fusible'];
        $ligne['numero_jarretiere'] = $_POST['numero_jarretiere'];
        Ligne::update($id,$ligne);
        $this->redirect('/dashboard');
      }
      $this->redirect('/lignes');
}

    public function supprimer($id) {
      $ligne = Ligne::getById($id);
      if(!$ligne) {
        flash('error','la ligne choisie n\'existe pas ');
        return $this->redirect('/lignes');
      }
      Ligne::delete($id);
      return $this->redirect('/lignes');
    }

    public function liste() 
    {
        $lignes = Ligne::getAll();

        // dd($lignes);
        return $this->view('lignes/liste',['lignes' => $lignes],'admin');
    }
    public function details($id)
     {
      $ligne = Ligne::getById($id);
      // dd($ligne);
      if(!$ligne) {
        flash('error','la ligne choisie n\'existe pas ');
        return $this->redirect('/lignes');
      }
      return $this->view('/lignes/details',['ligne' => $ligne],'admin');
    }
}
