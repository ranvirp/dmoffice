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
class RightsCommand  extends CConsoleCommand
{
    public function actionCreateAuth($username="",$authitem="") { 
        $model=User::model()->findByAttributes(array('username'=>$username));
        $authorizer = Yii::app()->getModule("rights")->getAuthorizer();
        $authorizer->createAuthItem($authitem,2);
        $authorizer->authManager->assign($authitem, $model->id);
    }
    public function actionCreateChild($parentAuthItem="",$childAuthItem="")
    {
        $authorizer = Yii::app()->getModule("rights")->getAuthorizer();
    }
    
    public function actionInit() { }
}