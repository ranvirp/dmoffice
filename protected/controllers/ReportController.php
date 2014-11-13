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
    function actionReportToday()
    {
        $ld=array();
        //$ldmodels =  Landdisputes::model()->findAllByAttributes(array('officerassigned'=>$model->officerassigned));
        $ldmodels=Landdisputes::model()->findAll();
        foreach ($ldmodels as $ldmodel)
        {
            if ($ldmodel)
          $ld[]=array('rv'=>$ldmodel->revVillage?$ldmodel->revVillage->name_hi:'NA','ps'=>$ldmodel->thana?$ldmodel->thana->name_hi:'NA','dd'=>$ldmodel->categoryName?$ldmodel->categoryName->name_hi:'NA'."\n".$ldmodel->description,'c'=>$ldmodel->complainants,'op'=>$ldmodel->oppositions,'st'=>'Status','at'=>'at');
            
        }
        $r = new YiiReport(array('template'=> 'landdisputes.xlsx'));
        
        $r->load(array(
                array(
                    'id' => 'ong',
                    'data' => array(
                        'name' => 'All Land Disputes Entered till Today'
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
        echo $r->render('html', 'Landdisputes');
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
}
