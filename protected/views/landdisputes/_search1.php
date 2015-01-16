<?php
/* @var $this LanddisputesController */
/* @var $model Landdisputes */
/* @var $form CActiveForm */
?>
<style>
   div.showgrid > div
    {
      
        line-height:15px;
        font-size:10px;
    }
    button
    {
        font-size:10px;
    }
    td
    {
        text-align: left;
        width:120px;
    }
    .form-control-inline {
    min-width: 0;
    width: auto;
    display: inline;
}
</style>
<table class="table table-condensed">


    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'post',
)); ?>
    <tr >
       
        <td >
       <?php $this->widget('RevenueVillageWidget', array('model' => $model, 'attribute' => 'revenuevillage')); ?>   
        </td>
        
    <td >
        <?php echo TbHtml::submitButton('Search',  array('color' => TbHtml::BUTTON_COLOR_PRIMARY,));?>
    </td>
    </tr>
    <?php $this->endWidget(); ?>
      <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'post',
)); ?>
      <tr >  
        <td >
     
    <?php echo $form->dropDownListControlGroup($model, 'policestation', Utility::listAllByAttributes('Policestation',array('district_code'=>Utility::getDistrict(Yii::app()->user->id))),array('empty'=>'None','class'=>'form-control-inline','span' => 5, 'maxlength' => 11)); ?>

        </td>
    <td >
        <?php echo TbHtml::submitButton('Search',  array('color' => TbHtml::BUTTON_COLOR_PRIMARY,));?>
    </td>
    </tr>
    <?php $this->endWidget(); ?>
      <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'post',
)); ?>
      <tr>  
         <td >
         <?php echo $form->dropDownListControlGroup($model, 'category',  Utility::listAllByAttributes('Complaintcategories', array('department_code'=>'8')), array('empty'=>'None','span' => 5, 'maxlength' => 11)); ?>
</td> 
            <td >
        <?php echo TbHtml::submitButton('Search',  array('color' => TbHtml::BUTTON_COLOR_PRIMARY,));?>
    </td>
    </tr>
    <?php $this->endWidget(); ?>
       <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'post',
)); ?>   
    <tr>
         <td >
            <?php echo $form->dropDownlistControlGroup($model, 'prevreferencetype', Prevreference::obj()->options); ?>    
      
            <?php echo $form->textFieldControlGroup($model, 'prevreferenceno'); ?>    
        </td>
      <td >
        <?php echo TbHtml::submitButton('Search',  array('color' => TbHtml::BUTTON_COLOR_PRIMARY,));?>
    </td>
    </tr>
    <?php $this->endWidget(); ?>
       <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'post',
)); ?>
      <tr>  
         <td >
         <?php $this->widget('OfficerWidget',array('model'=>$model, 'attribute'=>'officerassigned'));?>
</td> 
            <td >
        <?php echo TbHtml::submitButton('Search',  array('color' => TbHtml::BUTTON_COLOR_PRIMARY,));?>
    </td>
    </tr>
    <?php $this->endWidget(); ?>
      
</table>