<?php
session_start();
require "fpdf/fpdf.php";
/**
 * 
 */
class myPDF extends FPDF
{
  function header()
  {
    $this->Image('aides.png',130,6,50);
    $this->Cell(280,5,'',0,3,'C');
    $this->SetFont('arial','B',12);
    $this->Cell(280,6,'',0,4,'C');
    $this->Cell(280,6,'',0,4,'C');
    $this->Cell(290,2,'LISTE DU PERSONNEL',0,0,'C');
    $this->Ln();
    $this->SetFont('Times','',12);
    $this->Ln();
  }
  function footer()
  {
    $this->SetY(-15);
    $this->SetFont('cambria','B',14);
    $this->Cell(0,15,'Page'.$this->PageNo().'/{nb}',0,0,'C');
    $this->Ln();
  }
  function viewTable()
  {
    $this->cell(275,5,'',0,1,'C');
    $this->SetFont('arial','B',12);
    $this->Cell(15,7,'No.',1,0,'C');
    $this->Cell(30,7,' Matricule',1,0,'C');
    $this->Cell(30,7,' Nom',1,0,'C');
    $this->Cell(30,7,'PostNom',1,0,'C');
    $this->Cell(30,7,'Niveau Etude',1,0,'C');
    $this->Cell(25,7,'Project',1,0,'C');
    $this->Cell(27,7,'Femme',1,0,'C');
    $this->Cell(30,7,'Phone',1,0,'C');
    $this->Cell(30,7,'Nationalite',1,0,'C');
    $this->Cell(30,7,'Adress',1,1,'C');

    $this->Cell(15,7,'',1,0,'C');
    $this->Cell(30,7,' ',1,0,'C');
    $this->Cell(30,7,' ',1,0,'C');
    $this->Cell(30,7,'',1,0,'C');
    $this->Cell(30,7,'',1,0,'C');
    $this->Cell(25,7,'',1,0,'C');
    $this->Cell(27,7,'',1,0,'C');
    $this->Cell(30,7,'',1,0,'C');
    $this->Cell(30,7,'',1,0,'C');
    $this->Cell(30,7,'',1,1,'C');

    $this->Cell(15,7,'',1,0,'C');
    $this->Cell(30,7,' ',1,0,'C');
    $this->Cell(30,7,' ',1,0,'C');
    $this->Cell(30,7,'',1,0,'C');
    $this->Cell(30,7,'',1,0,'C');
    $this->Cell(25,7,'',1,0,'C');
    $this->Cell(27,7,'',1,0,'C');
    $this->Cell(30,7,'',1,0,'C');
    $this->Cell(30,7,'',1,0,'C');
    $this->Cell(30,7,'',1,1,'C');

    $this->Cell(15,7,'',1,0,'C');
    $this->Cell(30,7,' ',1,0,'C');
    $this->Cell(30,7,' ',1,0,'C');
    $this->Cell(30,7,'',1,0,'C');
    $this->Cell(30,7,'',1,0,'C');
    $this->Cell(25,7,'',1,0,'C');
    $this->Cell(27,7,'',1,0,'C');
    $this->Cell(30,7,'',1,0,'C');
    $this->Cell(30,7,'',1,0,'C');
    $this->Cell(30,7,'',1,1,'C');

    $this->Cell(15,7,'',1,0,'C');
    $this->Cell(30,7,' ',1,0,'C');
    $this->Cell(30,7,' ',1,0,'C');
    $this->Cell(30,7,'',1,0,'C');
    $this->Cell(30,7,'',1,0,'C');
    $this->Cell(25,7,'',1,0,'C');
    $this->Cell(27,7,'',1,0,'C');
    $this->Cell(30,7,'',1,0,'C');
    $this->Cell(30,7,'',1,0,'C');
    $this->Cell(30,7,'',1,1,'C');

    $this->Cell(15,7,'',1,0,'C');
    $this->Cell(30,7,' ',1,0,'C');
    $this->Cell(30,7,' ',1,0,'C');
    $this->Cell(30,7,'',1,0,'C');
    $this->Cell(30,7,'',1,0,'C');
    $this->Cell(25,7,'',1,0,'C');
    $this->Cell(27,7,'',1,0,'C');
    $this->Cell(30,7,'',1,0,'C');
    $this->Cell(30,7,'',1,0,'C');
    $this->Cell(30,7,'',1,1,'C');

    $this->Cell(15,7,'',1,0,'C');
    $this->Cell(30,7,' ',1,0,'C');
    $this->Cell(30,7,' ',1,0,'C');
    $this->Cell(30,7,'',1,0,'C');
    $this->Cell(30,7,'',1,0,'C');
    $this->Cell(25,7,'',1,0,'C');
    $this->Cell(27,7,'',1,0,'C');
    $this->Cell(30,7,'',1,0,'C');
    $this->Cell(30,7,'',1,0,'C');
    $this->Cell(30,7,'',1,1,'C');

    $this->Cell(15,7,'',1,0,'C');
    $this->Cell(30,7,' ',1,0,'C');
    $this->Cell(30,7,' ',1,0,'C');
    $this->Cell(30,7,'',1,0,'C');
    $this->Cell(30,7,'',1,0,'C');
    $this->Cell(25,7,'',1,0,'C');
    $this->Cell(27,7,'',1,0,'C');
    $this->Cell(30,7,'',1,0,'C');
    $this->Cell(30,7,'',1,0,'C');
    $this->Cell(30,7,'',1,1,'C');

    $this->Cell(15,7,'',1,0,'C');
    $this->Cell(30,7,' ',1,0,'C');
    $this->Cell(30,7,' ',1,0,'C');
    $this->Cell(30,7,'',1,0,'C');
    $this->Cell(30,7,'',1,0,'C');
    $this->Cell(25,7,'',1,0,'C');
    $this->Cell(27,7,'',1,0,'C');
    $this->Cell(30,7,'',1,0,'C');
    $this->Cell(30,7,'',1,0,'C');
    $this->Cell(30,7,'',1,1,'C');

    $this->Cell(15,7,'',1,0,'C');
    $this->Cell(30,7,' ',1,0,'C');
    $this->Cell(30,7,' ',1,0,'C');
    $this->Cell(30,7,'',1,0,'C');
    $this->Cell(30,7,'',1,0,'C');
    $this->Cell(25,7,'',1,0,'C');
    $this->Cell(27,7,'',1,0,'C');
    $this->Cell(30,7,'',1,0,'C');
    $this->Cell(30,7,'',1,0,'C');
    $this->Cell(30,7,'',1,1,'C');

    $this->Cell(15,7,'',1,0,'C');
    $this->Cell(30,7,' ',1,0,'C');
    $this->Cell(30,7,' ',1,0,'C');
    $this->Cell(30,7,'',1,0,'C');
    $this->Cell(30,7,'',1,0,'C');
    $this->Cell(25,7,'',1,0,'C');
    $this->Cell(27,7,'',1,0,'C');
    $this->Cell(30,7,'',1,0,'C');
    $this->Cell(30,7,'',1,0,'C');
    $this->Cell(30,7,'',1,1,'C');

    $this->Cell(15,7,'',1,0,'C');
    $this->Cell(30,7,' ',1,0,'C');
    $this->Cell(30,7,' ',1,0,'C');
    $this->Cell(30,7,'',1,0,'C');
    $this->Cell(30,7,'',1,0,'C');
    $this->Cell(25,7,'',1,0,'C');
    $this->Cell(27,7,'',1,0,'C');
    $this->Cell(30,7,'',1,0,'C');
    $this->Cell(30,7,'',1,0,'C');
    $this->Cell(30,7,'',1,1,'C');

    $this->Cell(15,7,'',1,0,'C');
    $this->Cell(30,7,' ',1,0,'C');
    $this->Cell(30,7,' ',1,0,'C');
    $this->Cell(30,7,'',1,0,'C');
    $this->Cell(30,7,'',1,0,'C');
    $this->Cell(25,7,'',1,0,'C');
    $this->Cell(27,7,'',1,0,'C');
    $this->Cell(30,7,'',1,0,'C');
    $this->Cell(30,7,'',1,0,'C');
    $this->Cell(30,7,'',1,1,'C');

    $this->Cell(15,7,'',1,0,'C');
    $this->Cell(30,7,' ',1,0,'C');
    $this->Cell(30,7,' ',1,0,'C');
    $this->Cell(30,7,'',1,0,'C');
    $this->Cell(30,7,'',1,0,'C');
    $this->Cell(25,7,'',1,0,'C');
    $this->Cell(27,7,'',1,0,'C');
    $this->Cell(30,7,'',1,0,'C');
    $this->Cell(30,7,'',1,0,'C');
    $this->Cell(30,7,'',1,1,'C');

    $this->Cell(15,7,'',1,0,'C');
    $this->Cell(30,7,' ',1,0,'C');
    $this->Cell(30,7,' ',1,0,'C');
    $this->Cell(30,7,'',1,0,'C');
    $this->Cell(30,7,'',1,0,'C');
    $this->Cell(25,7,'',1,0,'C');
    $this->Cell(27,7,'',1,0,'C');
    $this->Cell(30,7,'',1,0,'C');
    $this->Cell(30,7,'',1,0,'C');
    $this->Cell(30,7,'',1,1,'C');

  }

}
  $pdf=new myPDF();
  $pdf->AliasNbPages();
  $pdf->AddPage('L','A4',0);
  $pdf->viewTable();
  $pdf->Output();
