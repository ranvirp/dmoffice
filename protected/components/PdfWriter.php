<?php
 class PdfWriter
{
     public static function printPending($officerassigned,$outdir,$t='Landdisputes')
     {
         $sql="select distinct(landdisputes.id) as Id,* from landdisputes inner join revenue_village  inner join policestation inner join tehsil on 
landdisputes.revenuevillage=revenue_village.code and landdisputes.policestation and tehsil.code = revenue_village.tehsil_code where officerassigned=:offr";
         $rows=Yii::app()->db->createCommand($sql,array(':offr'=>$officerassigned));
          $html='<style> td{font-size:8px;}</style>';
   $html.='<table border="1">';
   $html.='<tr><td>'."रिपोर्ट का दिनांक".'</td>'.'<td>'.date('d/m/Y hh:mm').'</td>'
           .'<td>'."अधिकारी".'</td>'.'<td>'.$name.'</td>'
           . '</tr>';
    $html.='<tr><td>'."कुल लंबित भूमि विवाद".'</td>'.'<td>'.  Landdisputes::model()->countByAttributes(array('officerassigned'=>$officerassigned)).'</td></tr>';
   //$html="<h1>".Yii::t('app','Landdisputes')." pending with ".$name."</h1>";
    $html.='</table>';
   $html.="<table border='1'>";
    $html.="<tr>"
              ."<th>".'Id'.'</th>'
                ."<th>".Yii::t('app','Complainants').'</th>'
               .'<th>'.Yii::t('app','Revenuevillage').'</th>'
              .'<th>'.Yii::t('app','dispute details').'</th>'
              .'<th>'.Yii::t('app','date of registering').'</th>'
              .'</tr>';
    $html.='</table>';
    $html.='<div>';
         foreach ($rows as $row)
         {
            $html.= print_r($row,true);
         }
         $html.='</div>';
     }
 public static function printPendingLanddisputes($officerassigned,$outdir)
 {
   $officer=  Designation::model()->findByPk($officerassigned);
   $name='Not found';
   if ($officer)
      $name=$officer->name_hi;
   else 
       return "Wrong officer Name";
   $model=new Landdisputes;
   $model->unsetAttributes();
   $model->officerassigned=$officerassigned;
   $model->status=0;
   $dp =$model->search();
   //$dp->criteria=array('order'=>'policestation asc');
   $iterator = new CDataProviderIterator($dp);
   
   $html='<style> td{font-size:8px;}</style>';
   $html.='<table border="1">';
   $html.='<tr><td>'."रिपोर्ट का दिनांक".'</td>'.'<td>'.date('d/m/Y H:i:s').'</td>'
           .'<td>'."अधिकारी".'</td>'.'<td>'.$name.'</td>'
           . '</tr>';
    $html.='<tr><td>'."कुल लंबित भूमि विवाद".'</td>'.'<td>'.  Landdisputes::model()->countByAttributes(array('officerassigned'=>$officerassigned,'status'=>0)).'</td></tr>';
   //$html="<h1>".Yii::t('app','Landdisputes')." pending with ".$name."</h1>";
    $html.='</table>';
   $html.="<table border='1' style='border-spacing:0;'>";
    $html.="<tr>"
              ."<th>".'Id'.'</th>'
                ."<th>".Yii::t('app','Complainants').'</th>'
               .'<th>'.Yii::t('app','Revenuevillage').'</th>'
              .'<th>'.Yii::t('app','dispute details').'</th>'
              .'<th>'.Yii::t('app','date of registering').'</th>'
              .'</tr>';
    
   foreach($iterator as $ld)
   {
       $revenue=($ld->revVillage)?$ld->revVillage->name_hi:'missing';
       $tehsil='';
       if ($ld->revVillage)
       {
           $tehsil=$ld->revVillage->tehsilCode?$ld->revVillage->tehsilCode->name_hi:'missing';
       }
       $policestation=($ld->thana)?$ld->thana->name_hi:'missing';
       $category=($ld->categoryName)?$ld->categoryName->name_hi:'';
       $urgent=($ld->priority==1)?'Urgent':'';
       $date=($ld->created_at>0)?date('d/m/Y',$ld->created_at):'';
       $html.="<tr>"
              ."<td>".$ld->id.'<br/>'.$urgent.'</td>'
                ."<td>".$ld->complainants.'<br/>'.$ld->complainantmobileno.'<br/>Vs<br/>'.$ld->oppositions.'</td>'
               .'<td>'.$revenue.','.$tehsil.'<br/>थाना:'.$policestation.'</td>'
              .'<td>'.'<b>'.$category.'</b>'.'<br/>'
              .$ld->description.'<br/>'.Yii::t('app','Gatanos').'-'.$ld->gatanos.'</td>'
              // .'<td>'.$ld->created_at.'</td>'
              
              .'<td>'.$date .'</td>'
              .'</tr>';
   
       
   }
   $html.='</table>';
   $mdf = new mPDF();
   $mdf->useAdobeCJK = true;		// Default setting in config.php
						// You can set this to false if you have defined other CJK fonts

$mdf->SetAutoFont(AUTOFONT_ALL);
//ob_clean();
//ob_start();
$mdf->setFooter('{PAGENO}');

        $mdf->WriteHTML($html);
  //      ob_get_clean();
        if (!is_dir($outdir.'/ld/'))
        mkdir($outdir.'/ld/');
        $mdf->Output($outdir.'/ld/'.$officerassigned.".pdf");
   
 }
 public static function printPendingComplaints($officerassigned,$outdir)
 {
   $officer=  Designation::model()->findByPk($officerassigned);
   $name='Not found';
   if ($officer)
      $name=$officer->name_hi;
   else 
       return "Wrong officer Name";
   $model=new Complaints;
   $model->unsetAttributes();
   $model->officerassigned=$officerassigned;
   $model->status=0;
   $dp =$model->search();
   $iterator = new CDataProviderIterator($dp);
   $html='<style> td{font-size:8px;}</style>';
   $html.='<table border="1">';
   $html.='<tr><td>'."रिपोर्ट का दिनांक".'</td>'.'<td>'.date('d/m/Y hh:mm').'</td>'
           .'<td>'."अधिकारी".'</td>'.'<td>'.$name.'</td>'
           . '</tr>';
    $html.='<tr><td>'."कुल लंबित शिकायतें".'</td>'.'<td>'.  Complaints::model()->countByAttributes(array('officerassigned'=>$officerassigned,'status'=>0)).'</td></tr>';
   //$html="<h1>".Yii::t('app','Landdisputes')." pending with ".$name."</h1>";
    $html.='</table>';
   $html.="<table border='1'>";
    $html.="<tr>"
              ."<th>".'Id'.'</th>'
                ."<th>".Yii::t('app','Complainants').'</th>'
               .'<th>'.Yii::t('app','Revenuevillage').'</th>'
              .'<th>'.Yii::t('app','dispute details').'</th>'
              .'<th>'.Yii::t('app','date of registering').'</th>'
              .'</tr>';
   foreach($iterator as $ld)
   {
       $revenue=($ld->revVillage)?$ld->revVillage->name_hi:'missing';
       $tehsil='';
        if ($ld->revVillage)
       {
           $tehsil=$ld->revVillage->tehsilCode?$ld->revVillage->tehsilCode->name_hi:'missing';
       }
       $policestation=($ld->thana)?$ld->thana->name_hi:'missing';
       $category=($ld->categoryName)?$ld->categoryName->name_hi:'';
       $urgent=($ld->priority==1)?'Urgent':'';
       $date=($ld->created_at>0)?date('d/m/Y',$ld->created_at):'';
       $html.="<tr>"
              ."<td>".$ld->id.'<br/>'.$urgent.'</td>'
                ."<td>".$ld->complainants.'<br/>'.$ld->complainantmobileno.'<br/>Vs<br/>'.$ld->oppositions.'</td>'
               .'<td>'.$revenue.','.$tehsil.'<br/>---<br/>थाना:'.$policestation.'</td>'
              .'<td>'.'<b>'.$category.'</b>'.'<br/>'
              .$ld->description.'</td>'
              // .'<td>'.$ld->created_at.'</td>'
              
              .'<td>'. $date.'</td>'
              .'</tr>';
   
       
   }
   $html.='</table>';
   $mdf = new mPDF();
   $mdf->incrementFPR1=4;
   $mdf->useAdobeCJK = true;		// Default setting in config.php
						// You can set this to false if you have defined other CJK fonts

$mdf->SetAutoFont(AUTOFONT_ALL);
//ob_clean();
//ob_start();
$mdf->setFooter('{PAGENO}');

        $mdf->WriteHTML($html);
     //   ob_get_clean();
        if (!is_dir($outdir.'/c/'))
        mkdir($outdir.'/c/');
        $mdf->Output($outdir.'/c/'.$officerassigned.".pdf");
   
 }        
}
?>
