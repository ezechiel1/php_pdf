<?php

require_once '../core/db.php';
$db = new DB();


require ("fpdf/fpdf.php");




class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
   $this->Image('../aides2.png',90,5,120);
    
    $this->Ln(30);
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','B',10);
    // Page number
    $this->Cell(0,10,date('d-M-Y'),0,0,'L'); 

    //$this->Cell(0,10,$_SESSION['Names'],0,0,'C');
  $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,1,'R');
   $this->Ln();
   // $this->Cell(0,10,' Produced by '.$_SESSION['Names'],0,0,'L');
     //$this->Ln();
    //$this->Cell(120,5,'',0);
     //$this->Cell(110,5,'Produced By '.,0);
     //$this->Cell(120,5,'',0);
       
   
    
   // 
}
}


  
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage(L,A4);
$pdf->SetFont('Arial','B',10);  
$counter=1;

if ($_REQUEST['cm']="4")
{
    $name="Avril";

}

else if ($_REQUEST['cm']="6")
{
    $name="Juin";

}

else if ($_REQUEST['cm']="5")
{
    $name="Mai";

}
else if ($_REQUEST['cm']="7")
{
    $name="juillet";

}

else if ($_REQUEST['cm']="8")
{
    $name="Aout";

}

else if ($_REQUEST['q']="1")
{
    $name="janvier";

}


else if ($_REQUEST['cm']="2")
{
    $name="Fevrier";

}

else if ($_REQUEST['cm']="3")
{
    $name="Mars";

}

else if ($_REQUEST['cm']="9")
{
    $name="Septembre";

}

else if ($_REQUEST['cm']="10")
{
    $name="Octobre";

}


else if ($_REQUEST['cm']="11")
{
    $name="Novembre";

}

else if ($_REQUEST['cm']="12")
{
    $name="Decembre";

}


                                    $pdf->SetFont('Arial','B',15);
                                     $pdf->setFillColor(230,230,230); 
                                    $pdf->Cell(0,9,'FICHE DE PAIE  PERSONEL POUR LE MOIS DE  '.$name.'   '.$_REQUEST['cy'],0,1,'C');
                                    $pdf->Ln(5);

         $condition =array 
                (
                  
                  'where'=> array('ID' => $_REQUEST['q'], )
                );
            $users = $db->getRows('aidesong_staff',$condition);
            if(!empty($users)): $count = 0; foreach($users as $user): 

                                       $pdf->Cell(15,9,'',0,'C');
                                       $pdf->SetFont('Arial','B',15);
                                       $pdf->Cell(100,9,'Nom du personnel ',1,'C');
                                       $pdf->SetFont('Arial','',15);
                                       $pdf->Cell(150,9,$user['Firstname'].' '.$user['Lastname'].'  '.$user['Surname'],1,'C');
                                       $pdf->Ln();


                                       $pdf->Cell(15,9,'',0,'C');
                                       $pdf->SetFont('Arial','B',15);
                                       $pdf->Cell(100,9,'Fonction  ',1,'C');
                                       $pdf->SetFont('Arial','',15);
                                       $pdf->Cell(150,9,$user['Function'],1,'C');
                                       $pdf->Ln();



                                       $pdf->Cell(15,9,'',0,'C');
                                       $pdf->SetFont('Arial','B',15);
                                       $pdf->Cell(100,9,"Salaire de Base ",1,'C');
                                       $pdf->SetFont('Arial','',15);
                                       $pdf->Cell(150,9,$user['Salary'],1,'C');
                                       $pdf->Ln();


                                       $ctrtData = $db->getRows('aidesong_contract',$cond = array( 'order_by'=>'ID desc','select'=>'Logement,Transport,Social,Familiale,IPR','where'=>array('Staff_ID'=>$_REQUEST['q'])));
                                       if(!empty($ctrtData)) :  foreach($ctrtData as $Data): 
                                       $pdf->SetFont('Arial','B',15);
                                       $pdf->Cell(15,9,'',0,'C');
                                       $pdf->Cell(100,9,iconv('UTF-8', 'windows-1252',' Indemnité de logement'),1,'C');
                                       $pdf->SetFont('Arial','',15);
                                       $pdf->Cell(150,9,$Data['Logement'],1,'C');
                                       

                                       $pdf->Ln();


                                       $pdf->Cell(15,9,'',0,'C');
                                       $pdf->SetFont('Arial','B',15);
                                       $pdf->Cell(100,9,iconv('UTF-8', 'windows-1252','Indemnité de Transport'),1,'C');
                                       $pdf->SetFont('Arial','',15);
                                       $pdf->Cell(150,9,$Data['Transport'],1,'C');
                                       


                                       $pdf->Ln();


                                       $pdf->Cell(15,9,'',0,'C');
                                       $pdf->SetFont('Arial','B',15);
                                       $pdf->Cell(100,9,'Allocation Familiale ',1,'C');
                                       $pdf->SetFont('Arial','',15);
                                       $pdf->Cell(150,9,$Data['Familiale'],1,'C');
                                       

                                       $pdf->Ln();


                                       $pdf->Cell(15,9,'',0,'C');
                                       $pdf->SetFont('Arial','B',15);
                                       $pdf->Cell(100,9,'Salaire Brute ',1,'C');
                                       $pdf->SetFont('Arial','',15);
                                       $pdf->Cell(150,9,$Data['Familiale']+$Data['Logement']+$Data['Transport']+$user['Salary'],1,'C');
                                       $pdf->Ln();
                                       $pdf->Cell(15,9,'',0,'C');
                                       $pdf->SetFont('Arial','B',15);
                                       $pdf->Cell(100,9,iconv('UTF-8', 'windows-1252','Securité Sociale'),1,'C');
                                       $pdf->SetFont('Arial','',15);
                                       $pdf->Cell(150,9,($user['Salary']*$Data['Social']/100) ,1,'C');

                                       $pdf->Ln();


                                       $pdf->Cell(15,9,'',0,'C');
                                       $pdf->SetFont('Arial','B',15);
                                       $pdf->Cell(100,9,'IPR',1,'C');
                                       $pdf->SetFont('Arial','',15);
                                       $pdf->Cell(150,9,($user['Salary']*$Data['IPR'])/100,1,'C');
                                       $pdf->Ln();


                                       $pdf->Cell(15,9,'',0,'C');
                                       $pdf->SetFont('Arial','B',15);
                                       $pdf->Cell(100,9,'Salaire Net ',1,'C');
                                       $pdf->SetFont('Arial','',15);
                                       $pdf->Cell(150,9,($Data['Familiale']+$Data['Logement']+$Data['Transport']+$user['Salary'])-((($user['Salary']*$Data['Social'])/100)+(($user['Salary']*$Data['IPR'])/100)),1,'C');
                                       

                                       endforeach; else:
                                       endif;
                                       $pdf->Ln();
                                       

                                       $nbrDays = $db->getRows('aidesong_attendance',$cond = array( 'order_by'=>'ID desc','select'=>'Days','where'=>array('User_ID'=>$_REQUEST['q'],'Month'=>$_REQUEST['cm'],'Year'=>$_REQUEST['cy'])));
                                       if(!empty($nbrDays)) :  foreach($nbrDays as $days):$pdf->SetFont('Arial','B',15);
                                        $pdf->Cell(15,9,'',0,'C');
                                        $pdf->Cell(100,9,'Nombre Jours Presence',1,'C');
                                        $pdf->SetFont('Arial','',15);
                                        $pdf->Cell(150,9,$days['Days'],1,'C');
                                        $pdf->Ln();

                                     endforeach; else:
                                        endif;
                                       

                                        $amtPay = $db->getRows('aidesong_payment',$cond = array( 'order_by'=>'ID desc','select'=>'Montant','where'=>array('Staff_ID'=>$user['ID'],'Month'=>$_REQUEST['cm'],'Year'=>$_REQUEST['cy'])));
                                        if(!empty($amtPay)) :  foreach($amtPay as $pay): 
                                        $pdf->SetFont('Arial','B',15);
                                        $pdf->Cell(15,9,'',0,'C');
                                        $pdf->Cell(100,9,'Montant Payé',1,'C');
                                        $pdf->SetFont('Arial','',15);
                                        $pdf->Cell(150,9,$pay['Montant'],1,'C');
                                        $pdf->Ln();

                                     endforeach; else:
                                        endif;


                                       
                                    endforeach; else:   
                                    endif;
                                     
                                       $pdf->Ln();
                                       $pdf->Ln();
                                       $pdf->Cell(100,9, iconv('UTF-8', 'windows-1252',' Avis de l’hiérarchie directe '),0,'C');
                                       
                                       $pdf->Cell(90,9,'Avis du Chef du personnel',0,'C');
                                       
                                       $pdf->Cell(100,9,'Approbation de la Coordination',0,'C');




$pdf->Output(); 


?>