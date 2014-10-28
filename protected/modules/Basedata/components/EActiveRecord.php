<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EActiveRecord
 *
 * @author admin
 */
class EActiveRecord extends CActiveRecord{
    public function getDbConnection()
    {
        $db = Yii::app()->basedataDb;
        return Yii::createComponent($db);
    }
}
