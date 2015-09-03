<?php
class Context 
{
  public static function contexts()
  {
    return array(
    'spoffice'=>array('label'=>Yii::t('app','SP Office'),
       'dataentry'=>array(151),
       'subordinatedepartments'=>array('home'),
    ),
    'dmoffice'=>array('label'=>Yii::t('app','DM Office'),
       'dataentry'=>array(1),
       'subordinatedepartments'=>array(),
    ),
  );
  }

}

?>