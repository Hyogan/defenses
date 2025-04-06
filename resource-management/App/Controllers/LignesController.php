<?php
namespace App\Controllers;

use App\Models\Auth;
use App\Models\Ligne;
use Core\Controller;
require_once __DIR__ . '/../lib/fpdf/fpdf.php';
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

public function exportPdf($params = null) {
    if (!Auth::isLoggedIn()) {
        return $this->redirect('/auth/login');
    }

    $pdf = new \FPDF();
    $pdf->AddPage('L'); // Page en mode paysage pour plus d'espace

    $imagePath = __DIR__ . '/../../public/logo-camrail.jpeg'; // Adjust the path to your image
    if (file_exists($imagePath)) {
        $pdf->Image($imagePath, 10, 10, 30); // x, y, width
    } else {
        $pdf->Cell(0, 10, 'Image not found', 0, 1, 'R');
    }
    // Header
    $pdf->SetFont('Arial', 'B', 20);
    $pdf->Cell(0, 10, 'Rapport des Lignes', 0, 1, 'C');
    $pdf->Ln(10);

    // Table Header
    $headerY = $pdf->GetY();
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(10, 10, 'ID', 1);
    $pdf->Cell(30, 10, 'Type', 1);
    $pdf->Cell(30, 10, 'Numero', 1);
    $pdf->Cell(30, 10, 'Marque', 1);
    $pdf->Cell(40, 10, 'Proprietaire', 1);
    $pdf->Cell(20, 10, 'Port', 1);
    $pdf->Cell(25, 10, 'Bandeau', 1);
    $pdf->Cell(25, 10, 'Fusible', 1);
    $pdf->Cell(25, 10, 'Jarret.', 1);
    $pdf->Ln();

    // Table Data
    $pdf->SetFont('Arial', '', 10);
    $lignes = Ligne::getAll();
    if ($lignes) {
      $rowHeight = 10; // Height of each row
      $pageHeight = $pdf->GetPageHeight() - 30; // Leave some marginc
      $y = $pdf->GetY();
      foreach ($lignes as $ligne) {
        if ($y + $rowHeight > $pageHeight) {
            $pdf->AddPage('L'); // Add a new page
            $pdf->SetY($headerY); // Reset to the header position
            // Redraw the header
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(10, 10, 'ID', 1);
            $pdf->Cell(30, 10, 'Type', 1);
            $pdf->Cell(30, 10, 'Numero', 1);
            $pdf->Cell(30, 10, 'Marque', 1);
            $pdf->Cell(40, 10, 'Proprietaire', 1);
            $pdf->Cell(20, 10, 'Port', 1);
            $pdf->Cell(25, 10, 'Bandeau', 1);
            $pdf->Cell(25, 10, 'Fusible', 1);
            $pdf->Cell(25, 10, 'Jarret.', 1);
            $pdf->Ln();
            $pdf->SetFont('Arial', '', 10);
            $y = $pdf->GetY();
        }

        $pdf->Cell(10, $rowHeight, $ligne['id'], 1);
        $pdf->Cell(30, $rowHeight, $ligne['type_ligne'], 1);
        $pdf->Cell(30, $rowHeight, $ligne['numero_ligne'], 1);
        $pdf->Cell(30, $rowHeight, $ligne['marque_poste'], 1);
        $pdf->Cell(40, $rowHeight, $ligne['nom_proprietaire'], 1);
        $pdf->Cell(20, $rowHeight, $ligne['numero_port'], 1);
        $pdf->Cell(25, $rowHeight, $ligne['numero_bandeau'], 1);
        $pdf->Cell(25, $rowHeight, $ligne['numero_fusible'], 1);
        $pdf->Cell(25, $rowHeight, $ligne['numero_jarretiere'], 1);
        $pdf->Ln();
        $y += $rowHeight;
    }
    } else {
        $pdf->Cell(0, 10, 'Aucune ligne trouvée.', 0, 1);
    }

    $pdf->Output('rapport_lignes.pdf', 'I');
}
public function imprimer($id) {
  if (!Auth::isLoggedIn()) {
      return $this->redirect('/auth/login');
  }

  $pdf = new \FPDF();
  $pdf->AddPage();

  // Header 
  $imagePath = __DIR__ . '/../../public/logo-camrail.jpeg'; // Adjust the path to your image
  if (file_exists($imagePath)) {
      $pdf->Image($imagePath, 10, 10, 30); // x, y, width
  } else {
      $pdf->Cell(0, 10, 'Image not found', 0, 1, 'R');
  }

  $pdf->SetFont('Arial', 'B', 40);
  $pdf->Cell(0, 10, 'CAMRAIL', 0, 1, 'C');
  // $pdf->Ln(10);
  $pdf->SetFont('Arial', 'B', 20);
  $pdf->Cell(0, 10, 'Details d\'une Ligne', 0, 1, 'C');

  $pdf->SetFont('Arial', 'B', 12);
  $ligne = Ligne::getById($id);
  if ($ligne) {
      foreach ($ligne as $key => $value) {
          if ($key !== 'id') {
              $pdf->Cell(40, 10, ucfirst(str_replace('_', ' ', $key)) . ':', 1);
              $pdf->Cell(0, 10, $value, 1);
              $pdf->Ln();
          }
      }
  } else {
      $pdf->Cell(0, 10, 'Ligne non trouvée.', 0, 1);
  }

  $pdf->Output('detail_ligne.pdf', 'I');
}
}
