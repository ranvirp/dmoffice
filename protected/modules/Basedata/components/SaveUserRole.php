<?php

/**
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SaveUserRole
 *
 * @author admin
 */
class SaveUserRole extends CActiveRecordBehavior{
    //put your code here
    public function beforeSave($event)
    {
     if (parent::beforeSave($event))  
     {
      if (strtolower(get_class($this->getOwner()))==='profile')
       {
           $this->getOwner()->designation=$_POST['Profile']['designation'];
          
         
       }
       return true;
    }
       return false;
    }
    
       
    
    public function afterSave($event)
    {
       if (strtolower(get_class($this->getOwner()))==='user')
       {
           
         //  Yii::app()->getModule('rights')->getAuthorizer()->authManager->assign($_POST['roles'],$this->getOwner()->id);
       
           Rights::assign($_POST['roles'],$this->getOwner()->id);
           if ($this->getOwner()->profile->designation >0)
           {
           $du=new DesignationUser();
         $du->designation_id=$this->getOwner()->profile->designation;
         $du->user_id=$this->getOwner()->id;
         $du->create_time=time();
         $du->save();
           }
       } 
    }
}
