<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?php if  (!Yii::app()->user->isGuest)
        require 'dashboard.php';?>
<h2> Search Form</h2>
<?php
 $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'search-form',
		'action'=>'/site/index',
     ));
 ?>
<div class="row">
 <div class="col-md-4">
    <?php
 echo TbHtml::dropDownListControlGroup('contenttype','0',array(Yii::t('app','Landdisputes'),Yii::t('app','Complaints')),array('empty'=>'None','label'=>'Type'));
 ?>
 </div> 
    <div class="col-md-2">
     <?php
 echo TbHtml::textFieldControlGroup('contentid','',array('label'=>'Id'));
 ?>
    </div>
    <div class="col-md-2">
    <?php
 echo TbHtml::submitButton("Search");
 ?>
    </div>
</div>
    <?php
 $this->endWidget();
 ?>
    <div class="row">
        <?php
echo $text?$text:'';
?>
    </div>