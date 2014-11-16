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
          if (isset($_POST['Profile']['designation']))
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
       if(isset($_POST['roles']))
           Rights::assign($_POST['roles'],$this->getOwner()->id);
       try{
           $profile=$this->getOwner()->profile;
           if (!$profile)
           {
               print $this->getOwner()->username;
               exit;
           }
           if ($this->getOwner()->profile->designation >0)
           {
               $du=DesignationUser::model()->findByAttributes(array('designation_id'=>$this->getOwner()->profile->designation));
               if (!$du)
               {
           $du=new DesignationUser();
         $du->designation_id=$this->getOwner()->profile->designation;
         $du->user_id=$this->getOwner()->id;
         $du->create_time=time();
         $du->save();
               }
           }
       } catch (Exception $ex)
       {
           print $ex->getTraceAsString();
           Yii::app()->end();
       }
       } 
       //return parent::afterSave();
    }
}
