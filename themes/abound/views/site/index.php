<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<h1> Search Form</h1>
<?php
 $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'search-form',
		'action'=>'/site/index',
     ));
 echo TbHtml::dropDownListControlGroup('contenttype','2',array(Yii::t('app','Landdisputes'),Yii::t('app','Complaints')),array('empty'=>'None','label'=>'Type'));
 echo TbHtml::textFieldControlGroup('contentid','',array('label'=>'Id'));
 echo TbHtml::submitButton("Search");
 $this->endWidget();
echo $text?$text:'';