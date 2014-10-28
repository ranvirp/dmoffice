<?php
/* @var $this LanddisputesController */
/* @var $model Landdisputes */
/* @var $form CActiveForm */
?>

<div class="form form-inline">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
    <div class="row showgrid">
        <div class="col-md-5">
<?php $this->widget('RevenueVillageWidget', array('model' => $model, 'attribute' => 'revenuevillage')); ?>   
        </div>
     
         <div class="col-md-4">
         <?php echo $form->dropDownListControlGroup($model, 'category',  Utility::listAllByAttributes('Complaintcategories', array('department_code'=>'8')), array('empty'=>'None','span' => 5, 'maxlength' => 11)); ?>
</div> 
    </div>
    <div class="row">
        <div class="col-md-2">&nbsp;</div>
    </div>
<div class="row">
     
    

     
</div>
        <div class="form-actions">
        <?php echo TbHtml::submitButton('Search',  array('color' => TbHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->