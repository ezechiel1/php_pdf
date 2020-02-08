<?php
// require 'fpdf/fpdf.php';

session_start();
require "fpdf/fpdf.php";
require_once '../core/db.php';
$db = new DB();


//class
class myPDF extends FPDF
{
	function headerTable()
	{
		$this->Image('aides.png',130,6,50);
    $this->Cell(280,5,'',0,3,'C');
    $this->SetFont('arial','B',12);
    $this->Cell(280,6,'',0,4,'C');
    $this->Cell(280,6,'',0,4,'C');
    $this->Cell(290,2,'BON DE RECEPTION',0,0,'C');
    $this->Ln();
    $this->SetFont('Times','',12);
    $this->Ln();
	}
	function bonReception1()
	{
				$db = new DB();



		
		$this->Cell(375,0,'',0,1,'C');
		$this->setFont('arial','B',11);
		$this->cell(520,7,'No......./20.....',0,1,'C');
		$this->cell(520,7,'Date :....../....../ 20.....',0,0,'C');
		$this->ln();
		$condition =array 
		(
			 'order_by'=>'ID desc',
			'where'=>array('Pgrs'=>'Done','Receive_Number'=>$_REQUEST['rcode'],'Type'=>'Received'), 
		);
$Data = $db->getRows('aidesong_order_receive',$condition); 
if(!empty($Data)): $count = 0; foreach($Data as $data): $count++;

$condition =array 
      (                                
       'where'=>array('ID' => $data['Fournisseur_ID'], ),               
      );
 $supplies = $db->getRows('aidesong_fournisseur',$condition);
 if(!empty($supplies)): foreach($supplies as $supply):
	$this->SetFont('arial','',13);
		$this->cell(140,10,'Fournisseur :  '.$supply['Name'],1,0,'	');
	endforeach;

else:

	endif;


		$this->cell(140,10,'Client :  AIDES GOMA',1,0,'');
		$this->ln();
		$this->cell(140,10,'Etat de besoin :',1,0,'');
		$this->cell(140,10,'Achat effectue le,...../....../.....',1,0,'');
		$this->ln();
		$this->cell(70,10,'Bon de livraison No: '.$data['Delivery_Number'],1,0,'');
		$this->cell(70,10,'Etabli le : ' .$data['Receive_Date'],1,0,'');
		$this->cell(70,10,'Facture No:',1,0,'');
		$this->cell(70,10,'Etabli le ....  /.....   /.....   :',1,1,'');
		
	endforeach;

else:	

	endif;

	}

	function bonReception2()
	{
		$this->cell(60,10,'',0,1,'C');
		$this->setFont('arial','B',11);
		$this->cell(15,10,'No..',1,0,'C');
		$this->cell(75,10,'Designation',1,0,'C');
		$this->cell(30,10,'Qte Cmdee',1,0,'C');
		$this->cell(30,10,'Qte recu',1,0,'C');
		$this->cell(35,10,'Unite',1,0,'C');
		// $this->cell(35,10,'Emballage',1,0,'C');
		// $this->cell(25,10,'Total',1,0,'C');
		$this->cell(45,10,'PU',1,0,'C');
		$this->cell(45,10,'PT',1,0,'C');
		$this->LN();
		


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
	function footerR()
	{
		$this->setFont('arial','B',11);
		$this->cell(50,10,'',0,1,'C');
		$this->cell(50,10,'',0,1,'C');


		$this->cell(60,10,'',1,0,'C');
		$this->cell(50,10,'Noms',1,0,'C');
		$this->cell(50,10,'Fonction',1,0,'C');
		$this->cell(50,10,'Organisation',1,0,'C');
		$this->cell(30,10,'Date',1,0,'C');
		$this->cell(40,10,'Signature',1,1,'C');

		$this->cell(60,10,'Recu par:',1,0,'C');
		$this->cell(50,10,'',1,0,'C');
		$this->cell(50,10,'',1,0,'C');
		$this->cell(50,10,'',1,0,'C');
		$this->cell(30,10,'',1,0,'C');
		$this->cell(40,10,'',1,1,'C');

		$this->cell(60,10,'livre par:',1,0,'C');
		$this->cell(50,10,'',1,0,'C');
		$this->cell(50,10,'',1,0,'C');
		$this->cell(50,10,'',1,0,'C');
		$this->cell(30,10,'',1,0,'C');
		$this->cell(40,10,'',1,1,'C');

		$this->cell(60,10,'Approuve par:',1,0,'C');
		$this->cell(50,10,'',1,0,'C');
		$this->cell(50,10,'',1,0,'C');
		$this->cell(50,10,'',1,0,'C');
		$this->cell(30,10,'',1,0,'C');
		$this->cell(40,10,'',1,1,'C');

		$this->setFont('arial','B',8);
		$this->cell(60,10,'Remarque(s):',1,0,'C');
		$this->cell(220,10,'-Articles conformes a la commande :Oui/Non(encercler la bonne reponse)
							-Bon de livraison, et facture en annexe :Oui/Non(encercler la bonne reponse)',1,1,'C');
	
	
	}
}
//WHEN DISPLAY
$pdf=new myPDF();
$pdf->AliasNbPages();
$pdf->AddPage('L','A4',0);
$pdf->headerTable();
$pdf->bonReception1();
$pdf->bonReception2();
$pdf->footerR();
$pdf->Output();
?>