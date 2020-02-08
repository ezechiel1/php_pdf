<?php
session_start();
require "fpdf/fpdf.php";
require_once '../core/db.php';
$db = new DB();
class myPDF extends FPDF
{
  function header()
  {
    $this->Image('aides.png',130,6,50);
    $this->Cell(280,5,'',0,3,'C');
    $this->SetFont('arial','B',12);
    $this->Cell(280,6,'',0,4,'C');
    $this->Cell(280,6,'',0,4,'C');
    $this->Cell(290,2,'BON DE SORTIE',0,0,'C');
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
  function FisrtTable()
  {
  	$this->cell(275,5,'',0,1,'C');
    $this->SetFont('arial','B',12);
   
    $this->Cell(150,8,'Demandeur : ',0,0,'');
    $this->Cell(120,8,'Numero de Requisition ',0,0,'');
    $this->Ln();
  }

  function SecondTable()
  {
  	$this->cell(275,5,'',0,1,'C');
    $this->SetFont('arial','B',12);
    $this->Cell(12,8,'No.',1,0,'C');
    $this->Cell(35,8,' QTE dmndee',1,0,'C');
    $this->Cell(25,8,'QTE Livree',1,0,'C');
    $this->Cell(20,8,'Unité',1,0,'C');
    $this->Cell(40,8,'Emballage de :',1,0,'C');
    $this->Cell(25,8,'Total',1,0,'C');
    $this->Cell(30,8,'Pds.Unit',1,0,'C');
    $this->Cell(33,8,'Pds.Tot',1,0,'C');
    $this->Cell(35,8,'DESIGNATION',1,0,'C');
    $this->Cell(20,8,'OBS',1,1,'C');

   
		$db = new DB();
    $condition =array 
    (                                
       'where'=>array('Order_Receive_ID' => $_REQUEST['code'] ,
                      'Type'=>'Received',),               
    );
$components = $db->getRows('aidesong_article_log_operation',$condition);
if(!empty($components)): $row = 0; foreach($components as $component): $row++; 

// Statement to get the name of the article on the order  
 $article="";
$condition =array 
    (                                
     'where'=>array('ID' => $component['ArticleID'], ),               
    );
$items = $db->getRows('aidesong_article',$condition);
if(!empty($items)): foreach($items as $item):  $article = $item['Name']; $kg=$item['Unit'];
$PU=$item['Punit'];

  endforeach;

    else:

      endif;
      $this->Cell(15,10,$row,1,0,'C');
      $this->Cell(75,10,$article,1,0,'C');
      $this->Cell(30,10,$component['Request_Order_Quantity'],1,0,'C');
      $this->cell(30,10,$component['Issue_Receive_Quantity'],1,0,'C');
      $this->Cell(35,10,$kg,1,0,'C');
      $this->cell(45,10,$component['Issue_Receive_Price'],1,0,'C');
      // $this->cell(35,10,'',1,0,'C');
      $this->cell(45,10,$component['Issue_Receive_Price']*$component['Issue_Receive_Quantity'],1,0,'C');
      // $this->cell(25,10,'',1,0,'C');
      $this->LN();
endforeach;

else:

endif;


  }
  	//code for the third table
  function ThirdTable()
  {
  	$this->cell(275,5,'',0,1,'C');
    $this->SetFont('arial','B',12);
    $this->Cell(70,8,'ARTICLE ',1,0,'C');
    $this->Cell(40,8,'Nom',1,0,'C');
    $this->Cell(35,8,'Fonction',1,0,'C');
    $this->Cell(30,8,'Date ',1,0,'C');
    $this->Cell(30,8,'Heure ',1,0,'C');
    $this->Cell(40,8,'Organisation',1,0,'C');
    $this->Cell(30,8,'Signature',1,1,'C');

    $this->Cell(70,8,'(1). Livré par : ',1,0,'C');
    $this->Cell(40,8,'',1,0,'C');
    $this->Cell(35,8,'',1,0,'C');
    $this->Cell(30,8,' ',1,0,'C');
    $this->Cell(30,8,' ',1,0,'C');
    $this->Cell(40,8,'',1,0,'C');
    $this->Cell(30,8,'',1,1,'C');

    $this->Cell(70,8,' (2). Reçu par :',1,0,'C');
    $this->Cell(40,8,'',1,0,'C');
    $this->Cell(35,8,'',1,0,'C');
    $this->Cell(30,8,' ',1,0,'C');
    $this->Cell(30,8,' ',1,0,'C');
    $this->Cell(40,8,'',1,0,'C');
    $this->Cell(30,8,'',1,1,'C');

    $this->Cell(70,8,'Remarque du chauffeur ',1,0,'C');
    $this->Cell(205,8,'',1,1,'C');

    $this->Cell(70,8,'Approbation du responsable ',1,0,'C');
    $this->Cell(205,8,'',1,1,'C');
  }

}

  $pdf=new myPDF();
  $pdf->AliasNbPages();
  $pdf->AddPage('L','A4',0);
  $pdf->FisrtTable();
  $pdf->SecondTable();
  $pdf->ThirdTable();
  $pdf->Output();
