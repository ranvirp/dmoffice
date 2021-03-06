<?php

/*
 * Copyright (c) 2014, Ranvir Prasad <ranvir.prasad@gmail.com>
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 *
 * * Redistributions of source code must retain the above copyright notice, this
 *   list of conditions and the following disclaimer.
 * * Redistributions in binary form must reproduce the above copyright notice,
 *   this list of conditions and the following disclaimer in the documentation
 *   and/or other materials provided with the distribution.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE
 * ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE
 * LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF
 * SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
 * INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
 * CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
 * ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 */

/**
 * Description of ReportController
 *
 * @author Ranvir Prasad <ranvir.prasad@gmail.com>
 */
class ReportController extends Controller{
    function actionReportToday($m='Landdisputes')
    {
        $d=date('d-m-Y',time());
        $d='10-11-2014';
        $ld=array();
        //$ldmodels =  Landdisputes::model()->findAllByAttributes(array('officerassigned'=>$model->officerassigned));
        $timestamp1 = strtotime($d);
//$timestamp1 = mktime(0, 0, 0, $a['tm_mon']+1, $a['tm_mday'], $a['tm_year']+1900);
        $timestamp2=$timestamp1+3600*24;
        $criteria = new CDbCriteria;
        $criteria->addBetweenCondition('created_at', $timestamp1, $timestamp2, 'AND');
        $ldmodels=Landdisputes::model()->findAll($criteria);
        foreach ($ldmodels as $ldmodel)
        {
            if ($ldmodel)
            {
                $description=($ldmodel->categoryName)?$ldmodel->categoryName->name_hi."&".$ldmodel->description:'NA';
          $ld[]=array('rv'=>$ldmodel->revVillage?$ldmodel->revVillage->name_hi:'NA','ps'=>$ldmodel->thana?$ldmodel->thana->name_hi:'NA','dd'=>$description,'c'=>$ldmodel->complainants,'op'=>$ldmodel->oppositions,'st'=>'Status','at'=>'at');
            }  
        }
        $r = new YiiReport(array('template'=> 'landdisputes.xlsx'));
        
        $r->load(array(
                array(
                    'id' => 'ong',
                    'data' => array(
                        'name' => 'All Land Disputes Entered till '.$d,
                    )
                ),
                array(
                    'id'=>'ld',
                    'repeat'=>true,
                    'data'=>$ld,
                    'minRows'=>2
                )
            )
        );
        
        //echo $r->render('excel5', 'Students');
        //echo $r->render('excel2007', 'Students');
       // echo $r->render('pdf', 'Landdisputes');
        //echo $r->render('excel2007', 'Landdisputes');
        echo $r->render('pdf', 'Landdisputes');
    }
    public function actionExcel(){
        
        //Some data
        $students = array(
            array('name'=>'Some Name','obs'=>'Mat'),
            array('name'=>'Another Name','obs'=>'Tec'),
            array('name'=>'Yet Another Name','obs'=>'Mat')
        );
        
        $r = new YiiReport(array('template'=> 'students.xls'));
        
        $r->load(array(
                array(
                    'id' => 'ong',
                    'data' => array(
                        'name' => 'UNIVERSIDAD PADAGÓGICA NACIONAL'
                    )
                ),
                array(
                    'id'=>'ld',
                    'repeat'=>true,
                    'data'=>$students,
                    'minRows'=>2
                )
            )
        );
        
        //echo $r->render('excel5', 'Students');
        //echo $r->render('excel2007', 'Students');
        echo $r->render('pdf', 'Students');
        
    }//actionExcel method end
    public function actionOw($t)
    {
       /* 
        $sql="select officerassigned as offr,
    count(*) c,
    sum(case when t2.priority = 1 then 1 else 0 end) cu 
    
   
from designation inner join  complaints t2 on t2.officerassigned=designation.id
group by officerassigned";
        
        
        
          $final = Yii::app()->db->createCommand($sql)->queryAll();
        * * */
        
       // print_r($result);exit;
       
       // var_dump($final);
        //exit;
       // $dp = new CArrayDataProvider($final,array('keyField'=>'offr'));
        //$dp=
        $this->render('/reports/officerwise',array('dp'=>$dp));
    }
    public function actinRender()
    {
        $model=new Landdisputes;
        $model->unsetAttributes();
        $model->status=0;
        $html =$this->renderPartial('/landdisputes/admin_1',array('model'=>$model),true);
        print $html;
        $mdf= new mPDF();
        $mdf->useAdobeCJK = true;		// Default setting in config.php
						// You can set this to false if you have defined other CJK fonts

$mdf->SetAutoFont(AUTOFONT_ALL);
        $mdf->WriteHTML($html);
        $mdf->Output("d:/output.pdf");
        exit;
    }
    public function actionRender()
    {
        $district= Utility::getDistrict(Yii::app()->user->id);
        $sdms=Yii::app()->db->createCommand("select id from designation where district_code=$district and designation_type_id=8"
                    )->queryAll();
        $thanas=Yii::app()->db->createCommand("select code from policestation where district_code=$district"
                   )->queryAll();
        print '<meta charset="utf-8">';
        $x= "<table class='table table-bordered'>";
        foreach ($sdms as $j=>$sdm)
        {
           
            foreach($thanas as $i=>$thana)
            {
               
            $lds=Landdisputes::model()->with(array(
                array('thana','condition'=>'code='.$thana['code']),'revVillage'))
                    ->findAllByAttributes(array('officerassigned'=>$sdm['id']));
             $x.= "<tr><td>";
            $x.= Policestation::model()->findByPk($thana['code'])->name_hi;
            $x.= "</td></tr>";
            foreach ($lds as $ld)
            {
                  $x.= "<tr><td>";
                $x.= $ld->id." ".$ld->revVillage->tehsilCode->name_hi." ".$ld->thana->name_hi."\n";
                  $x.= "</td></tr>";
            }
          
            
            }
            $x.= '</table>';
        }
        $this->render('test',array('html'=> $x));
    }
    public function actionSms()
    {
        if (isset($_POST['m']))
            $m=$_POST['m'];
         if (isset($_POST['p']))
            $p=$_POST['p'];
      if (isset($m)&&isset($p))
      {
       $smsc=new SendSMSComponent();
				$smsc->postSms($p,$m);
      }
      $this->render('sms');
    }
}
