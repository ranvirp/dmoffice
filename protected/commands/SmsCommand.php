<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RightsCommand
 *
 * @author admin
 */
class SmsCommand  extends CConsoleCommand
{
public function actionSendSms($PhNo,$text)
{
  $smsc=Yii::app()->getComponent('SendSMS');
				$smsc->postSms($PhNo,$text);
}
    public function actionSendReports()
	  {
	  //$smsc=new SensSMSComponent();
	    foreach (Designation::model()->listAll() as $designation=>$name)
		{
		   $l=Landdisputes::model()->countByAttributes(array('officerassigned'=>$designation,'status'=>0));
		   $ul=Landdisputes::model()->countByAttributes(array('officerassigned'=>$designation,'status'=>0,'priority'=>1));
		   $c=Complaints::model()->countByAttributes(array('officerassigned'=>$designation,'status'=>0));
		   $uc=Complaints::model()->countByAttributes(array('officerassigned'=>$designation,'status'=>0,'priority'=>1));
		   if (($l>0)||($c>0))
		     {
			    $mobile= Designation::model()->findByPk($designation)->officer_mobile;
				$userm='91'.$mobile;
				$text="Pending \n";
				$text.=Yii::t('app','Landdisputes')."-".$l."\n".'Urgent '.Yii::t('app','Landdisputes')."-".$ul."\n".Yii::t('app','Complaints')."-".$c."\n".
				    'Urgent '.  Yii::t('app','Complaints')."-".$uc."\n";
				$text.=" Login to http://azamgarhdm.com	";
				$smsc=Yii::app()->getComponent('SendSMS');
				$smsc->postSms($userm,$text);
				//print $userm."\n".$text;
				
			  }
		   //print $name."-".$ul."\n";
		 }
	   }
    public function actionInit() { }
}