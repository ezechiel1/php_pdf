<?php
session_start();
require "fpdf/fpdf.php";
require_once '../core/db.php';
$db = new DB();

/**
 * 
 */
class myPDF extends FPDF
{

  

  function header()
  {
    $this->Image('aides.png',130,6,50);
    $this->Cell(280,5,'',0,3,'C');
    $this->SetFont('arial','B',13);
    $this->Cell(280,6,'',0,4,'C');
    $this->Cell(280,6,'',0,4,'C');
    $this->Cell(290,2,'BON DE COMMANDE',0,0,'C');
    $this->Ln();
    $this->SetFont('Times','',12);
    $this->Ln();
  }
  function footer()
  {
    $this->SetY(-15);
    $this->SetFont('cambria','B',15);
    $this->Cell(0,15,'Page'.$this->PageNo().'/{nb}',0,0,'C');
    $this->Ln();
  }
   function headerTable()
  {
  	
    $this->cell(275,6,'',0,1,'C');
    $this->SetFont('arial','B',11);
    $this->cell(500,4,'No:  '.$_REQUEST['code'],0,1,'C'); 

    $this->Cell(190,5,iconv('UTF-8', 'windows-1252',"Nous soussignés : AIDES/ GOMA (client), reconnais avoir passé la commande  ci-après :"),0,1,'C');
    $this->Ln();
    $this->SetFont('arial','B',11);
    $this->Cell(15,5,'No.',1,0,'C');
    $this->Cell(67,5,'ARTICLE COMMANDE',1,0,'C');
    $this->Cell(52,5,'QTE',1,0,'C');
    $this->Cell(48,5,'UNITE',1,0,'C');
    $this->Cell(48,5,'P.U',1,0,'C');
    $this->Cell(48,5,'P.T',1,0,'C');
    $this->Ln();
  }
  function viewTable()
  {
    $db = new DB();
      $condition =array 
      (                                
       'where'=>array('Order_Receive_ID' => $_REQUEST['code'],
                      'Type'=>'Ordered',),               
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

  	$this->cell(375,0,'',0,1,'C');
  	$this->SetFont('arial','B',12);
    $this->Cell(15,6,$row,1,0,'C');
    $this->Cell(67,6,$article,1,0,'C');
    $this->Cell(52,6,$component['Request_Order_Quantity'],1,0,'C');
      $this->Cell(48,6,$kg,1,0,'C');
    $this->Cell(48,6,$PU,1,0,'C');
    $this->Cell(48,6,($component['Request_Order_Quantity']*$PU) ,1,1,'C');

   
     endforeach;

      else:

        endif;

   
   //  	//Display the total here
   //  $this->cell(375,0,'',0,1,'C');
  	// $this->SetFont('arial','B',12);
   //  $this->Cell(230,6,'TOTAL',1,0,'B');
   //  $this->Cell(48,6,'',1,1,'C');
    $this->Ln();
     $this->Ln();
  }

  //More details
  function moreDetails()
  {
    $db = new DB();

 $condition =array 
                (
                   'order_by'=>'ID desc',
                  'where'=>array('Pgrs'=>'Done','Order_Number'=>$_REQUEST['code'],'Type'=>'Order'), 
                  
                );
           $Data = $db->getRows('aidesong_order_receive',$condition); 
if(!empty($Data)): $count = 0; foreach($Data as $data): $count++;
  	
    $this->SetFont('arial','B',12);
  	//Motif de commande
    $this->Cell(65,5,'* Motif de la commande : ',0,0,'B');
      $this->SetFont('arial','',12);
    $this->Cell(200,5,$data['Order_Motif'],0,1);
    	//fin motif de commande
    //Fournisseur
     $this->SetFont('arial','B',12);
    $this->Cell(65,5,'* Fournisseur :  ',0,0,'B');
     $condition =array 
      (                                
       'where'=>array('ID' => $data['Fournisseur_ID'], ),               
      );
 $supplies = $db->getRows('aidesong_fournisseur',$condition);
 if(!empty($supplies)): foreach($supplies as $supply):
   $this->SetFont('arial','',12);
    $this->Cell(200,5,$supply['Name'],0,1);
   
         $this->SetFont('arial','B',12);
    //Adresse du fournisseur
    $this->Cell(64,5,'* Adresse du fournisseur  : ',0,0,'B');

         $this->SetFont('arial','',12);
    $this->Cell(205,5,$supply['Adress'].'  / '.$supply['Telephone'],0,1);

     endforeach;

      else:

        endif;

     endforeach;

      else:

        endif;

    //Conditions
    $this->Cell(70,5,'* Conditions : ',0,1,'B');
    $this->SetFont('arial','B',11);
    $this->Cell(65,5,'  - Delai de livraison : ........ ',0,0,'B');
    $this->Cell(12,4,' ',1,0,'B');
    $this->Cell(22,5,'  jour (s), ',0,0,'B');
    $this->Cell(12,4,' ',1,0,'B');
    $this->Cell(19,5,' mois, ',0,0,'B');
    $this->Cell(12,4,' ',1,0,'B');
    $this->Cell(20,5,' an (s), ',0,0,'B');
    $this->Cell(12,4,' ',1,0,'B');
    $this->Cell(42,5,' avant commande,',0,0,'B');
    $this->Cell(12,4,' ',1,0,'B');
    $this->Cell(20,5,'  apres  la commande.',0,1,'B');
    $this->Cell(64,5,'  -	 Paiement de la facture : ',0,0,'B');
    $this->Cell(12,4,' ',1,0,'B');
    $this->Cell(62,5,iconv('UTF-8', 'windows-1252',"Totalité à la commande, "),0,0,'B');
    $this->Cell(12,4,' ',1,0,'B');
    $this->Cell(47,5,' .............. tranche (s), ',0,0,'B');
    $this->Cell(12,4,' ',1,0,'B');
    $this->Cell(42,5,' avant la livraison, ',0,0,'B');
    $this->Cell(12,4,' ',1,1,'B');
    $this->Cell(48,5,iconv('UTF-8', 'windows-1252',"après la livraison"),0,0,'B');
    $this->Cell(12,4,' ',1,0,'B');
    $this->Cell(52,5, iconv('UTF-8', 'windows-1252',"avant et après la livraison."),0,1,'B');
    $this->Cell(70,5,'  -	Lieu de livraison : ................................................................................................................................................................................................................................ ',0,1,'B');
    $this->Cell(90,5,'  -	Moyen de transport  à la charge du : ',0,0,'B');
    $this->Cell(12,4,' ',1,0,'B');
    $this->Cell(32,5,' Fournisseur, ',0,0,'B');
    $this->Cell(12,4,' ',1,0,'B');
    $this->Cell(30,5,' client (e). ',0,1,'B');
    
    $this->SetFont('arial','B',10);
    $this->Cell(70,5, iconv('UTF-8', 'windows-1252',"Les deux parties (fournisseur et l’acheteur), acceptent  les conditions et s’engages à respecter les clauses définies pour cette commande. "),0,1,'B');
   //DATE 
    $this->SetFont('arial','B',11);
    $this->Cell(195,5,' ',0,0,'B');
    $this->Cell(60,5, iconv('UTF-8', 'windows-1252',"Fait à ............, le ......./ ........./ 20......... "),0,1,'B');
    $this->Ln();
    //signature
    $this->SetFont('arial','B',12);
    $this->Cell(100,5,' ',0,0,'B');
    $this->Cell(60,5,' Signatures des parties ',0,1,'B');
    $this->Cell(70,5,' FOURNISSEUR : ',0,0,'B');
    $this->Cell(130,5,' ',0,0,'B');
    $this->Cell(80,5,' AIDES/ ADMIN & LOGISTIQUE : ',0,1,'B');

    $this->Ln();
  }
	
}

 $pdf=new myPDF();
  $pdf->AliasNbPages();
  $pdf->AddPage('L','A4',0);
  $pdf->headerTable();
  $pdf->viewTable();
  $pdf->moreDetails();
  $pdf->Output();

?>