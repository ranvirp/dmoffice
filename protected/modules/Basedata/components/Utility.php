<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Utility
{
    /**
	* Returns all models in List of primary key,name format
	*/
	public static function listAllByAttributes($className,$attributes)
	{
	    $lang = Yii::app()->language;
        $models = $className::model()->findAllByAttributes($attributes);
        $pk = $className::model()->tableSchema->primaryKey;
        // format models resulting using listData     
        $list = CHtml::listData($models, $pk, 'name_'.$lang);
        return $list;
	}
        public static function listAllByAttributesWithCriteria($className,$attributes,$criteria)
	{
            
	    $lang = Yii::app()->language;
        $models = $className::model()->findAllByAttributes($attributes,$criteria);
        $pk = $className::model()->tableSchema->primaryKey;
        // format models resulting using listData     
        $list = CHtml::listData($models, $pk, 'name_'.$lang);
        return $list;
	}
	public static function getBlock($user_id)
	{
		$designation = Designation::getDesignationModelByUser($user_id);
		$level = $designation->designationType->level->table_name;
		if ($level=='block')
			return $level::model()->findByPk($designation->level_type_id)->id;
		else 
			return '---';
	}
        public static function getDistrict($user_id)
	{
		$designation = Designation::getDesignationModelByUser($user_id);
                if ($designation)
                {
                //print $designation->name_hi."\n";
		$level = $designation->designationType->level->class_name;
               // print $level."\n";
		return $level::model()->findByPk($designation->level_type_id)->district_code;
                }
                else 
                    return 0;
	}
        public static function getTehsil($user_id)
        {
            $designation = Designation::getDesignationModelByUser($user_id);
                //print $designation->name_hi."\n";
            $level = $designation->designationType->level->class_name;
               // print $level."\n";
            if (strcmp($level,"Tehsil")==0)
	    return $level::model()->findByPk($designation->level_type_id)->code;
            else 
                return null;
        }
}