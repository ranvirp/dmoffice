<?php
/* @var $this LanddisputesController */
/* @var $model Landdisputes */
/* @var $form CActiveForm */
?>
<style>
   div.showgrid > div
    {
        border:1px solid gold;
    }
    .form-control-inline {
    min-width: 0;
    width: auto;
    display: inline;
}
</style>
<div class="form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'post',
)); ?>
    <div class="row showgrid">
       
        <div class="col-md-5">
       <?php $this->widget('RevenueVillageWidget', array('model' => $model, 'attribute' => 'revenuevillage')); ?>   
        </div>
        
   
  
         <div class="col-md-4">
         <?php echo $form->dropDownListControlGroup($model, 'category',  Utility::listAllByAttributes('Complaintcategories', array('department_code'=>'8')), array('empty'=>'None','span' => 5, 'maxlength' => 11)); ?>
</div> 
        <div class='col-md-3'>
<?php 
$priority=array('None','Urgent','Immediate','Normal');
echo $form->dropDownListControlGroup($model, 'priority',$priority);?>
<?php 
$status=array('Pending','Disposed');
echo $form->dropDownListControlGroup($model, 'status',$status);?>

</div>

    </div>
    <div class="row">
	
          <?php $this->widget('OfficerWidget',array('model'=>$model,'attribute'=>'officerassigned'));?>
	</div> 
    
        <div class="row form-actions">
        <?php echo TbHtml::submitButton('Search',  array('color' => TbHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->